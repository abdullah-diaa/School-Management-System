$(document).ready(function() {
    // Function to fetch students based on page and search query
    function fetchStudents(page, query = '') {
        $.ajax({
            url: '/students?page=' + page,
            method: 'GET',
            data: { search: query },
            dataType: 'json',
            success: function(response) {
                var html = '';

                // Generate HTML for student data
                $.each(response.data, function(index, student) {
                    html += '<tr>';
                    // Add student data to HTML
                    // ...

                    // Add a class to distinguish between search results and general data
                    var rowClass = query !== '' ? 'search-result' : '';
                    html += '<tr class="' + rowClass + '">';

                    html += '</tr>';
                });

                // Display student data
                $('#students-table tbody').html(html);

                // Hide pagination if search query is active
                if (query !== '') {
                    $('.pagination').hide();
                    $('#pagination-container').hide(); // Hide pagination container
                } else {
                    $('.pagination').show();
                    $('#pagination-container').show(); // Show pagination container
                }
            }
        });
    }

    // Search form submission event listener
    $('#search-form').submit(function(event) {
        event.preventDefault();
        var query = $('#search').val();

        // Fetch students with the search query and disable pagination
        fetchStudents(1, query);
    });

    // Pagination link event listener
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#search').val();

        // Fetch students with selected page and search query
        fetchStudents(page, query);
    });



    // Pagination link event listener
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#search').val();

        // Fetch students with selected page and search query
        fetchStudents(page, query);

    });


    
        "data": [
        {
            "admission_number": "123",
            "first_name": "John",
            "last_name": "Doe",
            "date_of_birth": "1990-01-01",
            "gender": "Male",
            "address": "123 Main St",
            "phone_number": "123-456-7890",
            "user_id": 1,
            "email": "john@example.com",
            "id": 1
        },
        // Additional student objects...
    ],
    "links": "<pagination-links>",
    "from": 1,
    "to": 10,
    "total": 100
    
    
    
    
});
