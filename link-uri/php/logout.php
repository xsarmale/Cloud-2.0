<?php
session_start();
if(session_destroy()) // Destroying All Sessions 
{
header("Location: ..\conectare.html"); // Redirecting To Home Page
}
?>