<?php 
    session_start();
    // echo "Hello world!!";
    $server = "localhost";
    $user = "root";
    $pwd = "";
    $table = "product";
    $coni = "";

    $access_scope;


    try{
        $coni = mysqli_connect($server, $user, $pwd, $table);
        if ($coni) echo "";
        else echo "Something went wrong pls check it";
    }
    catch(mysqli_sql_exception){
        echo "Something went wrong";
    }
    
?>