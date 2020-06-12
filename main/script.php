<?php

session_start();




function filter($val)
{
    if ($val != "url" && $val != "GET" && $val != "POST" && $val != "UPDATE" && $val != "DELETE") {
        return $val;
    }
}
$filtered = array_filter($_POST, "filter");
$url = $_POST['url'];
if ($_POST['request'] == "POST") {
    $post_data = [];
    foreach ($filtered as $key => $item) {
        $post_data[$key] = $item;
    }
}

if ($_POST['request'] == "DELETE") {
    $requestKeys = array_keys($_POST);
    $id = '/' . $_POST[$requestKeys[1]];
}
if ($_POST['request'] == "GET") {
    $queryParam = '';
    $i = 0;

    //query parameter string for more than one GET request parameter
    if (count($filtered) > 1) {
        foreach ($filtered as $key => $item) {
            if ($i == 0) {
                $queryParam .= "?$key=$item";
            } else {
                $queryParam .= "&amp;$key=$item";
            }
            $i++;
        }
    } else {
        $requestKeys = array_keys($_POST);
        $queryParam = '/' . $_POST[$requestKeys[2]];
    }
    echo $queryParam;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if ($_POST['request'] == "POST") {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_URL, "{$url}");
}
if ($_POST['request'] == "GET") {
    curl_setopt($ch, CURLOPT_URL, "{$url}{$queryParam}");
}

if ($_POST['request'] == "DELETE") {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_URL, "{$url}{$queryParam}");
}

curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-rapidapi-host: covid-19-data.p.rapidapi.com",
    "x-rapidapi-key: 125fed27d4msh77f960416e3a340p11b4edjsn65a7e81213e2"
));
$output = curl_exec($ch);
$info = curl_getinfo($ch);
echo $output;
//print_r($info);
// curl_setopt($ch,)

curl_close($ch);


// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://covid-19-data.p.rapidapi.com/help/countries?format=json",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//         "x-rapidapi-host: covid-19-data.p.rapidapi.com",
//         "x-rapidapi-key: 125fed27d4msh77f960416e3a340p11b4edjsn65a7e81213e2"
//     ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     echo $response;
// }
