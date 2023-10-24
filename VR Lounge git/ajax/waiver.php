<?php

    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
    $parName = trim(filter_var($_POST['parName'], FILTER_SANITIZE_STRING));
    $signaturem = trim(filter_var($_POST['signaturem'], FILTER_SANITIZE_STRING));
        $error = "";

        if(strlen($username) <= 3)
        $error = "Error Full Name";
        else if (strlen($parName) <= 3)
        $error = "Error Parent/Guardian name";
         else if (strlen($phone) <= 6)
         $error = "Error Phone Number";
         else if (strlen($signaturem) <= 1)
         $error = "Error Signature Witness";

         if($error != ""){
            echo $error;
            exit();
         }
   
    require_once '../mysqlconect.php';

    $currentDateTime = date('Y-m-d H:i:s'); // Форматируем текущую дату и время

    $sql = 'INSERT INTO users(username, phone, signaturem, date, parName) VALUES(?,?,?,?,?)';
    $query = $pdo->prepare($sql);
    if (!$query->execute([$username, $phone, $signaturem, $currentDateTime, $parName])) {
        echo "Error: " . implode(", ", $query->errorInfo());
    } else {
        echo "Ready";
    }
    
?>