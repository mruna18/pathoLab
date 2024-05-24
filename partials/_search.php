<?php
// Database connection configuration
include '_dbconn.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    
    // Perform a database query to search for test
    $sql = "SELECT * FROM test WHERE test_name LIKE '%" . $query . "%'";
    $result = $conn->query($sql);

    $test = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $test[] = $row;
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($test);

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Search</title>
    <style>
        /* Add CSS styles for the dropdown */
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            max-height: 150px;
            overflow-y: auto;
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="autocomplete">
        <input type="text" id="searchInput" placeholder="Search for test">
        <div class="autocomplete-items" id="searchResults"></div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            const query = this.value;
            const scriptPath = window.location.pathname;
            
            fetch(`${scriptPath}?query=${query}`)
                .then(response => response.json())
                .then(data => displayResults(data))
                .catch(error => console.error('Error:', error));
        });

        function displayResults(results) {
            searchResults.innerHTML = '';

            if (results.length === 0) {
                searchResults.style.display = 'none';
            } else {
                searchResults.style.display = 'block';
                results.forEach(result => {
                    const item = document.createElement('div');
                    item.textContent = result.test_name; // Change 'test_name' to the actual field name in your database
                    item.classList.add('autocomplete-item');
                    
                    item.addEventListener('click', function() {
                        searchInput.value = this.textContent;
                        searchResults.style.display = 'none';
                    });

                    searchResults.appendChild(item);
                });
            }
        }
    </script>
</body>
</html>
