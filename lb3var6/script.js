

        var ajax = new XMLHttpRequest()

        function get1() {
            if (!ajax) {
                alert("Ajax не инициализирован");
                return;
            }
            var s1val = document.getElementById("maker").value;
            ajax.onreadystatechange = UpdateSelect1;
            var params = 'maker=' + encodeURIComponent(s1val);
            ajax.open("GET", "maker.php?" + params, true);
            ajax.send(null);
        }

        function UpdateSelect1() {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    // если ошибок нет
                    var select = document.getElementById('getmaker');
                    select.innerHTML = ajax.responseText;
                } else alert(ajax.status + " - " + ajax.statusText);
                ajax.abort();
            }
        }

        function get2(){
            if (!ajax) {
                alert("Ajax не инициализирован"); return;
            }
            var s1val = document.getElementById("firstdate").value;
            ajax.onreadystatechange = UpdateSelect2;
            var params = 'firstdate=' + encodeURIComponent(s1val);
            ajax.open("GET", "rent.php?"+ params, true);
            ajax.send(null);
        }

        function UpdateSelect2() {
            if(ajax.readyState == 4) {
                if(ajax.status == 200) {
                    var res = document.getElementById("getselect2");
                    var result = "";
                    var rows = ajax.responseXML.firstChild.children;
                    for (var i = 0; i < rows.length; i++) {
                        result += rows[i].children[0].textContent+"<br>";
                    }
                    res.innerHTML = result;
                }
            }
        }

        function get3(){
            if (!ajax) {
                alert("Ajax не инициализирован"); return;
            }
            var s1val = document.getElementById("firstdate1").value;
            ajax.onreadystatechange = UpdateSelect3;
            var params1 = 'firstdate1=' + encodeURIComponent(s1val);
            ajax.open("GET", "cars.php?" + params1, true);
            ajax.send(null);
        }

        function UpdateSelect3(){
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    //alert(ajax.responseText);
                    var rows = JSON.parse(ajax.responseText);
                    var result = "";
                    var res = document.getElementById("getselect3");
                    //document.getElementById("quantity").innerHTML=res.quantity;
                    for (var i = 0; i < rows.length; i++) {
                        result += "<tr>";
                        result += "<td>" + rows[i].name + "</td>";
                        result += "</tr>";
                    }
                    res.innerHTML = result;
                }
                else { alert(ajax.status + " - " + ajax.statusText);
                    ajax.abort(); }
            }
        }