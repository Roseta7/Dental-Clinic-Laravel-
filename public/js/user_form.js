
// Show/hide conditional section based on role
document.addEventListener("DOMContentLoaded",function () {

    const roleSelect = document.getElementById("role");
    const conditionalSection = document.getElementById("conditional-section");
    const experienceInput = document.getElementById("experience");
    const expValue = document.getElementById("exp-value");
    const specialtyInput = document.getElementById("specialty");

    function toggleConditionalSection(){

        if(roleSelect.value === "dentist") {
            conditionalSection.classList.add("visible");
        } else {
            conditionalSection.classList.remove("visible");
            // Clear irrelevant fields to prevent wrong data being submitted.
            specialtyInput.value = "";
            experienceInput.value = 0;
            expValue.textContent = "0";
        }
    }

    //show the section when the page loads according to the current value.
    toggleConditionalSection();

    //When changing roles.
    roleSelect.addEventListener("change", toggleConditionalSection);

    // Restrict the value and update the display.
    experienceInput.addEventListener("input", function () {
        let value = parseInt(this.value);
        if (isNaN(value)) value = 0;
        if (value < 0) value = 0;
        if (value > 50) value = 50;
        this.value = value;
        expValue.textContent = value;
    });
});


