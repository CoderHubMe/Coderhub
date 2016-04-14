<?php
    $url = 'https://github.com/login/oauth/access_token';
    $data = array('client_id' => CLIENT_ID, 'client_secret' => CLIENT_SECRET, 'code' => $_GET['code']);
    
    $myvars = http_build_query($data);

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec( $ch );
    parse_str($response, $output);
    $token = $output['access_token'];
    
    echo $token;
  
  