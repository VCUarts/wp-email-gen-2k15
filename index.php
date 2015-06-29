<?php
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("HTTP/1.1 301 Moved Permanently"); // for SEO
header("Location: http://$host$uri");
exit;
?>