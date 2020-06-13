<?php
session_start();
if (isset($_POST['api_name'])) {
    save_userObject($_POST, $_POST['api_name']);
    $_SESSION['success'] = "Request Sucessful";
    header("location:index.php");
}


function save_userObject($obj, $name)
{
    file_put_contents("db/" . $name . ".json", json_encode($obj));
}
