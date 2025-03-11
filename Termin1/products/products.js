document.addEventListener("DOMContentLoaded", function () {
    function validateRange(container) {
        const minValue = container.querySelector("#min-value");
        const maxValue = container.querySelector("#max-value");
        const rangeFill = container.querySelector(".range-fill");
        const inputElements = container.querySelectorAll(".range-slider input");

        if (!minValue || !maxValue || !rangeFill || inputElements.length < 2) return;

        let minPrice = parseInt(inputElements[0].value);
        let maxPrice = parseInt(inputElements[1].value);

        // Ensure min value does not exceed max value
        if (minPrice > maxPrice) {
            let tmpValue = maxPrice;
            maxPrice = minPrice;
            minPrice = tmpValue;
        }

        // Calculate percentage position
        const minPercent = ((minPrice - 10) / 9990) * 100;
        const maxPercent = ((maxPrice - 10) / 9990) * 100;

        // Update fill position
        rangeFill.style.left = minPercent + "%";
        rangeFill.style.width = (maxPercent - minPercent) + "%";

        // Update displayed values
        minValue.innerHTML = "€" + minPrice;
        maxValue.innerHTML = "€" + maxPrice;
    }

    function initSlider(container) {
        const inputElements = container.querySelectorAll(".range-slider input");
        if (inputElements.length < 2) return;

        inputElements.forEach((element) => {
            element.addEventListener("input", function () {
                validateRange(container);
            });
        });

        validateRange(container); // Initialize values on page load
    }

    // Initialize sliders for both the main sidebar and offcanvas
    initSlider(document);

    // When the Offcanvas opens, initialize sliders inside it
    document.getElementById("filterOffcanvas").addEventListener("shown.bs.offcanvas", function () {
        initSlider(this);
    });
});
