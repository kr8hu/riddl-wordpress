//iframe ablak, amiben a react app kerül megnyitásra
const element = document.getElementById('app');

//Oldal betöltést követően lefutó funkciók
window.addEventListener('load', () => {
    const offset = 50;
    const elementTop = element.getBoundingClientRect().top + window.pageYOffset;
    const targetPosition = elementTop - offset;

    window.scrollTo({
        behavior: 'smooth',
        top: targetPosition
    });

    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        const containerElem = document.getElementById("container");
        const bodyElem = document.getElementById("body");

        containerElem.style.backgroundColor = "#202020";
        bodyElem.style.backgroundColor = "#202020";
    }
});

