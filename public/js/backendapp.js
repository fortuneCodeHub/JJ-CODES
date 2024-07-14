/**
 * offcanvas navbar
 */
const navbarBtns = document.querySelectorAll('.nav-btn');
const navBg = document.querySelector('.side-nav-bg');
const sideBar = document.querySelector(".side-bar")
const toggle = (function () {
    return function toggle() {
        navbarBtns.forEach(navbarBtn => { 
            navbarBtn.addEventListener("click", function () {
                navBg.classList.toggle("open");
                sideBar.classList.toggle("open");
                console.log(navBg.classList);
            });
        });
    };
})();
toggle();