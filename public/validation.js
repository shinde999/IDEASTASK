$(document).ready(function () {
    $("#registrationForm").validate({
        rules: {
            firstName: "required",
            lastName: "required",
            email: {
                required: true,
                email: true
            },
            userType: "required",
            dob: "required",
            address: "required",
            profileImage: {
                required: true,
                extension: "jpg|jpeg"
            },
            
        },
        messages: {
            firstName: "Please enter your first name",
            lastName: "Please enter your last name",
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            userType: "Please select a user type",
            dob: "Please enter your date of birth",
            address: "Please enter your address",
            profileImage: {
                required: "Please upload a JPEG image",
                extension: "Only JPEG images are allowed"
            }
           
        },
        submitHandler: function (form) {
            
            var formData = new FormData(form);

            $.ajax({
                url: 'process_signup.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                    alert(response);
                },
                error: function () {
                   
                    alert('Error processing the request. Please try again.');
                }
            });
        }
    });
});
