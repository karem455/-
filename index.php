<?php
include('header.php');
include('functions.php');
include('connection.php');

if (isset($_SESSION['loggedInUserType'])) {

  if ($_SESSION['loggedInUserType'] != "doctor") {
    header("Location: ../");
  }
}


?>




<div class="container">

  <div class="row">


    <ul class="nav navbar-nav navbar-right">
     
      <li><a href="userlogin.php">userlogin</a></li>
    </ul>




    <div class="col-sm-8">

      <h3> wlcome to Prescription Management Software</h3> <br>

    </div>