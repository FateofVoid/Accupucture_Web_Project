///////////////////////////////////////
// javascript for navigation dropdown//
///////////////////////////////////////

function initializeNavigationDropdown() {
    console.log('initializeNavigationDropdown called');

    const mobileDropdownButton = document.querySelector('.mobile-dropdown-button');
    const header = document.querySelector('header');

    mobileDropdownButton.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent the event from propagating

        header.classList.toggle('expanded');
    });

    document.addEventListener('click', (e) => {
        if (!header.contains(e.target) && !mobileDropdownButton.contains(e.target)) {
            header.classList.remove('expanded');
        }
    });
}

/////////////////////////
// javascript for popup//
/////////////////////////

function initializePopup() {
    // Get references to the overlay and popup
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');

    // Get references to all elements with the "open-popup" class
    const openPopupButtons = document.querySelectorAll('.popup-button');

    // Function to show the popup
    function showPopup() {
        overlay.style.display = 'block';
        popup.style.display = 'block';
    }

    // Function to hide the popup
    function hidePopup() {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    }

    // Add click event listeners to all elements with the "open-popup" class
    openPopupButtons.forEach((button) => {
        button.addEventListener('click', showPopup);
    });

    // Add click event listener to the overlay to hide the popup
    overlay.addEventListener('click', hidePopup);
}

////////////////////////////////////////////
// JavaScript for custom language dropdown//
////////////////////////////////////////////

function initializeCustomDropdown() {

    const customSelect = document.getElementById('custom-select');
    const options = document.getElementById('options');
    const selectedOption = customSelect.querySelector('.selected-option');



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
            const langValue = this.getAttribute('data-value');
            const currentPage = getPageFromURL();
            // Update the language and page in the URL
            updateDropdownURL(langValue, currentPage);
            // Close the options
            options.classList.remove('show-options');
            location.reload();
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
}

// Function to extract language value from the URL
function getLanguageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('lang');
}

//////////////////////////////////
// javascript for page selection//
//////////////////////////////////

function initializePageDropdown() {
    const pageOptions = document.getElementById('page-options');
    let selectedPage = 'home'; // Set the default selected page


    const pageOptionElements = document.querySelectorAll('.page-option');
    pageOptionElements.forEach((pageOption) => {
        pageOption.addEventListener('click', function () {
            const pageValue = this.getAttribute('data-value');
            const currentLang = getLanguageFromURL();
            // Update the page and language in the URL
            updateDropdownURL(currentLang, pageValue);
            // Close the options
            pageOptions.classList.remove('show-options');
            location.reload();
        });
    });
}

function getPageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('page');
}

function setSessionPage(pageValue) {
    // You can add checks to ensure the pageValue is valid
    // For example, check against a list of valid pages
    const validPages = ['home', 'services', 'staff', 'certificate', 'privacy'];
    if (validPages.includes(pageValue)) {
        // Set the session value for the selected page
        // You can use the session variable as needed in your PHP code
        // For example: $_SESSION['selectedPage'] = $pageValue;
    }
}

function updateDropdownURL(langValue, pageValue) {
    // Get the current URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Update the URL with both lang and page parameters
    urlParams.set('lang', langValue);
    urlParams.set('page', pageValue);

    // Construct the new URL
    const newURL = `${window.location.pathname}?${urlParams.toString()}`;
    console.log("URL updated: " + newURL);

    // Update the URL without a full page refresh
    window.history.pushState({}, '', newURL);
}


///////////////////////////////////////////////
// Run the scripts when the document is ready//
///////////////////////////////////////////////

$(document).ready(function () {
console.log("Script loaded");

    initializeNavigationDropdown();
    initializePopup();
    initializeCustomDropdown();
    initializePageDropdown();
});