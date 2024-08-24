
$(document).ready(function() {
           
    var api = '../api.php';

    // Handle form submission
    $('#register-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        $('#spinner').show();
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var confirmPassword = $('#confirmPassword').val().trim();
        var termsAccepted = $('#termsService').is(':checked');

        // Basic validation
        if (name === '' || email === '' || password === '' || confirmPassword === '') {
            showToast("danger-lighter", 'Please fill in all required fields!!!');
            $('#spinner').hide();
            return;
        }

        if (!validateEmail(email)) {
            showToast("danger-lighter", 'Please enter a valid email address.');
            $('#spinner').hide();
            return;
        }

        if (password !== confirmPassword) {
            showToast("danger-lighter", 'Passwords do not match.');
            $('#spinner').hide();
            return;
        }

        if (!termsAccepted) {
            showToast("danger-lighter", 'You must accept the terms of service.');
            $('#spinner').hide();
            return;
        }

        // AJAX request
        $.ajax({
            url: api, // Replace with your server endpoint
            method: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                register: 'register',
            },
            success: function(response) {
                console.log(response);
                showToast("success-lighter", 'Signup Successful!');
                if(response.message === 'Success'){
                    window.location.href = 'index.html';
                }
                if(response.message === 'Error'){
                    showToast("danger-lighter", 'Account Already Exists');
                    $('#spinner').hide();
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                showToast("danger-lighter", 'An error occurred: ' + error);
            }
        });
    });

    function validateEmail(email) {
        // Simple email validation regex
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});