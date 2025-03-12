$(document).ready(function() {
    // Activate search functionality
    $('#searchInput').on('input', function() {
        var searchText = $(this).val().trim().toLowerCase();

        $('tbody tr').each(function() {
            var row = $(this);
            var userName = row.find('td:nth-child(1)').text().trim().toLowerCase();
            var email = row.find('td:nth-child(2)').text().trim().toLowerCase();
            var password = row.find('td:nth-child(3)').text().trim().toLowerCase();
            var role = row.find('td:nth-child(4)').text().trim().toLowerCase();
            var dateOfBirth = row.find('td:nth-child(5)').text().trim().toLowerCase();
            var region = row.find('td:nth-child(6)').text().trim().toLowerCase();

            if (userName.includes(searchText) || email.includes(searchText) || password.includes(searchText) || role.includes(searchText) || dateOfBirth.includes(searchText) || region.includes(searchText)) {
                row.show();
            } else {
                row.hide();
            }
        });
    });

    // Handle pagination links dynamically
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        
        var url = $(this).attr('href'); // Get the URL of the clicked pagination link
        
        // Send an Ajax request to fetch the content of the next or previous page
        $.ajax({
            url: url,
            success: function(data) {
                // Update the users table with the fetched data
                $('#users-table').html(data);

                // Scroll to the top of the table after pagination
                $('html, body').animate({
                    scrollTop: $('#users-table').offset().top
                }, 'slow');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching page content:', error);
            }
        });
    });

    // Delete user form submission
    $(document).on('submit', 'form.delete-user-form', function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');

        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                success: function(response) {
                    // Remove the deleted user's row from the table
                    form.closest('tr').remove();
                    alert('User deleted successfully!');
                },
                error: function(xhr, status, error) {
                    alert('Error deleting user: ' + error);
                }
            });
        }
    });

    // Update user status
    $(document).on('change', '.update-status', function() {
        var status = $(this).val();
        var user_id = $(this).data('user-id');
        var url = '/users/' + user_id + '/update-status';

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Optionally, update UI to reflect the status change
                alert('User status updated successfully!');
            },
            error: function(xhr, status, error) {
                alert('Error updating user status: ' + error);
            }
        });
    });

    // Upload profile picture
    $(document).on('change', '#profile_picture', function() {
        var file = this.files[0];
        var formData = new FormData();
        formData.append('profile_picture', file);

        $.ajax({
            url: "{{ route('dashboard.uploadProfilePicture') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.custom-file-label').html(file.name);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while uploading the file.');
            }
        });
    });

    // Submit form
    $(document).on('click', '#submitForm', function() {
        var formData = new FormData($('#createForm')[0]);

        $.ajax({
            url: "{{ route('dashboard.users.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while submitting the form.');
            }
        });
    });
});
