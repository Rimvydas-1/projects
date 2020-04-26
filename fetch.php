<?php
require_once ('includes/class-autoload.inc.php');
$postData  = file_get_contents("php://input");

if(isset($postData) && !empty($postData)) {
    $post = json_decode($postData);
    switch($post->action) {
        case "getAvgMarksTable":
            getAvgMarksTable();
        break;
    }
}

function getAvgMarksTable()
{
    $AvgMarks = new Marks();
    echo json_encode($AvgMarks->AvgMarksTable()); //grazinam json encoded masyva
}

