const quickViewButtons = document.querySelectorAll('.image-text-button');
const fullwidthCards = document.querySelectorAll('.fullwidth');
let openIndex = -1; // Initialize to -1, indicating no card is open initially.

const openQuickView = (index) => {
    quickViewButtons[index].classList.add('is-selected');
    fullwidthCards[index].classList.remove('is-hidden');
    fullwidthCards[index].setAttribute('tabIndex', '0');
};

const closeQuickView = (index) => {
    quickViewButtons[index].classList.remove('is-selected');
    fullwidthCards[index].classList.add('is-hidden');
    fullwidthCards[index].removeAttribute('tabIndex');
};

quickViewButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        if (openIndex !== -1) {
            // Close the previously opened description.
            closeQuickView(openIndex);
        }

        if (openIndex !== index) {
            // If a different button is clicked, open its description.
            openQuickView(index);
            openIndex = index; // Update the openIndex.
        } else {
            // If the same button is clicked again, close it.
            openIndex = -1; // Reset openIndex.
        }
    });
});