<?php

function display_return_data($arr)
{
    $text = "";
    if (count($arr) >=  1) {
        foreach ($arr  as $key => $item) {
            $text .= "<tr>
                    <th>$key</th>
                    <td>$item</td>
                </tr>";
        }
    }
    if ($text !== '') {
        return $text;
    } else {
        return "No data was returned";
    }
}


function getapis()
{

    $allusers = scandir('db/');
    $num = count($allusers);
    for ($i = 2; $i < $num; $i++) {
        // echo $allusers[$i];
        $api = json_decode(file_get_contents('db/' . $allusers[$i]));
        prepareApiList($api);
    }
}


function prepareApiList($arr)
{
    $endpointText = prepareEndpoints($arr);
    $template = "
     <li class='apis'><i class='fas fa-users-cog'></i> <span class='dash-text'>User Manager</span><i class='fas fa-angle-down left'></i>
                    <div class='endpoints'>
                        <p class='api-name'>$arr->api_name</p>
                        <p>End Points</p>
                        <ul>
                            $endpointText
                        </ul>
                    </div>
                </li>
    ";
    echo $template;
}

function prepareEndpoints($arr)
{

    $endpointText = '';
    $endpoints = $arr->endpoints;
    // print_r($endpoints[0]->endpoint_name);
    // die();
    for ($i  =  0; $i < count($endpoints); $i++) {
        $endpointText = "<li>$endpoints[$i]->endpoint_name</li>";
    }
    return $endpointText;
}
