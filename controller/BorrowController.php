<?php
    //session_write_close();
    session_start();
    require_once '../model/Book.php';

    if (!isset($_SESSION)) {
        header('location: http://localhost/ooad/view/web/login.php');
    }
    else {
        if (!isset($_SESSION['account'])) {
            header('location: http://localhost/ooad/view/web/login.php');
        }
        else {
            if (isset($_POST['borrow'])) {
                $id = $_POST['id'];
                
                $book = new Book($id);
                
                if ($book->Exist()) {
                    $account = unserialize($_SESSION['account']);
                    var_dump($book);
                    $book->Borrow($account->GetID());
                }
            }
        }
    }
?>