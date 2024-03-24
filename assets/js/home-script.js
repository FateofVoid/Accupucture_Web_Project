///////////////////////
// javascript for faq//
///////////////////////

function initializeSectionStyling() {
    // Your FAQ script here
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

//////////////////////////////////
// javascript for page selection//
//////////////////////////////////

function initializeHomePageSelect() {
    const pageOptions = document.getElementById('image-text-button');
    let selectedPage = 'home'; // Set the default selected page


    const pageOptionElements = document.querySelectorAll('.image-text-button');
    pageOptionElements.forEach((pageOption) => {
        pageOption.addEventListener('click', function () {
            const pageValue = this.getAttribute('data-value');
            const currentLang = getLanguageFromURL();
            // Update the page and language in the URL
            updateDropdownURL(currentLang, pageValue);
            // Close the options
            location.reload();
        });
    });
}

// Function to extract language value from the URL
function getLanguageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('lang');
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
    initializeSectionStyling();
    initializeHomePageSelect();
});