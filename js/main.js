
function searchBooks(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        //document.getElementById("grid").outerHTML= this.responseText;
        document.body.parentNode.innerHTML = this.responseText;

    }
    
    const searchText = document.getElementById("searchtext").value;
    const filePath = 'index.php?name=' + searchText;

    xhttp.open("GET", filePath, false);
    xhttp.send();
}