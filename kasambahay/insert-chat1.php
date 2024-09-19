<?php 
    session_start();
    include_once ("../db/conn.php");
    if (isset($_SESSION['USER']['unique_id'])) {
         // Ensure this file contains PDO connection details

        $outgoing_id = $_SESSION['USER']['unique_id'];
        // Consider validating and sanitizing these inputs
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];

        if (!empty($message)) {
            // Prepare and execute the SQL query using PDO
            $sql = "INSERT INTO chat (incoming_chat_id, outgoing_chat_id, msg) VALUES (:incoming_id, :outgoing_id, :message)";
            $stmt = $conn->prepare($sql); // Assuming $pdo is your PDO connection object
            $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->execute();
            var_dump($stmt);
        }
    } else {
        header("location: ../login.php");
    }
?>
`