<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .form-container, .output-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .output-container {
            display: none; /* Initially hidden */
        }

        .print-button {
            text-align: center;
            margin-top: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="form-container">
        <h2>Registration Form</h2>
        <form id="registrationForm">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address">

            <input type="submit" value="Submit">
        </form>
    </div>

    <div id="output" class="output-container">
        <h3>Registration Details</h3>
        <ul id="outputContent"></ul>
        <div class="print-button">
            <button onclick="window.print()">Print Details</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(event) {
                event.preventDefault();  // Prevent default form submission

                $.ajax({
                    type: 'POST',
                    url: 'submit.php',
                    data: $(this).serialize(),  // Serialize form data
                    success: function(response) {
                        // Display response from PHP in output container
                        $('#outputContent').html(response);
                        $('#output').show();
                        $('#registrationForm')[0].reset();  // Clear the form
                    },
                    error: function() {
                        alert('There was an error processing your form.');
                    }
                });
            });
        });
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and retrieve form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
    
        // Create an HTML response
        echo "<li><strong>Full Name:</strong> $name</li>";
        echo "<li><strong>Email:</strong> $email</li>";
        echo "<li><strong>Phone Number:</strong> $phone</li>";
        echo "<li><strong>Address:</strong> $address</li>";
    }
    ?>    
</body>
</html>
