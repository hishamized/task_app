(function () {

    const adminDashboard = document.getElementById('admin-dashboard');

    if (!adminDashboard) {
        return;
    }


    const navLinks = adminDashboard.querySelectorAll('.nav-link');


    const sections = adminDashboard.querySelectorAll('.section-content');


    sections.forEach((section) => {
        section.style.display = 'none';
    });


    navLinks.forEach((link) => {
        link.addEventListener('click', (event) => {

            event.preventDefault();


            navLinks.forEach((navLink) => {
                navLink.classList.remove('active');
            });


            link.classList.add('active');


            const targetSectionId = link.getAttribute('href').substring(1);


            sections.forEach((section) => {
                section.style.display = 'none';
            });


            const targetSection = adminDashboard.querySelector(`#${targetSectionId}`);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });


    navLinks.forEach((link) => {
        link.style.cursor = 'pointer';
    });
})();



 function toggleFormVisibility() {
    var editForm = document.getElementById("editProjectForm");
    var toggleButton = document.getElementById("toggleEditForm");


    if (editForm.style.display === "none" || editForm.style.display === "") {

        editForm.style.display = "block";
        toggleButton.textContent = "Hide Form";
    } else {

        editForm.style.display = "none";
        toggleButton.textContent = "Edit Project";
    }
}


const toggleFormButton = document.getElementById('addPeopleButton');
const addPeopleForm = document.getElementById('addPeopleForm');

toggleFormButton.addEventListener('click', () => {
    if (addPeopleForm.style.display === 'none') {
        addPeopleForm.style.display = 'block';
    } else {
        addPeopleForm.style.display = 'none';
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

document.getElementById('showTaskFormButton').addEventListener('click', function() {
    var taskForm = document.getElementById('taskForm');
    if (taskForm.style.display === 'none' || taskForm.style.display === '') {
        taskForm.style.display = 'block';
    } else {
        taskForm.style.display = 'none';
    }
});
