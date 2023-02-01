
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

function removeBookFromCart(id)
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.body.innerHTML = this.responseText;
    }

    const filepath = 'remove_book_from_cart.php?id=' + id;
    
    xhttp.open("GET", filepath, true);
    xhttp.send();
}

function paymentBackClick()
{
    location.href = "invoice.php";
}