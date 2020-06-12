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
                <li class="apis"><i class="fas fa-users-cog"></i> <span class="dash-text">User Manager</span><i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">User Manager</p>
                        <p>End Points</p>
                        <ul>
                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"> <i class="fas fa-user-lock"></i> <span class="dash-text">Authentication</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Authentication</p>
                        <p>End Points</p>
                        <ul>

                            <li>Login</li>
                            <li>Logout</li>
                            <li>Reset Password</li>
                            <li>Login with google</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="fas fa-cogs"></i> <span class="dash-text">Company Settings</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Company Settings</p>
                        <p>End Points</p>
                        <ul>
                            <li>Add Company</li>
                            <li>Delete Company</li>
                            <li>Set Company Name</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="fas fa-mail-bulk"></i>
                    <span class="dash-text">Send Email Notification</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Send Email Notification</p>
                        <p>End Points</p>
                        <ul>
                            <li>Send Email</li>
                            <li>Send Email with Template</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="fas fa-user-shield"></i> <span class="dash-text">Show Dashboard</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Show Dashboard</p>
                        <p>End Points</p>
                        <ul>

                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="far fa-newspaper"></i> <span class="dash-text">Sending Newsletter</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Sending Newsletter</p>
                        <p>End Points</p>
                        <ul>

                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="fas fa-cloud"></i> <span class="dash-text">CRUD</span> <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">CRUD</p>
                        <p>End Points</p>
                        <ul>

                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                </li>
                <li class="apis"><i class="far fa-paper-plane"></i><span class="dash-text">SAAS App Subscription</span>
                    <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">SAAS App Subscription</p>
                        <p>End Points</p>
                        <ul>

                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                    </div>
                </li>

                <li class="apis"><i class="fas fa-envelope-open-text"></i> <span class="dash-text">Team
                        Invitation</span>
                    <i class="fas fa-angle-down left"></i>
                    <div class="endpoints">

                        <p class="api-name">Team
                            Invitation</p>
                        <p>End Points</p>
                        <ul>
                            <li>Add User</li>
                            <li>Remove User</li>
                            <li>Set User Firstname</li>
                            <li>Set User Lastname</li>
                            <li>Change User Email</li>
                            <li>Set User Phone</li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div id="widget">

        </div>
    </div>
    <div id="result">
        <h1>Results here</h1>
        <div>
            <h4>End point name</h4>
            <form action="script.php" method="POST">
                <p>
                    <label for="request">Request Type</label>
                    <select name="request" id="request">
                        <option value="" selected disabled>Select One</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="UPDATE">UPDATE</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </p>
                <p>Required Parameters</p>
                <p>
                    <input type="text" name="url" hidden>
                </p>
                <p>
                    <input type="text" name="param1">
                </p>
                <p>
                    <input type="text" name="param2">
                </p>
                <p>
                    <button type="submit">Test Endpoint</button>
                </p>
            </form>
        </div>

    </div>

    <script>
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
    </script>
</body>

</html>