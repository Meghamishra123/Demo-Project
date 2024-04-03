<?php

session_start();


if (!isset($_SESSION['username'])) {

    header("location: login.php");
    exit;
}
?>


<?php
include 'dbinfo.php';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_article'])) {

    $title = sanitize_input($_POST['article_title']);
    $content = sanitize_input($_POST['article_content']);
    $image_url = isset($_POST['article_image_url']) ? sanitize_input($_POST['article_image_url']) : ''; // Image URL is optional


    $sql = "INSERT INTO articles (title, content, image_url) VALUES ('$title', '$content', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "Article added successfully";
    
        header("Location: admin-index.php");
        exit();
    } else {
        echo "Error adding article: " . $conn->error;
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$conn->close();
?>