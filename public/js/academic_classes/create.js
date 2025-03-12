$(document).ready(function() {
    // Function to handle form submission
    $('#createStudentForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Serialize form data
        var formData = $(this).serialize();
        
        // Submit form data via AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                // Show loading spinner or animation
                $('#submitBtn').prop('disabled', true); // Disable submit button
            },
            success: function(response) {
                // Handle success response
                if (response.success) {
                    // Display success message
                    $('#successMessage').text(response.message).fadeIn();
                    // Clear form inputs
                    $('#createStudentForm')[0].reset();
                } else {
                    // Display error message
                    $('#errorMessage').text(response.message).fadeIn();
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                var errorMessage = xhr.responseJSON.message || 'An error occurred. Please try again.';
                $('#errorMessage').text(errorMessage).fadeIn();
            },
            complete: function() {
                // Hide loading spinner or animation
                $('#submitBtn').prop('disabled', false); // Enable submit button
            }
        });
    });
});
