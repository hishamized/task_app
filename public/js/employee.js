// Get all navigation links
const navLinks = document.querySelectorAll('.nav-link');

// Get all content sections
const sections = document.querySelectorAll('.section-content');

// Hide all sections initially
sections.forEach((section) => {
    section.style.display = 'none';
});

// Add a click event listener to each link
navLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
        // Prevent the default behavior of the anchor tag
        event.preventDefault();

        // Remove the 'active' class from all links
        navLinks.forEach((navLink) => {
            navLink.classList.remove('active');
        });

        // Add the 'active' class to the clicked link
        link.classList.add('active');

        // Get the target section from the link's href attribute
        const targetSectionId = link.getAttribute('href').substring(1);

        // Hide all sections
        sections.forEach((section) => {
            section.style.display = 'none';
        });

        // Show the target section
        const targetSection = document.getElementById(targetSectionId);
        if (targetSection) {
            targetSection.style.display = 'block';
        }
    });
});