
<?php
$file = "score.txt";

$a = file($file);   //Масив з інформацією з файлу
$i = 0;
$n = 0; // зміння для кількості голосів

$PCREpattern  =  '/\r\n|\r|\n/u'; // знаки які ламали мені усе   wZjH4rSz4#3Vz%*n7q)o

while ($i != 3):
$a[$i] = trim(str_replace ($PCREpattern,"", $a[$i])); //видалення переносів
$n = (int)$n+(int)$a[$i]; //рахую кількість голосів
$i++;
endwhile; 

if ((int)$a[3] != (int)$_POST['otvet']) // Перевіряю чи давали відповідь
{
    $otvet = $_POST['otvet'];
    //$_POST['otvet'] = -1; //Захист від кіберпіратів
 
   echo "<br>Дякую за ваш голос!";
   $a[3] = $_POST['otvet'];
   $a[$otvet]++; // Інкрементую кількість голосвів
   $n++;

   $rez = $a[0]."\n".$a[1]."\n".$a[2] ."\n" .$a[3]; // Так будуть виглядати дані у файлі
   
   
   $fp = @fopen($file,"w");
   if ($fp)
   {      
      fputs($fp,$rez);  // Записую до файлу нові значення
      fclose($fp); 
    }
      
      else { echo "Помилка при відкритті файлу"; } // знову щось пішло не так
}

else { echo "<br>Ти щойно обрав це, обери щось інше"; } 
echo "<br>C++ <b>".$a[0]."</b>";
echo "<br>PHP <b>".$a[1]."</b>";
echo "<br>Java <b>".$a[2]."</b>";
echo "<br><br>Усього голосів: ".$n ."<br>";
echo '<a href="index.php">На головну</a>';

?>