const slider = document.getElementById('slider');
const slides = document.querySelectorAll('.slide');
const indicatorsContainer = document.getElementById('indicators');

let index = 0;

slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    if (i === 0) dot.classList.add('active');
    dot.addEventListener('click', () => goToSlide(i));
    indicatorsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

function goToSlide(i) {
    index = i;
    updateSlider();
}

function nextSlide() {
    index = (index + 1) % slides.length;
    updateSlider();
}

function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

setInterval(nextSlide, 3000); 

document.querySelectorAll('.dev-comments-slider').forEach(slider => {
    const comments = slider.querySelectorAll('.dev-comment');
    let idx = 0;
    setInterval(() => {
        comments[idx].classList.remove('active');
        idx = (idx + 1) % comments.length;
        comments[idx].classList.add('active');
    }, 3500);
});

document.addEventListener('DOMContentLoaded', () => {

    const carrosselInner = document.querySelector('.carrossel-inner');
    const items = document.querySelectorAll('.gallery-item-group');
    const totalItems = items.length;
    let currentIndex = 0;

    // Função que move o carrossel para o slide correto
    function updateCarrossel() {
        // Move o contêiner interno para a esquerda
        // A posição é calculada multiplicando o índice atual pela largura de 100%
        carrosselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    // Função para mostrar o próximo slide
    function showNextItem() {
        currentIndex = (currentIndex + 1) % totalItems;
        updateCarrossel();
    }

    setInterval(showNextItem, 5000);

});