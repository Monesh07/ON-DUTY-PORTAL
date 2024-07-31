<?php

include("print.php");

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $studentName = $_POST['studentName'] ?? '';
        $regNo = $_POST['regNo'] ?? '';
        $Year = $_POST['Year'] ?? '';
        $Department = $_POST[' Department'] ?? '';
        $Section = $_POST['Section'] ?? '';
        $date = $_POST['date'] ?? '';
        $date1 = $_POST['date1'] ?? '';
        $reason = $_POST['reason'] ?? '';
        $Location = $_POST['Location'] ?? '';

        // Database connection
        $conn = new mysqli('localhost', 'root', 'spider', 'bus','3306');
        if ($conn->connect_error) {
            echo "Connection Failed: " . $conn->connect_error;
            die();
        }

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO registration(studentName, regNo, year, Department,section,date, reason,Location,date1) VALUES (?, ?, ?,?, ?, ?,?,?,?)");
        $stmt->bind_param("ssississi", $studentName, $regNo, $Year,$Department ,$Section,$date, $reason,$Location,$date1);
        $execval = $stmt->execute();

        // Check if the query was executed successfully
        if ($execval) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Form not submitted.";
    }
?>
