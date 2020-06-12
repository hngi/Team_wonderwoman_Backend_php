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
    for ($i  =  0; $i < count($endpoints); $i++) {
        $ename = $endpoints[$i]->endpoint_name;
        $endpoint_url =
            $endpoints[$i]->endpoint_url;
        $request_type =
            $endpoints[$i]->endpoint_type;
        $param = json_encode($endpoints[$i]->parameter);

        $endpointText .= "<li data-param=$param  data-url=$endpoint_url class='endpoint' data-request=$request_type>$ename</li>";
    }
    return $endpointText;
}
