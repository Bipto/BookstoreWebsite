function myFunction(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        //document.getElementById("body").outerHTML = this.responseText;
        document.body.parentNode.innerHTML = this.responseText;
    }
    
    const searchText = document.getElementById("searchtext").value;
    xhttp.open("GET", "test.php?name='" + searchText + "'", true);
    xhttp.send();

    alert(searchText);
}