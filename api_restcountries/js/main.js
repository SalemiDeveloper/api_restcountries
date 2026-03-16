document.addEventListener("DOMContentLoaded", function(){

    if (document.querySelector(".country-card")){
        initCountryCards();
    }

    if (document.querySelector(".card-teste")){
        initCountryPage();
    }

    if (document.querySelector("#select_country")){
        initCountrySelect();
    }

    if (document.querySelector("#compare_btn")){
        initCompareSelect();
    }
});

function initCountrySelect() {
    /*  - Lista Países
    Quando o usuário mudar o país no <select> irá pegar o país escolhido e 
    redirecionar a página passando o mesmo pela URL.    */

    const select_country = document.querySelector("#select_country");
    
    select_country.addEventListener('change', () => {
        const country = select_country.value;
        window.location.href = `?route=country&country_name=`+country;
    })
}

function initCompareSelect() {
    /* - Comparação de Países
    Quando o usuário selecionar os dois países em cada <select> irá redirecionar
    para compare.php.  */
    const compareBtn = document.querySelector("#compare_btn");

    compareBtn.addEventListener('click', () => {

        const country1 = document.querySelector("#country1").value;
        const country2 = document.querySelector("#country2").value;

        if (!country1 || !country2) {
            alert("Selecione dois países para comparar");
            return;
        }

        window.location.href =
            `?route=compare&country1=${country1}&country2=${country2}`;
    });
}

function initCountryCards() {
    /* - Estatísticas Globais
    Implementação do hover no CSS.  */
    const colorThief = new ColorThief();

    const cards = document.querySelectorAll(".country-card");

    cards.forEach(card => {

        const img = card.querySelector(".country-flag");

        function aplicarCores(){

            const palette = colorThief.getPalette(img, 2);
            const c1 = `rgb(${palette[0][0]},${palette[0][1]},${palette[0][2]})`;
            const c2 = `rgb(${palette[1][0]},${palette[1][1]},${palette[1][2]})`;
            const gradient = `linear-gradient(45deg, ${c1}, ${c2})`;

            card.dataset.gradient = gradient;
            card.style.setProperty("--gradient", gradient);

        }

        if (img.complete) {
            aplicarCores();
        } else {
            img.addEventListener("load", aplicarCores);
        }

    });
}

// CONSERTAR - NÃO ESTÁ FUNCIONANDO
function initCountryPage(){

    /* - country.php
       Implementando gradiente na borda.
    */
    const img = document.querySelector(".card-teste");

    const colorThief = new ColorThief();

    function aplicarCores(){

        const palette = colorThief.getPalette(img, 2);

        const c1 = `rgb(${palette[0][0]},${palette[0][1]},${palette[0][2]})`;
        const c2 = `rgb(${palette[1][0]},${palette[1][1]},${palette[1][2]})`;

        const gradient = `linear-gradient(45deg, ${c1}, ${c2})`;

        img.style.setProperty("--country-gradient", gradient);
    }

    if(img.complete){
        aplicarCores();
    }else{
        img.addEventListener("load", aplicarCores);
    }

}