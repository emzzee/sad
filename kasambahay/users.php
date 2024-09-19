<?php
    session_start();
    include_once ("../db/conn.php"); // Ensure this file contains PDO connection details

    $outgoing_id = $_SESSION['USER']['unique_id'];

    // Prepare the SQL query using PDO
    $sql = "SELECT * FROM users WHERE NOT unique_id = :outgoing_id ORDER BY user_id DESC";
    $stmt = $conn->prepare($sql); // Assuming $pdo is your PDO connection object
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->execute();

    $output = "";
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        $output .= "No users are available to chat";
    } elseif (count($result) > 0) {
        $sql = "SELECT * FROM users WHERE status = 2 AND user_role = 2 AND NOT unique_id = :outgoing_id ORDER BY user_id DESC ";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $unique = $row['unique_id'];
        
        $sql2 = "SELECT * FROM chat WHERE (incoming_chat_id = :unique_id OR outgoing_chat_id = :unique_id) 
        AND (outgoing_chat_id = :outgoing_id OR incoming_chat_id = :outgoing_id) 
        ORDER BY chat_id DESC LIMIT 1";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':unique_id', $row['unique_id'], PDO::PARAM_INT);
    $stmt2->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt2->execute();
        $row2 = $stmt2->fetch();
        $result = ($stmt2->rowCount() > 0) ? $row2['msg'] : "No message available";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

        $you = (isset($row2['outgoing_chat_id']) && $outgoing_id == $row2['outgoing_chat_id']) ? "You: " : "";
        // $offline = ($row['status'] == "Offline now") ? "offline" : "";
        $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="../upload/'. $row['profile'] .'" alt="">
                    <div class="details">
                        <span>'. $row['first_name']. " " . $row['last_name'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>

                </a>';
    }
    }

    echo $output;
