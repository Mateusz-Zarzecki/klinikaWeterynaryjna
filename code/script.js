const menu_toggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');

menu_toggle.addEventListener('click', () => {
    menu_toggle.classList.toggle('is-active');
    sidebar.classList.toggle('is-active');
})

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

// window.onload = function() {
//     let params = new URLSearchParams(window.location.search);
//     if (params.has('info')) {
//         alert(params.get('info'));
//     }
// };