<?php

if (isset($_POST['name']) && $_POST['name'] != "") {
    $deleted = unlink('db/' . $_POST['name'] . ".json");
    if ($deleted) {
        echo "Successfull";
    }
}
