document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup-form");

    form.addEventListener("submit", function (event) {
        let valid = true;
        const name = form.querySelector("#name").value;
        const email = form.querySelector("#email").value;
        const username = form.querySelector("#username").value;
        const phoneCountryCode = form.querySelector(
            "#phone_country_code"
        ).value;
        const phoneNumber = form.querySelector("#phone_number").value;
        const password = form.querySelector("#password").value;
        const confirmPassword = form.querySelector(
            "#password_confirmation"
        ).value;

        const errorMessages = form.querySelectorAll(".error-message");
        errorMessages.forEach((error) => error.remove());

        if (
            !name ||
            !email ||
            !username ||
            !phoneCountryCode ||
            !phoneNumber ||
            !password ||
            !confirmPassword
        ) {
            valid = false;
            alert("All fields are required.");
        }

        if (password.length < 8) {
            valid = false;
            alert("Password must be at least 8 characters.");
        }

        const countryCodePattern =
        /^[+]\d{1,4}$/;

        function isValidCountryCode(phoneCountryCode) {
            return countryCodePattern.test(phoneCountryCode);
        }

        if (isValidCountryCode(phoneCountryCode)) {
            console.log("is a valid country code.");
        } else {
            alert("Phone country code is invalid.");
        }

        if (phoneNumber.length !== 10) {
            valid = false;
            alert("Phone number must be 10 digits.");
        }

        if (password !== confirmPassword) {
            valid = false;
            alert("Passwords do not match.");
        }

        if (username.length < 8) {
            valid = false;
            alert("Username must be at least 8 characters.");
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function (event) {
        const loginCredential = document.getElementById('login_credential').value;
        const password = document.getElementById('password').value;

        if (loginCredential.trim() === '' || password.trim() === '') {
            alert('Username and password cannot be empty.');
            event.preventDefault();
        } else if (loginCredential.length < 8) {
            alert('Username should be at least 8 characters.');
            event.preventDefault();
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const showProfileFormButton = document.getElementById('showProfileFormButton');
    const profileCreationForm = document.getElementById('profileCreationForm');

    showProfileFormButton.addEventListener('click', function () {

        if (profileCreationForm.style.display === 'none' || profileCreationForm.style.display === '') {
            profileCreationForm.style.display = 'block';
        } else {
            profileCreationForm.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const createProfileForm = document.getElementById('createProfileForm');
    const skillsInput = document.getElementById('skills');

    createProfileForm.addEventListener('submit', function(event) {
        let isValid = true;


        const formFields = createProfileForm.querySelectorAll('input, textarea');
        formFields.forEach(function(field) {
            const fieldValue = field.value.trim();


            if (field.id !== 'profile_picture') {
                if (fieldValue === '') {
                    isValid = false;
                }
            }
        });


        const skillsValue = skillsInput.value.trim();
        const skillsPattern = /^[a-zA-Z0-9\s]+(?:,\s*[a-zA-Z0-9\s]+)*$/
        ;
        if (skillsValue === '' || !skillsPattern.test(skillsValue)) {
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
            alert('Please fill in all required fields and enter skills in the format: skill1, skill2, skill3');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {

    var editProfileBtn = document.getElementById('editProfileBtn');
    var editProfileForm = document.getElementById('editProfileForm');


    editProfileBtn.addEventListener('click', function () {

        if (editProfileForm.style.display === 'none' || editProfileForm.style.display === '') {
            editProfileForm.style.display = 'block';
        } else {
            editProfileForm.style.display = 'none';
        }
    });
});