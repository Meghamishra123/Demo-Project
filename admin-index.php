<?php
session_start();

include 'dbinfo.php';

$articles_query = "SELECT * FROM articles";
$articles_result = mysqli_query($con, $articles_query);

$background_image_url = "image1.jpg"; // Change this to the path of your background image

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The World of Books</title>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-image: url('image1.jpg'); /* Background image */
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    .article {
        display: flex;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .article img {
        width: 150px;
        height: auto;
        border-radius: 5px;
        margin-right: 20px;
    }
    .article-content {
        flex: 1;
    }
    .article-title {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }
    .article-superpower {
        font-size: 16px;
        color: #666;
    }
    .add-form {
        margin-top: 20px;
    }
    .add-form h3 {
        text-align: center;
    }
    .add-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .add-form input[type="text"],
    .add-form textarea {
        width: calc(100% - 18px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .add-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #400b0d;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .add-form input[type="submit"]:hover {
        background-color: #400b0d;
    }
</style>
</head>
<body>

<div class="container">
    <h1>The World of Books</h1>

    <?php
    if ($articles_result->num_rows > 0) {
        while($row = $articles_result->fetch_assoc()) {
            echo "<div class='article'>";
            echo "<img src='" . $row["image_url"] . "' alt='Article Image'>";
            echo "<div class='article-content'>";
            echo "<div class='article-title'>" . $row["title"] . "</div>";
            echo "<div class='article-superpower'>" . substr($row["content"], 0, 100) . "...</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No articles found</p>";
    }
    ?>

    <div class="add-form">
        <h3>What's your read?</h3>
        <form method="post" action="add-article.php">
            <label for="article_title">Title</label><br>
            <input type="text" id="article_title" name="article_title" required><br>
            <label for="article_content">Author</label><br>
            <textarea id="article_content" name="article_content" required></textarea><br>
            <label for="article_image_url">Image URL:</label><br>
            <input type="text" id="article_image_url" name="article_image_url"><br><br> 
            <input type="submit" name="add_article" value="Add Article">
        </form>
    </div>
</div>
</body>
</html>
