<?php


$url = $_POST['url'];
function filter($val)
{
    if ($val != "url" && $val != "GET" && $val != "POST" && $val != "UPDATE" && $val != "DELETE") {
        return $val;
    }
}
$filtered = array_filter($_POST, "filter");
// print_r($_POST);
// die();
$i = 0;
if ($_POST['request'] == "POST" || $_POST['request'] == "UPDATE") {
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
    $queryParam = '/' . $_POST[$requestKeys[2]];
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
        $queryParam = '/' . $_POST[$requestKeys[2]];
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
if ($_POST['request'] == "UPDATE") {
    $url .= $id;
    // echo $url;
    // die();
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_URL, "$url");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
}
curl_setopt($ch, CURLOPT_HEADER, 1);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     "x-rapidapi-host: covid-19-data.p.rapidapi.com",
//     "x-rapidapi-key: 125fed27d4msh77f960416e3a340p11b4edjsn65a7e81213e2"
// ));
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
