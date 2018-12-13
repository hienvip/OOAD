<?php
    require_once 'model/Account.php';

    $a = new Account('root','pass');
    echo $a->Verify();
?>