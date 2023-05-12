const menu = document.querySelector(".menu-bar");
const navList = document.querySelector("nav");
const links = document.querySelector(".nav-links li");
menu.addEventListener("click", () => {
    navList.classList.toggle("active");
    menu.classList.toggle("close");
});
const footer = document.querySelector('#footer');

// Listen for the scroll event
window.addEventListener('scroll', () => {
    // Check if the user has scrolled to the bottom of the page
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        // Show the footer
        footer.style.display = 'block';
    } else {
        // Hide the footer
        footer.style.display = 'none';
    }
});
const scrollToBottom = () => {
    const bottom = document.querySelector('#footer');
    bottom.scrollIntoView({ behavior: 'smooth' });
};

const goBottomLink = document.querySelector('a[href="#footer"]');
goBottomLink.addEventListener('click', scrollToBottom);


function confirmdelete(){
    return confirm("Vous etes sure ??")
}
