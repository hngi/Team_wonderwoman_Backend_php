<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<?php
require('functions.php');
session_start();
?>

<body>
    <nav id="nav-bar">
        <h1>DASHBOARD FOR MONITORING API HEALTH</h1>
        <p>TEAM WONDERWOMAN</p>
    </nav>
    <div id="side-nav">
        <div id="main-side">
            <h2><i class="fas fa-tachometer-alt"></i> <span class="dash-text">DASHBOARD</span> </h2>
            <h2><i class="fas fa-server"></i> <span class="dash-text">API's</span> </h2>
            <ul>
                <?php
                getapis();
                ?>
            </ul>
        </div>
        <div id="widget">

        </div>
    </div>
    <div id="result">
        <h1>END POINT RESULTS</h1>

        <div id="status">
            <p>STATUS</p>
        </div>
        <p id="speed">

        </p>
        <div id="table-container">
            <h3>Returned Data</h3>
            <table>
                <?php
                if (isset($_SESSION['returned_data']) && !empty($_SESSION['returned_data'])) {
                    $res = json_decode($_SESSION['returned_data'], true);
                    echo display_return_data($res);
                    unset($_SESSION['returned_data']);
                } else {
                    echo "No test yet";
                }
                ?>
            </table>
        </div>
        <div id="table-container">
            <h3>Connection Data</h3>
            <table>
                <?php
                if (isset($_SESSION['connection_data']) && !empty($_SESSION['connection_data'])) {
                    $res = json_decode($_SESSION['connection_data'], true);
                    echo display_return_data($res);
                    unset($_SESSION['connection_data']);
                } else {
                    echo "No test yet";
                }
                ?>
            </table>

        </div>
        <div>
            <h4>End point name</h4>
            <p>
                <?php
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </p>
            <form action="script.php" method="POST" id="api-form">
                <!-- <buttonn id="add-param">Add Required parameter</buttonn>
                <p>
                    <label for="request">Request Type</label>
                    <select name="request" id="request">
                        <option value="" selected>Select One</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="UPDATE">UPDATE</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </p>
                <p>Required Parameters</p>
                <p>
                    <input type="text" name="url" placeholder="add url">
                </p>
                <p>
                    <input type="text" name="name">
                </p> -->
                <!-- <p>
                    <input type="email" name="email">
                </p>
                <p>
                    <input type="password" name="password">
                </p> -->
                <!-- <p>
                    <input type="text" name="city">
                </p>
                <p>
                    <input type="text" name="id">
                </p> -->
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        let apiForm = document.getElementById('api-form');
        let endpoints = [...document.getElementsByClassName('endpoints')];
        let apis = [...document.getElementsByClassName('fa-angle-down')];
        apis.forEach(e => {
            e.addEventListener('click', () => {

                let last = e.parentElement.lastElementChild;
                if (last.style.width == '') {
                    last.style.width = "250px";
                    last.style.height = "200px";
                    e.classList.replace('fa-angle-down', "fa-angle-up");
                } else {
                    last.style.width = "";
                    last.style.height = "";
                    e.classList.replace("fa-angle-up", 'fa-angle-down');
                }
                console.log(last.style.width)
            })
        })

        endpoints.forEach(endpoint => {
            endpoint.addEventListener('click', (e) => {
                $("#api-form").html('');
                let inputText = '';
                let params = JSON.parse(e.target.dataset.param)
                inputText += `<p> <label>Request Type</label>
                <input type="text" name="request" value="${e.target.dataset.request}" readonly>
                 </p>
                `
                for (let i = 0; i < params.length; i++) {
                    inputText += `<p> <label for=${params[i].parameter_name}>${params[i].label}</label>
                    <input type="${params[i].parameter_type}" name="${params[i].parameter_name}">
                    </p>
                    `;
                }
                inputText += `<input type="text" value="${e.target.dataset.url}" name="url" hidden>`
                inputText += `<p>
                    <button type="submit">Test Endpoint</button>
                </p>`
                $("#api-form").append(inputText);
            })
        })


        // let add = document.getElementById("add-param");
        // add.addEventListener('click', () => {
        //     apiForm = document.getElementById('api-form');

        // })
    </script>
</body>

</html>