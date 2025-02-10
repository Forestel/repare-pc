<?php
require_once('db.php');


$name = $conn->real_escape_string($_POST['name']);
$number = $conn->real_escape_string($_POST['number']);
$email = $conn->real_escape_string($_POST['Email']);
$device = $conn->real_escape_string($_POST['device']);
$problem = $conn->real_escape_string($_POST['problem']); 


$sqlClient = "INSERT INTO `Клієнт` (`Ім'я Прізвище`, `Email`, `Телефон`) VALUES ('$name', '$email', '$number')";
$conn->query($sqlClient);


if ($conn->error) {
    echo "Помилка виконання запиту: " . $conn->error;
} else {

    $lastInsertedClientId = $conn->insert_id;
    

    $sqlRequest = "INSERT INTO `Заявки` (`ID Клієнта`, `Опис Проблеми`, `Статус`) VALUES ('$lastInsertedClientId', '$problem', 'Нова')";
    $conn->query($sqlRequest);
    

    if ($conn->error) {
        echo "Помилка виконання запиту: " . $conn->error;
    } else {
        echo "Заявка успішно додана.";
    }
}


$conn->close();
?>
