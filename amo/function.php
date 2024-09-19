<?php 
include('../db/conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hire_kasambahay'])) {
    $kasambahay_id = $_POST['kasambahay_id'];
    $service_id = $_POST['service_id'];
    $user_id = $_POST['user_id'];
    $sdate =$_POST['start_date'];
    // Insert into booking table
    $stmt = $conn->prepare("INSERT INTO booking (service_id, start_date, kb_id, amo_id, status) VALUES (?, ?, ?, ?, '1')");
    $stmt->execute([$service_id, $sdate, $kasambahay_id, $user_id]);
    if ($query_exec) {
        $_SESSION['message'] = "You're request is sent for admin's approval";
        header('Location: index.php');
        exit(0);
        
    } else {
        $_SESSION['message'] = "Try again, there is something wrong";
        header('Location: index.php');
        exit(0);
    }


}

function is_logged_in():bool
{

	if(!empty($_SESSION['USER']))
	{
		return true;
	}

	return false;
}

function get_image($path = ''):string 
{
	if(file_exists($path))
	{
		return $path;
	}

	return './images/no-image.jpg';
}

function user(string $key = '')
{
	if(is_logged_in())
	{
		if(!empty($_SESSION['USER'][$key]))
		{
			return $_SESSION['USER'][$key];
		}
	}

	return false;
}

function esc(string $str):string
{
	return htmlspecialchars($str);
}
?>

