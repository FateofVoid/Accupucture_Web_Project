
var validLanguages = ['en', 'nl'];
var validPages = ['home', 'services', 'staff', 'contact', 'privacy'];

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
    const langParam = urlParams.get('lang');
    // Check if langParam is in the validLanguages array
    if (langParam && validLanguages.includes(langParam)) {
        return langParam;
    } else {
        return validLanguages ? validLanguages[0] : 'nl'; // Return null or handle invalid case as needed
    }
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

            // Scroll to the top
            window.scrollTo(0, 0);

            // Reload the page
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
    const pageParam = urlParams.get('page');
    if (pageParam && validPages.includes(pageParam)) {
        return pageParam;
    } else {
        return validPages ? validPages[0] : 'home'; // Return null or handle invalid case as needed
    }
    return urlParams.get('page');
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

//////////////////////////////////////
// javascript for expandable message//
//////////////////////////////////////

function initializeExpandableMessage() {
    const expandableTitles = document.querySelectorAll('.expandable_title');

    expandableTitles.forEach(title => {
        title.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default behavior of anchor tags or buttons

            console.log('Expandable title clicked'); // Check if click event is being captured

            const expandableMessage = this.nextElementSibling;
            const isActive = this.classList.contains('active');
            const headerHeight = document.querySelector('header').offsetHeight; // Get the height of the header
            const scrollOffset = 20; // Adjust this value to your preference

            // Toggle current expandable message
            if (isActive) {
                console.log('Active class removed'); // Log when active class is removed
                this.classList.remove('active');
                expandableMessage.style.display = 'none';
            } else {
                console.log('Active class added'); // Log when active class is added
                this.classList.add('active');
                expandableMessage.style.display = 'block';

                // Wait for the transition to complete before scrolling
                setTimeout(() => {
                    // Get the top position of the active title
                    const titleTop = this.getBoundingClientRect().top + window.pageYOffset;

                    // Calculate the target scroll position considering the header height
                    const targetScrollPosition = titleTop - headerHeight - scrollOffset;

                    console.log('Scrolling to:', targetScrollPosition); // Log the target scroll position

                    // Scroll to the target position
                    window.scrollTo({
                        top: targetScrollPosition,
                        behavior: 'smooth' // Optionally, use smooth scrolling
                    });
                }, 300); // Adjust the delay if necessary
            }

            // Close all other expandable messages
            expandableTitles.forEach(otherTitle => {
                if (otherTitle !== this && otherTitle.classList.contains('active')) {
                    console.log('Active class removed from other expandable messages'); // Log when active class is removed from other messages
                    otherTitle.classList.remove('active');
                    otherTitle.nextElementSibling.style.display = 'none';
                }
            });
        });
    });
}

/////////////////////////////////////////
// javascript for adjustable margin top//
/////////////////////////////////////////

function adjustMarginTopToHeader() {
    console.log('adjustMarginTopToHeader function called'); // Check if the function is being called

    // Check if the DOM content is loaded
    if (document.readyState === 'loading') {
        console.log('DOM content is still loading');
    } else {
        console.log('DOM content is already loaded');
        setMarginTop();
    }

    // Add event listener for window onload event
    window.addEventListener('load', function() {
        console.log('Window onload event triggered'); // Check if the window onload event is triggered
        setMarginTop();
    });
}

function setMarginTop() {
    // Get the actual height of the header
    const header = document.querySelector('header');
    console.log('Header element:', header); // Check if the header element is selected
    if (header) {
        const headerHeight = header.offsetHeight;

        // Set the height of the margin to match the header height
        const marginTop = document.querySelector('.margin-top');
        console.log('Margin top element:', marginTop); // Check if the margin top element is selected
        if (marginTop) {
            marginTop.style.height = `${headerHeight}px`;
            console.log('Margin top height set successfully'); // Confirm that margin top height is set
        } else {
            console.log('Margin top element not found'); // Log a message if margin top element is not found
        }
    } else {
        console.log('Header element not found');
    }
}

///////////////////////////////////////////////
// Run the scripts when the document is ready//
///////////////////////////////////////////////

$(document).ready(function () {
    console.log("Script loaded");


    initializeNavigationDropdown();
    initializeExpandableMessage();
    initializeCustomDropdown();
    initializePageDropdown();
    adjustMarginTopToHeader();

});

