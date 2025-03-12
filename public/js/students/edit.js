// Edit Page jQuery and Ajax Script

$(document).ready(function() {
    // Form submission with Ajax
    $('#editForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send Ajax request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // Handle success response
                console.log('Form submitted successfully');
                // Redirect to success page or show success message
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error submitting form: ' + error);
                // Display error message to user
            }
        });
    });
});
