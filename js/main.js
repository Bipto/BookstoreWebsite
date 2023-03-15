//index page
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

//layout
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
    location.href = "invoice.php";
}

function removeBookFromDatabase(id)
{   
    var answer = confirm("Are you sure that you wish to do this? This action cannot be undone.");
    if (answer)
    {
        location.href = "admin_dashboard.php?action=remove&id=" + id;
    }
}

//cursor follow
document.addEventListener('DOMContentLoaded', () => {
    let mousePosX = 0,
        mousePosY = 0,
        mouseCircle = document.getElementById('mouse-circle');

    document.onmousemove = (e) => {
        mousePosX = e.pageX;
        mousePosY = e.pageY;
    }

    let delay = 6,
        revisedMousePosX = 0,
        revisedMousePosY = 0;

    function delayMouseFollow()
    {
        requestAnimationFrame(delayMouseFollow);

        revisedMousePosX += (mousePosX - revisedMousePosX) / delay;
        revisedMousePosY += (mousePosY - revisedMousePosY) / delay;

        if (mouseCircle)
        {
            mouseCircle.style.top = revisedMousePosY + 'px';
            mouseCircle.style.left = revisedMousePosX + 'px';
        }

    }
    delayMouseFollow();
});

const observer = new IntersectionObserver((entryies) => {
    entryies.forEach((entry) => {
        console.log(entry);
        if (entry.isIntersecting){
            entry.target.classList.add('show');
        }
        else{
            entry.target.classList.remove('show');
        }
    });
});

const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((el) => observer.observe(el));