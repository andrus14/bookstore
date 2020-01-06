<?php
require_once 'db_connection.php';

$year = $_GET['year'];
$title = $_GET['title'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nimekiri</title>
</head>
<body>
    <h2>Otsing</h2>

    <form mehtod="GET" action="/index.php">
        <label for="year">Aasta</label>
        <br>
        <input type="text" name="year" value="<?=$year?>" style="margin-bottom: 4px;">
        <br>
        <label for="title">Pealkiri</label>
        <br>
        <input type="text" name="title" value="<?=$title?>" style="margin-bottom: 4px;">
        <br>
        <input type="submit" value="Otsi">
    </form>

<?php

$stmt = $pdo->prepare('SELECT * FROM books WHERE release_date LIKE :year AND title LIKE :title');
$stmt->execute(['year' => '%' . $year . '%', 'title' => '%' . $title . '%']);

echo '<ul>';
while ( $row = $stmt->fetch() ) {
    echo '<li><a href="./book.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>';
}
echo '</ul>';

?>
    
</body>
</html>
