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
        window.location.href = `?route=country&country_name=`+country;
    })
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

function initCountryPage(){

    const card = document.querySelector(".country-card");
    if(!card) return;

    const img = card.querySelector("img");

    if(img.complete){
        aplicarCores(img, card);
    }else{
        img.addEventListener("load", () => aplicarCores(img, card));
    }

}

function initHomeCards() {

    const cards = document.querySelectorAll(".home-card");

    cards.forEach(card => {

        const img = card.querySelector(".country-flag");

        if (img.complete) {
            aplicarCores(img, card);
        } else {
            img.addEventListener("load", () => aplicarCores(img, card));
        }

    });
}

function initCompareCard(){

    const cards = document.querySelectorAll(".compare-card");
    if(!cards.length) return;

    cards.forEach(card => {

        const img = card.querySelector("img");        
        if(img.complete){
            aplicarCores(img, card);
        }else{
            img.addEventListener("load", () => aplicarCores(img, card));
        }

    });

}

function aplicarCores(img, elemento) {
    const colorThief = new ColorThief();

    const palette = colorThief.getPalette(img, 2);

    const c1 = `rgb(${palette[0][0]},${palette[0][1]},${palette[0][2]})`;
    const c2 = `rgb(${palette[1][0]},${palette[1][1]},${palette[1][2]})`;

    const gradient = `linear-gradient(45deg, ${c1}, ${c2})`;

    elemento.dataset.gradient = gradient;
    elemento.style.setProperty("--gradient", gradient);
}