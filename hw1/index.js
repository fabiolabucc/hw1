//nav
let timeout;

function comparsaMenu(event) {
    clearTimeout(timeout);
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

function uscitaMenu(event) {
    timeout = setTimeout(() => {
        const activeMenus = document.querySelectorAll('.nav-comparsa');
        for (let i = 0; i < activeMenus.length; i++) {
            if (!activeMenus[i].matches(':hover')) {
                activeMenus[i].style.display = 'none';
            }
        }
    }, 100);
}

const navLinks = document.querySelectorAll('#link_nav1 > .nav-items > a');

for (let i = 0; i < navLinks.length; i++) {
    navLinks[i].addEventListener('mouseenter', comparsaMenu);
    navLinks[i].addEventListener('mouseleave', uscitaMenu);
}

document.querySelector('#link_nav1').addEventListener('mouseleave', uscitaMenu);

const comparsaElements = document.querySelectorAll('.nav-comparsa');
for (let i = 0; i < comparsaElements.length; i++) {
    comparsaElements[i].addEventListener('mouseenter', () => clearTimeout(timeout));
    comparsaElements[i].addEventListener('mouseleave', uscitaMenu);
}

//menu 4
const userIcon = document.querySelector('#user');
const menu = document.querySelector('#menu5');

function toggleMenu() {
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}

userIcon.addEventListener('click', function(event) {
    event.stopPropagation();
    toggleMenu();
});

document.addEventListener('click', function(event) {
    if (menu.style.display == 'block' && !menu.contains(event.target) && !userIcon.contains(event.target)) {
        menu.style.display = 'none';
    }
});






//section1

//riquadro 1
let img_riquadro1 = document.getElementById('img_riquadro1');

function img_riquadro1_mouseover(event){
    const nuovoSrc = img_riquadro1.getAttribute('data-nuovo-src');
    img_riquadro1.src = nuovoSrc;
    img_riquadro1.classList.add('img_mouseover');
} 

function img_riquadro1_mouseout(event){
   const vecchioSrc = img_riquadro1.getAttribute('data-src');
   img_riquadro1.src = vecchioSrc;
   img_riquadro1.classList.remove('img_mouseover');
}

img_riquadro1.addEventListener('mouseover', img_riquadro1_mouseover);
img_riquadro1.addEventListener('mouseout', img_riquadro1_mouseout);

//riquadro2
function img_riquadro2_mouseover(event)
{
    const new_img = document.createElement('img');
    new_img.src = '\\hw1\\img\\toy2.jpeg';
  
    new_img.classList.add('img_mouseover');

    const container = document.querySelector('#container_riquadro2');
    container.innerHTML = '';
    container.appendChild(new_img);
}

const img_riquadro2 = document.querySelector('#img_riquadro2');
img_riquadro2.addEventListener('mouseover', img_riquadro2_mouseover);

//riquadro3
function mostra_img_riquadro3(event){
    const image = event.currentTarget;
    image.removeEventListener('click', mostra_img_riquadro3);

    const img_riquadro3 = document.querySelector('#img_riquadro3');
    const newimg_riquadro3 = document.querySelector('#newimg_riquadro3');
    img_riquadro3.classList.add('hidden');
    newimg_riquadro3.classList.remove('hidden');
}

const img_riquadro3 = document.querySelector('#img_riquadro3');
img_riquadro3.addEventListener('click', mostra_img_riquadro3);

//riquadro4
function mostra_img_riquadro4(event){
    const image = event.currentTarget;
    image.removeEventListener('click', mostra_img_riquadro4);

    const img_riquadro4 = document.querySelector('#img_riquadro4');
    const newimg_riquadro4 = document.querySelector('#newimg_riquadro4');
    img_riquadro4.classList.add('hidden');
    newimg_riquadro4.classList.remove('hidden');
}

const img_riquadro4 = document.querySelector('#img_riquadro4');
img_riquadro4.addEventListener('click', mostra_img_riquadro4);




//section 4 data
function dataClick(event) {
    const target = event.currentTarget;
    const tipo = target.getAttribute('data-tipo');
    alert('Tipo di dato cliccato: ' + tipo);
}

const containers = document.querySelectorAll('.Section4_riquadri_container');

for (const container of containers) {
    container.addEventListener('click', dataClick);
}










