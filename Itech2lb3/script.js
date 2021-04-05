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

function getCompTaskInfo()
 {
    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var s1val = document.getElementById("select1").value;
    var s1va2 = document.getElementById("specifieddate").value;
    ajax.onreadystatechange = OutTaskInfo;
    var param1 = 'select1=' + encodeURIComponent(s1val);
    var param2 = 'date=' + encodeURIComponent(s1va2);
    ajax.open("GET", "get.php?"+param1+"&"+param2, true);
    ajax.send(null);
}

function OutTaskInfo()
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

function getTotalTime()
 {
    

    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var s1val = document.getElementById("project").value;
    
    ajax.onreadystatechange = OutTotalTime;
    var param1 = 'project=' + encodeURIComponent(s1val);
    
    ajax.open("GET", "get.php?"+param1, false);
    ajax.send(null);
}

function OutTotalTime()
{
        if (ajax.status == 200) 
        {
        // если ошибок нет
       // var rows = ajax.responseXML;
       var xmlDoc=ajax.responseXML;

       
        
        var name = xmlDoc.getElementsByTagName("time")[0].firstChild.nodeValue;

         var days = xmlDoc.getElementsByTagName("days")[0].firstChild.nodeValue;
         var hours = xmlDoc.getElementsByTagName("hours")[0].firstChild.nodeValue;
         var minutes = xmlDoc.getElementsByTagName("minutes")[0].firstChild.nodeValue;
         var seconds = xmlDoc.getElementsByTagName("seconds")[0].firstChild.nodeValue;

         document.getElementById("text").innerHTML= days +"<b> days </b>" + hours + "<b> hours </b>" + minutes+ "<b> minutes </b>" + seconds +"<b> seconds </b>";
        }
    
    
}

function getAmountWorkers()
 {
    

    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var s1val = document.getElementById("chief").value;
    
    ajax.onreadystatechange = OutAmount;
    var param1 = 'chief=' + encodeURIComponent(s1val);
    
    ajax.open("GET", "get.php?"+param1, false);
    ajax.send(null);
}

function OutAmount()
 {
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // если ошибок нет
        var res = JSON.parse(ajax.responseText);


        var select = document.getElementById('text');
        select.innerHTML = res.text+res.amount;
        }
    else alert(ajax.status + " - " + ajax.statusText);
    ajax.abort();
    }
}
    