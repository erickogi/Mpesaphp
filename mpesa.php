<?php
/**
 * Created by PhpStorm.
 * User: kogi
 * Date: 4/6/18
 * Time: 10:28 AM
 */

  $phone = $_POST["phone"];
    $amount = $_POST["amount"];

    $stk_request_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $outh_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';


    $safaricom_pass_key = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    $safaricom_party_b = "174379";
    $safaricom_bussiness_short_code = "174379";

    $safaricom_Auth_key = "hAVnRxa2UOjyAnydVJMG31A0OuDDCxm5";
    $safaricom_Secret = "UcpmdCdI8bAakdgm";


    $outh = $safaricom_Auth_key . ':' . $safaricom_Secret;


    $curl_outh = curl_init($outh_url);
    curl_setopt($curl_outh, CURLOPT_RETURNTRANSFER, 1);

    $credentials = base64_encode($outh);
    curl_setopt($curl_outh, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
    curl_setopt($curl_outh, CURLOPT_HEADER, false);
    curl_setopt($curl_outh, CURLOPT_SSL_VERIFYPEER, false);

    $curl_outh_response = curl_exec($curl_outh);

    $json = json_decode($curl_outh_response, true);


    $time = date("YmdHis", time());

    $password = $safaricom_bussiness_short_code . $safaricom_pass_key . $time;


    $curl_stk = curl_init();
    curl_setopt($curl_stk, CURLOPT_URL, $stk_request_url);
    curl_setopt($curl_stk, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $json['access_token'])); //setting custom header


    $curl_post_data = array(

        'BusinessShortCode' => '174379',
        'Password' => base64_encode($password),
        'Timestamp' => $time,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone,
        'PartyB' => '174379',
        'PhoneNumber' => $phone,
        'CallBackURL' => 'https://www.erickogi.co.ke/Mpesaphp/callback.php',
        'AccountReference' => '4352',
        'TransactionDesc' => ' Pay'
    );


    $data_string = json_encode($curl_post_data);

    curl_setopt($curl_stk, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_stk, CURLOPT_POST, true);
    curl_setopt($curl_stk, CURLOPT_HEADER, false);
    curl_setopt($curl_stk, CURLOPT_POSTFIELDS, $data_string);

    $curl_stk_response = curl_exec($curl_stk);


    echo $curl_stk_response;
