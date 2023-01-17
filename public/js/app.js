const toggleMenus = document.querySelector(".toggle-button input");
const nav = document.querySelector(".navigation-bar .navbar-menus");
const navigation = document.getElementById('body');
const content = document.getElementById('content')
toggleMenus.addEventListener("click", function () {
    nav.classList.toggle("nav-active")
    content.classList.toggle('wrapper-active');
    navigation.classList.toggle('nav-fixed')
});


const activePage = window.location.pathname;
const navLink = document.querySelectorAll('.list-menus a').forEach(link => {

    aHref = link.href.split('/')
    pageLink = activePage.split('/')

    if (activePage == '/') {
        document.getElementById('dashboard').classList.add('light-border-nav');
        document.getElementById('dashboard').classList.add('active-link');

    } else {
        if (aHref[3].includes(`${pageLink[1]}`)) {
            link.classList.add('active-link')
        }
    }
});


