<?php

include 'connection.php';
error_reporting(0);

$having = ' ';

if(isset($_GET['logged_user_id'])){
    $logged_user_id = $_GET['logged_user_id'];
    $having .= "`liked_user_id` = '$logged_user_id'";
}


$sql = "SELECT * FROM `liked_users` INNER JOIN `users` ON users.id = liked_users.liked_user_id Having liked_by_id = (SELECT liked_user_id FROM `liked_users` Having $having LIMIT 1)";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);

$conn->close();

?>