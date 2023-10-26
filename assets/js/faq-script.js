let questions = document.querySelectorAll(".question");

for (let question of questions) {
    question.addEventListener("click", (event) => {
        // Toggle active class on the parent .question element
        question.classList.toggle("active");

        if (question.nextElementSibling.style.maxHeight == "0px") {
            question.nextElementSibling.style.maxHeight = question.nextElementSibling.scrollHeight + "px";
            question.nextElementSibling.style.padding = "0.35vw"; // Apply padding
        } else {
            question.nextElementSibling.style.maxHeight = "0px";
            question.nextElementSibling.style.padding = "0px"; // Apply padding
        }
    });
}

$(document).ready(function() {
    // Get all the sections within the "sections" div
    const sections = $(".sections > section");

    // Loop through the sections and assign alternating classes
    sections.each(function(index) {
        if (index % 2 === 0) {
            $(this).addClass("even-section");
        } else {
            $(this).addClass("odd-section");
        }
    });
});

// JavaScript for custom language dropdown
const customSelect = document.getElementById('custom-select');
const options = document.getElementById('options');
const selectedOption = customSelect.querySelector('.selected-option');

// Function to extract language value from the URL
function getLanguageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('lang');
}

// Function to set the selected option based on the language value
function setSelectedOptionFromURL() {
    const language = getLanguageFromURL();
    if (language) {
        optionElements.forEach((option) => {
            if (option.getAttribute('data-value') === language) {
                selectedOption.innerHTML = option.innerHTML;
            }
        });
    }
}

customSelect.addEventListener('click', function () {
    options.classList.toggle('show-options');
});

const optionElements = document.querySelectorAll('.option');
optionElements.forEach((option) => {
    option.addEventListener('click', function () {
        const value = this.getAttribute('data-value');
        // Set the selected value
        selectedOption.innerHTML = this.innerHTML;
        // Update the language
        window.location.href = '?lang=' + value;
        // Close the options
        options.classList.remove('show-options');
    });
});

// Close the options when clicking outside
document.addEventListener('click', function (e) {
    if (!customSelect.contains(e.target)) {
        options.classList.remove('show-options');
    }
});

// Set the selected option based on the URL on page load
setSelectedOptionFromURL();