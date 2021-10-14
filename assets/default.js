function validate() {
    var valid = true;
    var itemReq = document.getElementsByClassName('itemReq');
    for (var a = 0; a < itemReq.length; a++) {
        if (itemReq[a].value == '') {
            itemReq[a].style.backgroundColor = "#ffb3b3";
            valid = false;
        } else {
            itemReq[a].style.backgroundColor = "#ffffff";
            valid = true;
        }
    }
    return valid;
}
function onPlus() {
    if (!validate()) return false;

    var aK = ['', 'AKTOR', 'RUPA', 'TARI', 'MUSIK', 'BASAH'];
    var sP = ['', 'Jual/beli', 'Waris', 'Hibah'];
    // Get a reference to the table
    var tableRef = document.getElementById("asetBody");

    // Insert a row at the end of the table
    var newRow = tableRef.insertRow(-1);

    // Insert a cell in the row at index 0
    var newCell1 = newRow.insertCell(0);
    newCell1.style.cssText = 'padding:0';
    var newCell2 = newRow.insertCell(1);
    newCell2.style.cssText = 'padding:0';
    var newCell3 = newRow.insertCell(2);
    newCell3.style.cssText = 'padding:0';
    var newCell4 = newRow.insertCell(3);
    newCell4.style.cssText = 'padding:0';

    // create a input forelement for the cell
    var x1 = document.createElement("INPUT");
    x1.setAttribute("type", "text");
    x1.setAttribute("onkeyup", "this.value=toTitleCase(this.value)");
    x1.className = "inputCell itemReq aPersil";

    var x2 = document.createElement("SELECT");
    x2.style.cssText = 'width:100%; padding:3.5px;';
    x2.className = "inputCell itemReq aKategori";
    for (var a = 0; a < aK.length; a++) {
        var option = document.createElement("option");
        option.value = aK[a];
        option.text = aK[a];
        x2.appendChild(option);
    }

    var x3 = document.createElement("INPUT");
    x3.setAttribute("type", "text");
    x3.className = "inputCell itemReq aKelas";

    var x4 = document.createElement("INPUT");
    x4.setAttribute("type", "text");
    x4.className = "inputCell itemReq aLuas";

    // Append a input form to the cell
    newCell1.appendChild(x1); newCell2.appendChild(x2); newCell3.appendChild(x3); newCell4.appendChild(x4);



}
function reseter() {
    //document.getElementById("WAform").reset();
    var mytbl = document.getElementById("aset");
    mytbl.getElementsByTagName("tbody")[0].innerHTML = mytbl.rows[1].innerHTML;
    var itemReq = document.getElementsByClassName('itemReq');
    for (var a = 0; a < itemReq.length; a++) {
        itemReq[a].style.backgroundColor = "#ffffff";
    }
}
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}