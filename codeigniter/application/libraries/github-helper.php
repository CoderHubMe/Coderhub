<?php
    function git_token($code) {
        $base_url = 'https://github.com/';
        $data = array('client_id' => CLIENT_ID, 'client_secret' => CLIENT_SECRET, 'code' => $code);
        $url = $base_url . "login/oauth/access_token?";
        return curl( $url, $data);
    }
    
    function curl($url, $data) {
        $myvars = http_build_query($data);

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec( $ch );
    }
    
    function git_user($response) {
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"User-agent: Coderhub\r\n"
            )
        );
        $context = stream_context_create($opts);
        return file_get_contents("https://api.github.com/user?" . $response, false, $context);
    }
?>