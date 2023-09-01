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