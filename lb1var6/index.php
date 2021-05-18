<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="script.js"></script>
    

</head>
<body>
        Выберите действие:
       
       
       <form name="rent" method="get" action ="rent.php">
           <p>Полученный доход с проката по состоянию на выбранную дату:
           </p>
           <input type="date" value = '2014-09-02' name="firstdate" id="firstdate" value="firstdate"/>
           <input  type="submit" value="Искать" />
       </form>
       <div id="getselect2"></div>
       /////////////////////////////////////////////////////////////
        <form name="maker" method="get" action ="maker.php">
            <p>Производитель:</p>
            <select name="maker" id="maker">
                <?php
                include_once 'config.php';

                $query = $pdo->query('SELECT * FROM `vendors`');
                while ($row = $query->fetch()) {
                    echo "<option value=" . $row['ID_Vendors'] . ">" . $row['Name'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Искать" >
        </form>
        <div id="getmaker"></div>

    


    //////////////////////////////////////////////////////////////////////
      
    <form  id = "firstdate" name="cars" method="get"  action ="cars.php">
        <p>Свободные автомобили на выбранную дату:</p>
        <input  id="firstdate1" value= '2014-10-01' type="date" name="firstdate1">
        <p><input type="submit" value="Искать" /></p>
    </form>
        <table id="getselect3"></table>

        ////////////////////////////////////////////////////////////////////////////////////////

Добавление в БД информации об аренде для выбранного автомобиля на указанные даты:
<div class="form-group">
    <form action="addRent.php" method="post">
       
        <table border=1px>
        <tr><td>Автомобиль</td><td>Дата и время начала </td><td>Дата и время конца аренды </td><td>Стоимость</td></tr>
           <tr><td> <select name="cars" id="">

                <?php
                require 'config.php';

                $query = $pdo->query('SELECT * FROM `cars`');
                while ($row = $query->fetch()) {
                    echo "<option value=" . $row['ID_Cars'] . ">" . $row['Name'] . "</option>";
                }
                ?>
            </select></td>
        
      <td>
            <input type="date" class="form-control" name="firstdate" value="" placeholder="Дата начала аренды"/>
       
            <input type="time" class="form-control" name="firsttime" value="" placeholder="Время начала аренды"/></td>
            <td>
            <input type="date" class="form-control" name="seconddate" value="" placeholder="Дата конца аренды"/>
       
            <input type="time" class="form-control" name="secondtime" value="" placeholder="Время конца аренды"/></td>
       
            <td>  <input type="number" class="form-control" name="cost" value="" placeholder="Стоимость"/></td></tr>
            </table>
        <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
    </form><br>
    </div>
    Изменение данных о пробеге для выбранного автомобиля:<br>
   <form action="update_go.php" method="post">
        <div class="form-group">
        <span> Автомобиль: <select name="cars" id="">
                <?php
                require 'config.php';
                $query = $pdo->query('SELECT * FROM `cars`');
                while ($row = $query->fetch()) {
                    echo "<option value=" . $row['ID_Cars'] . ">" . $row['Name'] . "</option>";
                }
                ?>
            </select></span>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="edit_race" value="" placeholder="Пробег">
        </div>
        <button type="submit" name="edit-submit" class="btn btn-primary">Обновить</button>
    </form>

</div>
</body>
</html>