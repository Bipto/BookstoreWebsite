function myFunction(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        //document.getElementById("grid").outerHTML= this.responseText;
        document.body.parentNode.innerHTML = this.responseText;
    }
    
    const searchText = document.getElementById("searchtext").value;
    xhttp.open("GET", "index.php?name=" + searchText, false);
    xhttp.send();

    //alert(searchText);
}