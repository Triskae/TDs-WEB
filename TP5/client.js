let currentPath = "";
let tableDiv;

function ask(str) {
    currentPath = "./" + str;
    console.log(currentPath);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let json = JSON.parse(xmlhttp.response);
            console.log(json);

            document.getElementById("rep").innerText = "";
            tableDiv = document.createElement("table");


            tableDiv.insertRow().insertCell();
            tableDiv.rows[0].innerHTML = '<th>Fichiers du répertoire</th><th>Visualisation du fichier</th>';

            document.getElementById("rep").insertBefore(tableDiv, document.getElementById("rep").firstChild);
            let cell;
            json.dirArray.forEach((dir) => {
                cell = tableDiv.insertRow().insertCell();
                cell.setAttribute("class", "dir");
                cell.innerHTML = dir;
                cell.onclick = (
                    ((event) => {
                        ask(currentPath + "/" + event.srcElement.innerHTML);
                    })
                );
            });

            json.filesArray.forEach((file) => {
                cell = tableDiv.insertRow().insertCell();
                cell.setAttribute("class", "file");
                cell.innerHTML = file;
                cell.onclick = (
                    ((event) => {
                        displayFile(currentPath + "/" +event.srcElement.innerHTML);
                    })
                );
            });
            tableDiv.rows[1].innerHTML += '<td rowspan="' + tableDiv.rows.length + '"></td>';
        } else {
            document.getElementById("rep").innerText = "Chargement ...";
			}
	};
    xmlhttp.open("GET", "serveur.php?q=" + str, true);

    xmlhttp.send();
}


function displayFile(file) {
    console.log(file);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            tableDiv.rows[1].lastElementChild.innerText = xmlhttp.response;

        }
    };
    xmlhttp.open("GET", "serveur.php?file=" + file, true);
    xmlhttp.send();
}
