<?php

session_start();

$url = $_POST['url'];
function checkEmpty($arr)
{
    foreach ($arr as $key => $item) {
        if ($arr[$key] == "") {
            return true;
        }
    }
}
if (checkEmpty($_POST)) {
    $_SESSION['error'] = "No empty fields";
    header("location:index.php");
    die();
} else {
    function filter($val)
    {
        if ($val != "url" && $val != "GET" && $val != "POST" && $val != "PUT" && $val != "DELETE") {
            return $val;
        }
    }
    $filtered = array_filter($_POST, "filter");
    // print_r($_POST);
    // die();
    $i = 0;
    if ($_POST['request'] == "POST" || $_POST['request'] == "PUT") {
        $post_data = '';
        $id = '/' . $_POST['id'];
        foreach ($filtered as $key => $item) {
            if ($key != "url" && $key != 'id') {
                if ($i == 0) {
                    $post_data .= "$key=$item";
                } else {
                    $post_data .= "&$key=$item";
                }
                $i++;
            }
        }
        // print_r($post_data);
        // die();
    }

    if ($_POST['request'] == "DELETE") {
        $requestKeys = array_keys($_POST);
        $queryParam = '/' . $_POST[$requestKeys[1]];
    }
    if ($_POST['request'] == "GET") {
        $queryParam = '';

        //query parameter string for more than one GET request parameter
        if (count($filtered) > 2) {
            foreach ($filtered as $key => $item) {
                if ($key != "url") {
                    if ($i == 0) {
                        $queryParam .= "?$key=$item";
                    } else {
                        $queryParam .= "&amp;$key=$item";
                    }
                    $i++;
                }
            }
        } else {
            $requestKeys = array_keys($_POST);
            $queryParam = '/' . $_POST[$requestKeys[1]];
        }
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if ($_POST['request'] == "POST") {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_URL, "{$url}");
    }
    if ($_POST['request'] == "GET") {
        $url .= $queryParam;
        curl_setopt($ch, CURLOPT_URL, "$url");
    }

    if ($_POST['request'] == "DELETE") {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $url .= $queryParam;
        curl_setopt($ch, CURLOPT_URL, "$url");
    }
    if ($_POST['request'] == "PUT") {
        $url .= $id;
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }
    // curl_setopt($ch, CURLOPT_HEADER, 1);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //     "x-rapidapi-host: covid-19-data.p.rapidapi.com",
    //     "x-rapidapi-key: 125fed27d4msh77f960416e3a340p11b4edjsn65a7e81213e2"
    // ));
    $output = curl_exec($ch);
    $_SESSION['returned_data'] = $output;

    $info = curl_getinfo($ch);
    // echo $output;
    $connection_data = [
        "total_time" => $info['total_time'],
        "port" => $info['primary_port'],
        "server_ip" => $info['total_time'],
        "download_speed" => $info['speed_download'],

    ];
    $_SESSION['connection_data'] = json_encode($connection_data);
    // curl_setopt($ch,)
    $err = curl_error($ch);

    if ($err) {
        $_SESSION['connection_error'] = "Service not Avaible";
        header("location:index.php");
        die();
    }
    curl_close($ch);
    $_SESSION['success'] = "Request Sucessful";
    header("location:index.php");
    die();
}
