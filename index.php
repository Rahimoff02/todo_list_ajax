<?php                                                                                                                                                                     
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['parol'])) 
{echo'<meta http-equiv="refresh" content="0; URL=mytapsiriq.php">'; exit;}

$con=mysqli_connect('localhost','u387328485_faiqo02','Amon666$$$','u387328485_faiqo');
?>

<title>AJAX Command</title>
<link rel = "icon" href ="images/u.png" type = "image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<br><br>


<style>
  
body {
  background: url('images/ff.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}

* {font-family:cursive;}

a{text-decoration:none;}

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><i class="bi bi-calendar-event-fill" style="font-size:25px"></i> <b>Tapsırıq</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><i class="bi bi-info-circle-fill"  style="font-size:25px"></i> <b>Haqqımızda</b></a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><i class="bi bi-telephone-fill"  style="font-size:25px"></i> <b>Əlaqə</b></a></li>

      </ul>
      <form class="d-flex" method="post" action="#cedvel">
        <input class="form-control me-2" type="email" name="email" placeholder="Email" aria-label="Search">
        <input class="form-control me-2" type="password" name="parol" placeholder="Parol" aria-label="Search">
        <button class="btn btn-outline-success" style="width:200px;" name="daxilol" type="submit">Daxil ol</button>
      </form>
    </div>
  </div>
</nav>

<br><br>

<div class="container">
  <div class="alert alert-warning" role="alert">
  Tapşırıq proqramında işləmək üçün ya qeydiyyatdan keçin, ya da <b>email</b> və <b>parolunuzu</b> daxil edərək sistemə giriş edin<b>.</b>
</div>

<?php 

//--GIRIS

if(isset($_POST['daxilol']))
{
   $email=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
    $parol=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['parol'])))));

    $yoxlama=mysqli_query($con,"SELECT * FROM users WHERE email='".$email."' AND parol='".$parol."' ");

    if(mysqli_num_rows($yoxlama)>0)
    {
      $info = mysqli_fetch_array($yoxlama);

      $_SESSION['user_id'] = $info['id'];
      $_SESSION['ad'] = $info['ad'];
      $_SESSION['soyad'] = $info['soyad'];
      $_SESSION['email'] = $info['email'];
      $_SESSION['telefon'] = $info['telefon'];
      $_SESSION['foto'] = $info['foto']; 
      $_SESSION['parol'] = $info['parol'];

      echo'<meta http-equiv="refresh" content="0; URL=mytapsiriq.php">';
    }
}


//-----------------------------------------------QEYDIYYAT------------------------------------------//

if(isset($_POST['qeydiyyat']))
{
    $ad=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['ad']))));
    $soyad=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['soyad']))));
    $email=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
    $telefon=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['telefon']))));
    $parol=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['parol'])))));
    $tparol=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['tparol'])))));

  if(!empty($ad) && !empty($soyad) && !empty($telefon) && !empty($email) && !empty($parol) && !empty($tparol))
{
  $yoxla=mysqli_query($con,"SELECT * FROM users WHERE telefon='".$telefon."' OR email='".$email."'");
    $say=mysqli_num_rows($yoxla);
    if($say==0)
    {
  if(strlen($parol)>=5)
  {
  if($parol==$tparol)
{
  $daxil=mysqli_query($con,"INSERT INTO users(ad,soyad,telefon,email,parol) VALUES('".$ad."','".$soyad."','".$telefon."','".$email."','".$parol."')");

    if($daxil==true)
      {echo'<div class="alert alert-success role="alert">Qeydiyyata alındınız.Zəhmət olmasa daxil olun.</div>';}
    else
      {echo'<div class="alert alert-danger role="alert">Təəssüfki qeydiyyata alınmadınız.</div>';}
}
else
{echo'<div class="alert alert-warning role="alert">Parol təkrar parolla eyni olmalıdır.</div>';}
}
else
{echo'<div class="alert alert-warning role="alert">Parol ən az 5 şrift olmalıdır.</div>';}
}
else
{echo'<div class="alert alert-danger role="alert">Daxil etdiyiniz <b>email</b> veya <b>nömrə</b> artıq istifadə olunub.</div>';}
}
else
  echo'<div class="alert alert-warning role="alert">Zəhmət olmasa bütün xanalariı doldurun.</div>';
}


?>

<div class="alert alert-dark" role="alert">
    <form method="post">
      Ad:<br>
      <input type="text" name="ad" class="form-control" required>
      Soyad:<br>
      <input type="text" name="soyad" class="form-control" required>
      Telefon:<br>
      <input type="text" name="telefon" class="form-control" required>
      Email:<br>
      <input type="email" name="email" class="form-control" required>
      Parol:<br>
      <input type="password" name="parol" class="form-control" autocomplete="off" required>
      Təkrar parol:<br>
      <input type="password" name="tparol" class="form-control" autocomplete="off" required><br>
      <button type="submit" class="btn btn-success" name="qeydiyyat">Qeydiyyatdan keç</button>
    </form>
</div>
</div>

<br><br>
