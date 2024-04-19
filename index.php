<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Список контактов</title>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="/NewContact.php">Добавить контакт</a></li>
    </ul>
</nav>
<div class="contacts">
    <h1>Список контактов</h1>
    <?php
    $file = 'contacts.json';
    if (file_exists($file)) {
        $current_data = file_get_contents($file);
        $contacts_array = json_decode($current_data, true);
        if (isset($contacts_array) && $contacts_array !== []) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Имя</th>';
            echo '<th>Телефон</th>';
            echo '</tr>';
            foreach ($contacts_array as $contact) {
                echo '<tr>';
                echo "<form action='DeleteContact.php' method='post' class='form-delete-contact'>";
                echo "<input type='hidden' name='name' id='name' readonly required value=" . $contact['name'] . ">";
                echo "<input type='hidden' name='phone' id='phone' required value=" . $contact['phone'] . ">";
                echo '<td>' . $contact['name'] . '</td>';
                echo '<td>' . $contact['phone'] . '</td>';
                echo '<td><input type="submit" value="Удалить" class="delete-button"></td>';
                echo '</form>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<h2>Контактов нет</h2>';
        }
    } else {
        echo '<h2>Контактов нет</h2>';
    }
    ?>
</div>
</body>
</html>
