let hamburgerMenuIcon = document.getElementById("hamburgerMenu");

function hamburgerMenu() {
    hamburgerMenuIcon.classList.remove("-right-full");
    hamburgerMenuIcon.classList.add("right-0");
}

function removeHamburgerMenu() {
    hamburgerMenuIcon.classList.remove("right-0");
    hamburgerMenuIcon.classList.add("-right-full");
}