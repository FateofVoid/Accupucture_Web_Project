///////////////////////
// javascript for faq//
///////////////////////

function initializeFAQ() {
    // Your FAQ script here

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
}

///////////////////////////////////////////////
// Run the scripts when the document is ready//
///////////////////////////////////////////////

$(document).ready(function () {
    initializeFAQ();
});