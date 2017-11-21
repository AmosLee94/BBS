<?php
        require_once "../library/path.php";
        require_once $RootPath."/source/library/MySql.php";
        if (isset($_POST["username"])&&isset($_POST["password"])) {
                $username = addslashes($_POST['username']);
                $password = $_POST['password'];
                login($username,$password,604800,"/");//7day
        }

        function login($username,$password,$second,$path){
                $result=verifyUser($username,$password);
                if($result){
                    @session_start();
                    $json = json_encode($result);
                    setcookie("UserInfo",$json,time()+$second,$path);
                    setcookie(session_name(),session_id(),time()+$second,$path);
                    $_SESSION["userName"]=stripslashes($result["username"]);
                    $_SESSION["uid"]=$result["id"];
                    $_SESSION["permission"]=$result["permission"];
                    echo true;
                }else{
                	echo false;
                }
        }
        function verifyUser($userName,$password){
        return MySQL_select("users","id,username,permission",'where username ="'.$userName.'"and password ="'.$password.'"')[0];
        }
?>
