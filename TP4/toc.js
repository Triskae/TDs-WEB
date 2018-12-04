function toc() {
    document.head.appendChild(document.createElement("STYLE"));
    let h1 = document.getElementsByTagName("h1");
    let tableDiv = document.createElement("TABLE");
    let firstRow = tableDiv.insertRow(0);
    firstRow.insertCell(0).outerHTML = "<th>Table des matieres</th>";

    document.body.insertBefore(tableDiv, document.body.firstChild);

    Array.from(h1).forEach((title) => {
        tableDiv.insertRow().insertCell().innerHTML = title.innerHTML;
    });
}

function tocV2() {
    document.head.appendChild(document.createElement("STYLE"));
    let h1 = document.getElementsByTagName("h1");
    let tableDiv = document.createElement("TABLE");
    let firstRow = tableDiv.insertRow(0);
    firstRow.insertCell(0).outerHTML = "<th>Table des matieres</th>";

    document.body.insertBefore(tableDiv, document.body.firstChild);
    Array.from(h1).forEach((title, index) => {
        if (title.id === "") {
            title.id = "titre" + index;
        }
        tableDiv.insertRow().insertCell().innerHTML = "<a href='#" + title.id + "'>" + title.innerHTML + "</a>";
    });
}

function tocV3() {
    document.head.appendChild(document.createElement("STYLE"));
    document.getElementsByTagName("style")[0].innerHTML += ".active{background-color:#FF495C;}";
    let h1 = document.getElementsByTagName("h1");
    let tableDiv = document.createElement("TABLE");
    let firstRow = tableDiv.insertRow(0);
    firstRow.insertCell(0).outerHTML = "<th>Table des matieres</th>";

    document.body.insertBefore(tableDiv, document.body.firstChild);
    let cell;
    Array.from(h1).forEach((title, index) => {
        if (title.id === "") {
            title.id = "titre" + index;
        }
        cell = tableDiv.insertRow().insertCell();
        cell.innerHTML = "<a href='#" + title.id + "'>" + title.innerHTML + "</a>";
        addListeners(cell);
    });
}

function createFullTableNavigableMouseEvent() {
    document.head.appendChild(document.createElement("STYLE"));
    document.getElementsByTagName("style")[0].innerHTML += ".activeh1{background-color:#008000;}";
    document.getElementsByTagName("style")[0].innerHTML += ".activeh2{background-color:#800080;}";

    let h1andh2 = document.querySelectorAll("h1, h2");
    let tableDiv = document.createElement("TABLE");
    tableDiv.insertRow(0).insertCell(0).outerHTML = "<th>Table des matieres</th>";
    document.body.insertBefore(tableDiv, document.body.firstChild);
    let cell;
    Array.from(h1andh2).forEach((element, index) => {
        if (element.id === "") {
            if (element.tagName === "H1") {
                element.setAttribute("id", "titre" + index);
            } else if (element.tagName === "H2") {
                element.setAttribute("id", "soustitre" + index);
            }
        }
        cell = tableDiv.insertRow().insertCell();
        cell.innerHTML = "<a href='#" + element.id + "'>" + element.innerHTML + "</a>";
        addListeners(cell);
    });
}

function addListeners(cell) {
    cell.addEventListener("mouseover", (event) => {
        let id = event.srcElement.firstChild.href.substring(event.srcElement.firstChild.href.indexOf("#")).replace("#", "");
        if (document.getElementById(id).tagName === "H1") {
            document.getElementById(id).classList.add("activeh1");
        } else if (document.getElementById(id).tagName === "H2") {
            document.getElementById(id).classList.add("activeh2");
        }
    });
    cell.addEventListener("mouseleave", (event) => {
        let id = event.srcElement.firstChild.href.substring(event.srcElement.firstChild.href.indexOf("#")).replace("#", "");
        if (document.getElementById(id).tagName === "H1") {
            document.getElementById(id).classList.remove("activeh1");
        } else if (document.getElementById(id).tagName === "H2") {
            document.getElementById(id).classList.remove("activeh2");
        }
    });
}
