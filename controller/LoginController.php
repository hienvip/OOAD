<?php
    session_start();

    require_once '../model/Account.php';

    //if (isset($_POST['login'])) {

        if (!isset($_SESSION['account'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $account = new Account($username, $password);

            if ($account->Verify()) {
                $_SESSION['account'] = serialize($account);
            }
            echo $username;
            //include '../view/main.php';

            header('location: http://localhost/ooad/view/web/products.php');
        }
    //}

    
    //var_dump($_SESSION['account']);
?>