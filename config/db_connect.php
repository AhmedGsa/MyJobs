<?php 
    $env = parse_ini_file('.env');
    $conn = mysqli_connect($env['DB_HOSTNAME'], $env['DB_USERNAME'], $env['DB_PASSWORD'], $env['DB_NAME']);
    if(!$conn) {
        echo 'Connection failed: '. mysqli_connect_error();
    }
?>