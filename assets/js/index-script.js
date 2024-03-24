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
/*
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
*/
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

    // Add an event listener for the popstate event
    window.addEventListener('popstate', function (event) {
        console.log("url back loaded");
        location.reload();
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

function getTitleForPage(page) {
    // Customize this function to return the appropriate title for each page
    switch (page) {
        case 'home':
            return 'Heng Ren Tang - Home Page';
        case 'services':
            return 'Heng Ren Tang - Services';
        case 'staff':
            return 'Heng Ren Tang - Staff';
        case 'certificate':
            return 'Heng Ren Tang - Certificate';
        case 'privacy':
            return 'Heng Ren Tang - Privacy';
        default:
            return 'Heng Ren Tang'; // Default title for unknown pages
    }
}

//////////////////////////////////
// javascript for expandabl list//
//////////////////////////////////

function initializeExpandableMessage() {

    document.addEventListener('DOMContentLoaded', function () {
        const expandableTitles = document.querySelectorAll('.expandable_title');

        expandableTitles.forEach(title => {
            title.addEventListener('click', function () {
                console.log('Expandable title clicked'); // Log a message when the title is clicked

                const expandableMessage = this.nextElementSibling;
                const isActive = this.classList.contains('active');

                // Close all other expandable messages
                expandableTitles.forEach(otherTitle => {
                    if (otherTitle !== this && otherTitle.classList.contains('active')) {
                        otherTitle.classList.remove('active');
                        otherTitle.nextElementSibling.style.display = 'none';
                    }
                });

                // Toggle current expandable message
                if (isActive) {
                    this.classList.remove('active');
                    expandableMessage.style.display = 'none';
                    console.log('Expandable message closed'); // Log a message when the message is closed
                } else {
                    this.classList.add('active');
                    expandableMessage.style.display = 'block';
                    console.log('Expandable message opened'); // Log a message when the message is opened
                }
            });
        });
    });
}

//////////////////////////////////////
// javascript for expandable message//
//////////////////////////////////////

function initializeExpandableMessage() {
    const expandableTitles = document.querySelectorAll('.expandable_title');

    expandableTitles.forEach(title => {
        title.addEventListener('click', function () {
            console.log('Expandable title clicked'); // Check if click event is being captured

            const expandableMessage = this.nextElementSibling;
            const isActive = this.classList.contains('active');
            const headerHeight = document.querySelector('header').offsetHeight; // Get the height of the header
            const scrollOffset = 20; // Adjust this value to your preference

            // Toggle current expandable message
            if (isActive) {
                this.classList.remove('active');
                expandableMessage.style.display = 'none';
            } else {
                this.classList.add('active');
                expandableMessage.style.display = 'block';
            }

            // Close all other expandable messages
            expandableTitles.forEach(otherTitle => {
                if (otherTitle !== this && otherTitle.classList.contains('active')) {
                    otherTitle.classList.remove('active');
                    otherTitle.nextElementSibling.style.display = 'none';
                }
            });

            // Wait for the transition to complete before scrolling
            setTimeout(() => {
                // Get the top position of the active title
                const titleTop = this.getBoundingClientRect().top + window.pageYOffset;

                // Calculate the target scroll position considering the header height
                const targetScrollPosition = titleTop - headerHeight - scrollOffset;

                // Scroll to the target position
                window.scrollTo({
                    top: targetScrollPosition,
                    behavior: 'smooth' // Optionally, use smooth scrolling
                });
            }, 300); // Adjust the delay if necessary
        });
    });
}

function adjustMarginTopToHeader() {
    window.onload = function() {
        // Get the actual height of the header
        const header = document.querySelector('header');
        const headerHeight = header.offsetHeight;

        // Set the height of the margin to match the header height
        const marginTop = document.querySelector('.margin-top');
        marginTop.style.height = `${headerHeight}px`;
    };
}

///////////////////////////////////////////////
// Run the scripts when the document is ready//
///////////////////////////////////////////////

$(document).ready(function () {
    console.log("Script loaded");

    adjustMarginTopToHeader();
    initializeNavigationDropdown();
    initializeExpandableMessage();
    initializeCustomDropdown();
    initializePageDropdown();
    document.title = getTitleForPage(getPageFromURL());

});

