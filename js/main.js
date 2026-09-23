document.addEventListener("DOMContentLoaded", function(){

    if (document.querySelector(".home-card")){
        initHomeCards();
    }

    if (document.querySelector(".country-card")){
        initCountryPage();
    }

    if (document.querySelector("#select_country")){
        initCountrySelect();
    }

    if (document.querySelector("#compare_btn")){
        initCompareSelect();
    }

    if (document.querySelector(".compare-card")){
        initCompareCard();
    }
});

function initCountrySelect() {
    /*  - Lista Pa�ses
    Quando o usu�rio mudar o pa�s no <select> ir� pegar o pa�s escolhido e 
    redirecionar a p�gina passando o mesmo pela URL.    */

    const select_country = document.querySelector("#select_country");
    
    select_country.addEventListener('change', () => {
        const country = select_country.value;

        if (!country) {
            return;
        }

        window.location.href =
            `?route=country&country_name=${encodeURIComponent(country)}`;
    });
}

function initCompareSelect() {
    /* - Compara��o de Pa�ses
    Quando o usu�rio selecionar os dois pa�ses em cada <select> ir� redirecionar
    para compare.php.  */
    const compareBtn = document.querySelector("#compare_btn");

    compareBtn.addEventListener('click', () => {

        const country1 = document.querySelector("#country1").value;
        const country2 = document.querySelector("#country2").value;

        if (!country1 || !country2) {
            alert("Selecione dois pa�ses para comparar");
            return;
        }

        window.location.href =
            `?route=compare&country1=${country1}&country2=${country2}`;
    });
}

function initCountryPage() {
    const card = document.querySelector(".country-card");

    if (!card) {
        return;
    }

    aplicarCores(card);
}

function initHomeCards() {

    const cards = document.querySelectorAll(".home-card");

    cards.forEach(card => {
        aplicarCores(card);
    });
}

function initCompareCard() {

    const cards = document.querySelectorAll(".compare-card");

    if (!cards.length) {
        return;
    }

    cards.forEach(card => {
        aplicarCores(card);
    });
}

function aplicarCores(elemento) {

    const color1 = elemento.getAttribute("data-color-1");
    const color2 = elemento.getAttribute("data-color-2");

    if (!color1 || !color2) {
        return;
    }

    const gradient = `linear-gradient(45deg, ${color1}, ${color2})`;

    elemento.dataset.gradient = gradient;
    elemento.style.setProperty("--gradient", gradient);
}