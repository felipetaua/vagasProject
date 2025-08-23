<?php
// c:\xampp\htdocs\sistemaDeVagas\authenticated\db_connection.php

// Centralized database connection file

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Create a new mysqli connection object
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    // In a real production environment, you would log this error and show a generic message.
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Falha na conexão com o banco de dados. Por favor, tente novamente mais tarde.");
}

// Set the character set to utf8mb4 for full Unicode support, preventing encoding issues.
$conn->set_charset("utf8mb4");
