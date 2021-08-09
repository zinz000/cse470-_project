<?php
//include constant.php for siteurl
 include('../config/constant.php');
 //destroy the session
 session_destroy();//unset $_seesion[user
 //redirect to login page
 header('location:'.SITEURL."admin/login.php");
?>