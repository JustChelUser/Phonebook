<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $file = 'contacts.json';
    if (file_exists($file)) {
        $current_data = file_get_contents($file);
        $contacts_array = json_decode($current_data, true);
        if (isset($contacts_array)) {
            foreach ($contacts_array as $key=>$value) {
                if ($value['name'] === $name && $value['phone'] === $phone) {
                    unset($contacts_array[$key]);
                }
            }
        }
    } else {
        $contracts_array = [];
    }
    file_put_contents($file, json_encode($contacts_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    header("Location: index.php");
}