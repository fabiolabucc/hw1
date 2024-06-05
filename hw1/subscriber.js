//nav
//funzione quando cursore si mette su un link del nav , seleziona solo il menu a comparsa di quel link del nav
function comparsaMenu(event) {
    const linkMenu = event.target;
    const comparsaCorrispondente = linkMenu.nextElementSibling;
    if (comparsaCorrispondente && comparsaCorrispondente.classList.contains('nav-comparsa')) {
        const menuComparsa = document.querySelectorAll('.nav-comparsa');
        for (let i = 0; i < menuComparsa.length; i++) {
            menuComparsa[i].style.display = 'none';
        }
        comparsaCorrispondente.style.display = 'block';
    }
}

// Funzione quando il cursore si toglie da un link del nav o dal menu a comparsa
function uscitaMenu(event) {
    const target = event.target;
    if (!target.closest('.nav-comparsa') && !target.closest('.nav-items > a')) {
        const menuComparsa = document.querySelectorAll('.nav-comparsa');
        for (let i = 0; i < menuComparsa.length; i++) {
            menuComparsa[i].style.display = 'none';
        }
    }
}

const navLinks = document.querySelectorAll('#link_nav1 > .nav-items > a');

for (let i = 0; i < navLinks.length; i++) {
    navLinks[i].addEventListener('mouseenter', comparsaMenu);
}

//aggiungo la funzione pure ai link del nav e non solo ai menu
document.querySelector('#link_nav1').addEventListener('mouseleave', uscitaMenu);

const comparsaElements = document.querySelectorAll('.nav-comparsa');
for (let i = 0; i < comparsaElements.length; i++) {
    comparsaElements[i].addEventListener('mouseleave', uscitaMenu);
}