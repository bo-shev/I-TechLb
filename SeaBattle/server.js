const express = require('express')
const path = require('path')
const http = require('http')
const PORT = process.env.PORT || 3000
const socketio = require('socket.io')
const app = express()
const server = http.createServer(app)
const io = socketio(server)

//встановлення папки з файлами для клієнта
app.use(express.static(path.join(__dirname, "public")))

// початок роботи на порті 3000
server.listen(PORT, () => console.log(`Server running on port ${PORT}`))

// Обробка запросів на підключення від клієнту
const connections = [null, null]

io.on('connection', socket => {

  let playerIndex = -1;
  for (const i in connections)
  {
    if (connections[i] === null)
    {
      playerIndex = i
      break
    }
  }

  // Повідомлення клієнту який в нього номер
  socket.emit('player-number', playerIndex)

  console.log(`Player ${playerIndex} has connected`)

  // У третього і далі гравця буде -1, його сервер ігнорує
  if (playerIndex === -1) return

  connections[playerIndex] = false

  // Повідомлення про підключення нового користувача
  socket.broadcast.emit('player-connection', playerIndex)

  // обробка відключень від сервера
  socket.on('disconnect', () => {
    console.log(`Player ${playerIndex} disconnected`)
    connections[playerIndex] = null

    // повідомлення про іd гравця, який щойно вийшов
    socket.broadcast.emit('player-connection', playerIndex)
  })

  // Гравець готовий
  socket.on('player-ready', () => {
    socket.broadcast.emit('enemy-ready', playerIndex)
    connections[playerIndex] = true
  })

  // Перевірка підключення гравця
  socket.on('check-players', () => {
    const players = []
    for (const i in connections)
    {
      connections[i] === null ? players.push({connected: false, ready: false}) : players.push({connected: true, ready: connections[i]})
    }
    socket.emit('check-players', players)
  })

  // Вогонь отримано
  socket.on('fire', id => {
    console.log(`Shot fired from ${playerIndex}`, id)

    // Передача ходу іншому гравцеві
    socket.broadcast.emit('fire', id)
  })

  // Вогонь відправлено
  socket.on('fire-reply', square => {
    console.log(square)

    // Передача відповіді іншому гравцеві
    socket.broadcast.emit('fire-reply', square)
  })

  // Відключення гравця через 10 хвилин
  setTimeout(() => {
    connections[playerIndex] = null
    socket.emit('timeout')
    socket.disconnect()
  }, 600000) // одному гравцеві виділяється 10 хвилин
})