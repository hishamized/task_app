
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

     // Function to toggle the form visibility
     function toggleFormVisibility() {
        var editForm = document.getElementById("editProjectForm");
        var toggleButton = document.getElementById("toggleEditForm");

        // Check if the form is currently visible
        if (editForm.style.display === "none" || editForm.style.display === "") {
            // Show the form and update the button text
            editForm.style.display = "block";
            toggleButton.textContent = "Hide Form";
        } else {
            // Hide the form and update the button text
            editForm.style.display = "none";
            toggleButton.textContent = "Edit Project";
        }
    }


    const toggleFormButton = document.getElementById('addPeopleButton');
    const addPeopleForm = document.getElementById('addPeopleForm');

    toggleFormButton.addEventListener('click', () => {
        if (addPeopleForm.style.display === 'none') {
            addPeopleForm.style.display = 'block'; // Show the form
        } else {
            addPeopleForm.style.display = 'none'; // Hide the form
        }
    });

    const removeButtons = document.querySelectorAll('.remove-mate-button');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const removalUrl = this.getAttribute('data-removal-url');
            if (confirm('Are you sure you want to remove this user from the project?')) {
                window.location.href = removalUrl;
            }
        });
    });
