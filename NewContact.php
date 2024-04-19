<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Новый контакт</title>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="/index.php">Контакты</a></li>
    </ul>
</nav>
<div class="form-add-contact">
    <form action="AddingNewContact.php" method="post">
        <div class="form-add-contact-inputs">
            <h1>Добавление нового контакта</h1>
            <?php
            if (isset($_SESSION['error'])) {
                echo("<p class='error'>" . $_SESSION['error'] . "</p>");
            }
            unset($_SESSION['error']);
            ?>
            <label for="name">Имя</label>
            <?php
            if (isset($_SESSION['name'])) {
                echo("<input type='text' name='name' id='name' required value=" . $_SESSION['name'] . ">");
            } else {
                echo("<input type='text' name='name' id='name' required>");
            }
            unset($_SESSION['name']);
            ?>
            <label for="phone">Телефон</label>
            <?php
            if (isset($_SESSION['phone'])) {
                echo("<input type='tel' name='phone' id='phone' required value=" . $_SESSION['phone'] . ">");
            } else {
                echo("<input type='tel' name='phone' id='phone' required>");
            }
            unset($_SESSION['phone']);
            ?>
            <input type="submit" class="add-button" value="Добавить">
        </div>
    </form>
</div>
</body>
</html>
