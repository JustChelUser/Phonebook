<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    if (strlen($name) == 0 || strlen($phone) == 0 || ctype_space($phone) || ctype_space($name)) {
        $_SESSION['error'] = 'Пустые поля или поля только с пробелами не допускаются';
        $_SESSION['name']=$name;
        $_SESSION['phone']=$phone;
        header("Location: NewContact.php");
        exit();
    } elseif (preg_match('/\pL/', $phone) || strpos($phone, ' ') !== false) {
        $_SESSION['error'] = 'Номер не должен содержать буквы или пробелы';
        $_SESSION['name']=$name;
        $_SESSION['phone']=$phone;
        header("Location: NewContact.php");
        exit();
    }
    $file = 'contacts.json';
    if (file_exists($file)) {
        $current_data = file_get_contents($file);
        $contacts_array = json_decode($current_data, true);
        if (isset($contacts_array)) {
            foreach ($contacts_array as $contact) {
                if ($contact['name'] === $name && $contact['phone'] === $phone) {
                    $_SESSION['error'] = 'Такие данные уже существуют';
                    $_SESSION['name']=$name;
                    $_SESSION['phone']=$phone;
                    header("Location: NewContact.php");
                    exit();
                }
            }
        }
    } else {
        $contracts_array = [];
    }
    $new_contact = [
        'name' => $name,
        'phone' => $phone
    ];
    $contacts_array[] = $new_contact;
    file_put_contents($file, json_encode($contacts_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    header("Location: index.php");
}