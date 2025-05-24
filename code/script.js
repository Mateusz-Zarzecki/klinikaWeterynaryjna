const menu_toggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');
if(!sessionStorage.getItem('tableSubmenuStatus')) {
    sessionStorage.setItem('tableSubmenuStatus', "closed");
}
if(!sessionStorage.getItem('raportSubmenuStatus')) {
    sessionStorage.setItem('raportSubmenuStatus', "closed");
}
console.log("table: " + sessionStorage.getItem('tableSubmenuStatus'));
console.log("raport: " + sessionStorage.getItem('raportSubmenuStatus'));

menu_toggle.addEventListener('click', () => {
    menu_toggle.classList.toggle('is-active');
    sidebar.classList.toggle('is-active');
});

function showMenu(className)
{
    let menus = document.getElementsByClassName('opcjeMenu')[0];
    for(var i=0; i< menus.childNodes.length;i++)
    {
        menus.childNodes[i].style.display = "none";
    
    }
    let menu = document.getElementsByClassName(className)[0];
    menu.style.display = "block";
}
function openMenu() {
    if(sessionStorage.getItem('tableSubmenuStatus') === "opened") {
        document.getElementById('tableSubmenu').style.display = "block";
    } else {
        document.getElementById('tableSubmenu').style.display = "none";   
    }
    if(sessionStorage.getItem('raportSubmenuStatus') === "opened") {
        document.getElementById('raportSubmenu').style.display = "block";
    } else {
        document.getElementById('raportSubmenu').style.display = "none";   
    }
}
function tablesMenu() {

    if(sessionStorage.getItem('tableSubmenuStatus') === "closed") {

        document.getElementById('tableSubmenu').style.display = "block";
        document.getElementById('raportSubmenu').style.display = "none";
        sessionStorage.setItem('tableSubmenuStatus', "opened");
    }
    else {
        document.getElementById('tableSubmenu').style.display = "none"
        sessionStorage.setItem('tableSubmenuStatus', "closed")
    }
    sessionStorage.setItem('raportSubmenuStatus', "closed");   
}
function raportsMenu() {

    if(sessionStorage.getItem('raportSubmenuStatus') === "closed") {
        document.getElementById('raportSubmenu').style.display = "block";
        document.getElementById('tableSubmenu').style.display="none";
        sessionStorage.setItem('raportSubmenuStatus', "opened");
    }
    else {
        document.getElementById('raportSubmenu').style.display = "none";
        sessionStorage.setItem('raportSubmenuStatus', "closed");   
    }
    sessionStorage.setItem('tableSubmenuStatus', "closed");
}

openMenu();