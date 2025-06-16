<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('ADMIN', '', time() - 3600);

setcookie('qnw22yuUDphYb32ttuBono86OIBtTPMu3', '', time() - 3600);
setcookie('qn4543w22U76NHH87uehjrpoJjoiuihUG97', '', time() - 3600);

header("Location: index.php");
