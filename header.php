<?php
session_start();  

error_reporting(0);

if(!isset($_SESSION['email']) or !isset($_SESSION['parol'])) 
{echo'<meta http-equiv="refresh" content="0; URL=index.php">'; exit;}

$con=mysqli_connect('localhost','u387328485_faiqo02','Amon666$$$','u387328485_faiqo');

?>
<title> Komandan | Ajax </title>
<link rel = "icon" href ="images/u.png" type = "image/x-icon">
<style>
  
body {
  background: url('images/ff.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}

* {
   font-family:cursive; 
}

.shekil {
  border: 1px solid #ddd; /* Gray border */
  border-radius: 4px;  /* Rounded border */
  padding: 1px; /* Some padding */
  width: 70px; /* Set a small width */
  
}

/* Add a hover effect (blue shadow) */
.shekil:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

</style>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel = "icon" href = images/clock.webp" 
        type = "image/x-icon">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
      <li class="nav-item active">
        <img src="<?php echo $_SESSION['foto']; ?>" class="shekil">
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 20;" href="profile.php"><?=$_SESSION['ad'].' '.$_SESSION['soyad']?><span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 20;" href="mytapsiriq.php">Ana sehife<span class="sr-only">(current)</span></a>
      </li>
      
       
      
     <?php 
      
    if($_SESSION['user_id']==1)
    {
        echo'
       <li class="nav-item active">
        <a class="nav-link" style="font-size: 20;" href="admin.php">Admin<span class="sr-only">(current)</span></a>
      </li>';
    }

    ?>  
      
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post">
      <input class="form-control mr-sm-2" type="text" placeholder="Axtaris" id="search" aria-label="Search">
       
        <a class="nav-link btn btn-danger my-2 my-sm-0" href="exit.php"><span class="sr-only">(current)</span><i class="bi bi-box-arrow-right"></i></a>
    
    </form>
  </div>
</nav>


<br><br><br><br>

