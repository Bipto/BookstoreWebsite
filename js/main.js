//toggle mobile navigation
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

//toggle mobile navigation on admin dashboard
function toggleAdminDropdownMenu()
{
    var nav = document.getElementById("navigation");
    if (nav.style.display == "block")
    {
        nav.style.display = "none";
    }
    else
    {
        nav.style.display = "block";
    }
}

//cart page
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

//payment page
function paymentBackClick()
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.body.innerHTML = this.responseText;
    }
    const filepath = "invoice.php";
    xhttp.open("GET", filepath, true);
    xhttp.send();
}

//
function removeBookFromDatabase(id)
{   
    var answer = confirm("Are you sure that you wish to do this? This action cannot be undone.");
    if (answer)
    {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.body.innerHTML = this.responseText;
        }
        const filepath = "admin_dashboard.php?action=remove&id=" + id;
        xhttp.open("GET", filepath, true);
        xhttp.send();
    }
}