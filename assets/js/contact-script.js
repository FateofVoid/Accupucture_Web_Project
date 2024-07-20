document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("DOMContentLoaded", function() {
        var iframe = document.getElementById('inline-contact-form');
        var contactContent = document.getElementById('contact_form_section');

        // Create a ResizeObserver to detect changes in the iframe's size
        var resizeObserver = new ResizeObserver(entries => {
            for (let entry of entries) {
                // Adjust the height of the parent container to match the iframe's content
                contactContent.style.height = entry.contentRect.height + 'px';
            }
        });

        // Start observing the iframe element
        resizeObserver.observe(iframe);
    });
});