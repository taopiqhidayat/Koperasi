<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('be', '', time()-43200);
setcookie('quiet', '', time()-43200);

header("Location: ../login/loginu.php");
exit;

?>