<?php 
    session_start();
    include ("../db/conn.php");
    if (isset($_SESSION['USER']['unique_id'])) {
       
        $outgoing_id = $_SESSION['USER']['unique_id'];
        $incoming_id = $_POST['incoming_id']; // Consider validating and sanitizing this input

        // Prepare and execute the SQL query using PDO
        $sql = "SELECT * FROM chat 
                LEFT JOIN users ON users.unique_id = chat.outgoing_chat_id
                WHERE (outgoing_chat_id = :outgoing_id AND incoming_chat_id = :incoming_id)
                OR (outgoing_chat_id = :incoming_id AND incoming_chat_id = :outgoing_id) 
                ORDER BY chat_id";
        $stmt = $conn->prepare($sql); // Assuming $pdo is your PDO connection object
        $stmt->bindParam(':outgoing_id', $outgoing_id);
        $stmt->bindParam(':incoming_id', $incoming_id);
        $stmt->execute();

        $output = "";

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                if ($row['outgoing_chat_id'] == $outgoing_id) {
                    
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. htmlspecialchars($row['msg']) .'</p>
                                </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                <img src="../upload/'. htmlspecialchars($row['profile']) .'" alt="">
                                <div class="details">
                                    <p> '. htmlspecialchars($row['msg']) .'</p>
                                </div>
                                </div>';
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
        }
        echo $output;
    } else {
        header("location: ../login/login.php");
    }
?>