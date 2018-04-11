<?php
function scrypt( $string, $action = 'e' ) {
    $skey = 'AeGzEfi72t';
    $siv = 'FUwIKkTo86';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $skey );
    $iv = substr( hash( 'sha256', $siv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}

?>