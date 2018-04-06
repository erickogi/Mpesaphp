<?php
/**
 * Created by PhpStorm.
 * User: kogi
 * Date: 4/6/18
 * Time: 12:35 PM
 */


include './Operations.php';

$payload =  file_get_contents('php://input');

$result = json_decode($payload,true);

$db = new Operations();

//if($result['Body']['stkCallback']['ResultCode'] == 0)
//{

    $db->insert($payload);


//}
//else{
//
//
//
//
//}