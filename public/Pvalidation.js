$(document).ready(function () {
    $("#createProjectForm").validate({
        rules: {
            projectName: "required",
            projectNumber: "required",
            image: {
                required: true,
                extension: "jpg|jpeg"
            },
            address: "required",
            startDate: "required",
            endDate: "required"
        },
        messages: {
            projectName: "Please enter the project name",
            projectNumber: "Please enter the project number",
            image: {
                required: "Please upload a JPEG image",
                extension: "Only JPEG images are allowed"
            },
            address: "Please enter the project address",
            startDate: "Please enter the start date",
            endDate: "Please enter the end date"
        },
        submitHandler: function (form) {
            
            form.submit();
        }
    });
});
