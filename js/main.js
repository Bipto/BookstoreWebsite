
function searchBooks()
{
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

function signIn()
{
    alert("Sign In");
}

function toggleDropdownMenu()
{
    var x = document.getElementById("navbar");
    if (x.style.display === "block")
    {
        x.style.display = "none";
    }
    else
    {
        x.style.display = "block";
    }
}