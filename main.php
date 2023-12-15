<?php
require_once('Auth.php');

$res = Auth::accessToken();
print_r($res);
?>