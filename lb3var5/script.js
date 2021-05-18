var ajax; // глобальная переменная для хранения объекта AJAX
InitAjax();
function InitAjax() 
{
    try
    { /* пробуем создать компонент XMLHTTP для IE старых версий */
    ajax = new ActiveXObject("Microsoft.XMLHTTP");
    } 
catch (e)
    {
        try
        {
        ajax = new ActiveXObject("Msxml2.XMLHTTP"); // для IE версий >6
        }
    catch (e) 
        {
            try {// XMLHTTP для Mozilla и остальных
            ajax = new XMLHttpRequest(); // на текущий момент можно ограничится этим вызовом
            } catch(e) { ajax = 0; }
        }
    }
}

function getItemsByVendor()
 {
    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var s1val = document.getElementById("manufacturer").value;
    
    ajax.onreadystatechange = OutItemsByVendor;
    var param1 = 'manufacturerId=' + encodeURIComponent(s1val);
    
    ajax.open("GET", "get.php?"+param1, true);
    ajax.send(null);
}

function OutItemsByVendor()
 {
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // если ошибок нет
        var select = document.getElementById('text');
        select.innerHTML = ajax.responseText;
        }
    else alert(ajax.status + " - " + ajax.statusText);
    ajax.abort();
    }
}

function getItemsByCategory()
 {
    

    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var s1val = document.getElementById("category").value;
    
    ajax.onreadystatechange = OutItemsByCategory;
    var param1 = 'category=' + encodeURIComponent(s1val);
    
    ajax.open("GET", "get.php?"+param1, true);
    ajax.send(null);
}

function OutItemsByCategory()
{
        if (ajax.status == 200) 
        {
        
            var res = document.getElementById("text");
                
            var result = "";
            var rows = ajax.responseXML.firstChild.children;
            result +="<table border=1> <tr><td>Наименование</td><td>Цена</td><td>Количество на складе</td><td>Качество</td></tr>";
            for (var i = 0; i < rows.length; i++) 
            {
                result += "<tr>";
                result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                result += "<td>" + rows[i].children[1].textContent + "</td>";
                result += "<td>" + rows[i].children[2].textContent + "</td>";
                result += "<td>" + rows[i].children[3].textContent + "</td>";
                result += "</tr>";
            }
            result +="</table>";
            res.innerHTML = result;
       
        }
    
    
}

function getItemsByPrice()
 {
    

    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var val1 = document.getElementById("min").value;
    var val2 = document.getElementById("max").value;
    
    ajax.onreadystatechange = OutItemsByPrice;
    var param1 = 'min=' + encodeURIComponent(val1);
    var param2 = 'max=' + encodeURIComponent(val2);
    
    ajax.open("GET", "get.php?"+param1+"&"+param2, false);
    ajax.send(null);
}

function OutItemsByPrice()
 {
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // если ошибок нет
        var res = document.getElementById("text");
        var result ="<table border=1> <tr><td>Наименование</td><td>Цена</td><td>Количество на складе</td><td>Качество</td></tr>";

        var arr = JSON.parse(ajax.responseText);
        
        for(i=0; i<arr.length/4; i++)
        {
            result += "<tr>";
            result += "<td>" + arr[0+(4*i)] + "</td>";
            result += "<td>" + arr[1+(4*i)] + "</td>";
            result += "<td>" + arr[2+(4*i)] + "</td>";
            result += "<td>" + arr[3+(4*i)] + "</td>";
            result += "</tr>";
        }


        result +="</table>";
        res.innerHTML = result;
        }
    else alert(ajax.status + " - " + ajax.statusText);
    ajax.abort();
    }
}
    