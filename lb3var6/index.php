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
        <!-- в формате простого текста, все работает, можно не трогать-->
        <form name="maker" method="get">
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
            <input name="submit" type="button" value="Искать" onclick="get1();">
        </form>
        <div id="getmaker"></div>

        /////////////////////////////////////////////////////////////
        <!-- здесь пыталась сделать в формате xml, не работает-->
        <form name="rent" method="get">
            <p>Полученный доход с проката по состоянию на выбранную дату:
            </p>
            <input type="date" value = '2014-09-02' name="firstdate" id="firstdate" value="firstdate"/>
            <input name="submit" type="button" value="Искать" onclick="get2();"/>
        </form>
        <div id="getselect2"></div>


    //////////////////////////////////////////////////////////////////////
        <!-- здесь пыталась сделать в формате json, не работает-->
    <form  id = "firstdate" name="cars" method="get">
        <p>Свободные автомобили на выбранную дату:</p>
        <input  id="firstdate1" value= '2014-10-01' type="date" name="firstdate1">
        <p><input type="button" value="Искать" onclick="get3();"/></p>
    </form>
        <table id="getselect3"></table>

        ////////////////////////////////////////////////////////////////////////////////////////


</div>
</body>
</html>