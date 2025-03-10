let minValue = document.getElementById("min-value");
let maxValue = document.getElementById("max-value");

const rangeFill = document.querySelector(".range-fill");

// function to validate range and update fill
function validateRange(){
    let minPrice = parseInt(inputElements[0].value);
    let maxPrice = parseInt(inputElements[1].value);

    // swap values
    if(minPrice > maxPrice) {
        let tmpValue = maxPrice;
        maxPrice = minPrice;
        minPrice = tmpValue;
    }

    // prercentage position 
    const minPercent = ((minPrice - 10) / 9990) * 100;
    const maxPercent = ((maxPrice - 10) / 9990) * 100;

    // set position and width of fill
    rangeFill.style.left = minPercent + "%";
    rangeFill.style.width = maxPercent - minPercent + "%";

    // update displayed values
    minValue.innerHTML = "€" + minPrice;
    maxValue.innerHTML = "€" + maxPrice;
}

// references to the input elements
const inputElements = document.querySelectorAll(".range-slider input");

// event listener to input elements
inputElements.forEach((element) => {
    element.addEventListener("input", validateRange);
});