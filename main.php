<?php
session_start();

error_reporting(0);

if(!isset($_SESSION['email']) or !isset($_SESSION['parol'])) 
{echo'<meta http-equiv="refresh" content="0; URL=index.php">'; exit;} 

$con=mysqli_connect('localhost','u387328485_faiqo02','Amon666$$$','u387328485_faiqo');

date_default_timezone_set('Asia/Baku');

$tarix = date('Y-m-d H:i:s');

//--------------------------------PROFILE AJAX--------------------------------//

if($_GET['p']=='profile')
{

if(isset($_POST['update']))
{
    $ad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['ad']))));
    $soyad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['soyad']))));
    $telefon = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['telefon']))));
    $email = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
    $parol = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['parol'])))));

   if($parol==$_SESSION['parol'] OR $parol==' '){

    if($_POST['yparol']==$_POST['tparol']){

    $yoxla=mysqli_query($con,"SELECT * FROM users WHERE (telefon='".$_SESSION['telefon']."' AND id = '".$_POST['id']."' AND id != '".$_SESSION['user_id']."' OR email='".$_SESSION['email']."') AND id = '".$_POST['id']."' AND id != '".$_SESSION['user_id']."' ");
    $say=mysqli_num_rows($yoxla);

    if($say==0){

    if(empty($_POST['yparol']))
      {$parol=$_SESSION['parol'];}
    else
    {$parol = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['yparol'])))));}

  if(!empty($ad) && !empty($soyad) && !empty($telefon) && !empty($email) && !empty($parol))
    {
      if($_FILES['foto']['size']<1024)
      {$unvan=$_SESSION['foto'];}
       else
      {include"upload.php";}

      if(!isset($error)){

        $yenile=mysqli_query($con,"UPDATE users SET
         foto='".$unvan."', 
         ad='".$ad."',
         soyad='".$soyad."',
         telefon='".$telefon."',
         email='".$email."',
         parol='".$parol."'
         
         WHERE id='".$_SESSION['user_id']."' ");

          if($yenile==true){

             echo'<div class="alert alert-success" id="ugurupdate" role="alert">Melumat ugurla yenilendi.</div>';

             $_SESSION['foto'] = $unvan;
             $_SESSION['ad'] = $ad;
             $_SESSION['soyad'] = $soyad;
             $_SESSION['telefon'] = $telefon;       
             $_SESSION['email'] = $email;
             $_SESSION['parol'] = $parol;
          
             echo'<meta http-equiv="refresh" content="0; URL=profile.php">';
           }

            else
            {echo'<div class="alert alert-warning" role="alert">Qeydiyyati yenilemek mumkun olmadi.</div>';}
        }
    }
     else
      {echo'<div class="alert alert-warning" role="alert">Melumati tam doldurun!</div>';}
}
else
    {echo'<div class="alert alert-warning" role="alert">Bu istifadəçi artiq movcuddur !</div>';}

}
  else
        {echo'<div class="alert alert-warning" role="alert">Yeni parol tekrar parolla eyni deyil !</div>';}
  }
    else
      {echo'<div class="alert alert-warning" role="alert">Hal-hazirki parol yalnisdir!</div>';}
}  
 
echo'
<div class="alert alert-dark" role="alert">
    <form method = "post" enctype="multipart/form-data" id="profile_update">
    <div class="input-group">
    <span class="input-group-text"><i class="" style="font-size:30px"></i>
    <img style="width:120px" src="'.$_SESSION['foto'].'"></span>
    <input type="file" class="form-control" name="foto">
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-person-circle" style="font-size:30px"></i></span><br>
    <input type="text" class="form-control" name="ad" value="'.$_SESSION['ad'].'" autocomplete="off"><br>
    <input type="text" class="form-control" name="soyad" value="'.$_SESSION['soyad'].'" autocomplete="off"><br>
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-telephone-fill" style="font-size:30px"></i></span>
    <input type="text" class="form-control" name="telefon" value="'.$_SESSION['telefon'].'" autocomplet="off"><br>
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-envelope-fill" style="font-size:30px"></i></span>
    <input type="email" class="form-control" name="email" value="'.$_SESSION['email'].'" autocomplete="off"><br>
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-file-lock2-fill" style="font-size:30px"></i></span>
    <input type="password" class="form-control" name="parol" autocomplete="off" required><br>
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-key-fill" style="font-size:30px"></i></span>
    <input type="password" class="form-control" name="yparol" autocomplete="off"><br>
    </div><br>
    <div class="input-group">
    <span class="input-group-text"><i class="bi bi-key-fill" style="font-size:30px"></i></span>
    <input type="password" class="form-control" name="tparol" autocomplete="off"><br>
    </div><br>
    <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
    <input type="hidden" name="update">
    <button type="button" class="btn btn-success btn-sm update"><b>Yenile</b></button>
</form>';



//-------------------------------------------TAPSIRIQ ajax------------------------------------------------//
}

?>

<?php

if($_GET['t']=='tapsiriq')
{

if(!isset($_POST['edit']) && !isset($_POST['edit_id']))
{
  echo'
<div class="alert alert-dark" role="alert"> 
 <form method="post" id="insert_form">
  Tapsiriq:<br>
  <input type="text" name="tapsiriq" class="form-control"><br>
  Tarix:<br>
  <input type="date" name="gelecek" class="form-control"><br>
  Saat:<br>
  <input type="time" name="saat" class="form-control"><br>
  <input type="hidden" name="insert">
  <button type="button" class="btn btn-success insert">Daxil et</button>
 </form>
</div>';  
}

if(isset($_POST['edit_id']))
{
  $edit=mysqli_query($con,"SELECT * FROM mytapsiriq WHERE id = '".$_POST['edit_id']."' AND user_id='".$_SESSION['user_id']."' ");
  $info=mysqli_fetch_array($edit);

echo'
<div class="alert alert-dark" role="alert">
 <form method="post" id="update_form">
  Tapsiriq:<br>
  <input type="text" name="tapsiriq" value="'.$info['tapsiriq'].'" class="form-control">
  Tarix:<br>
  <input type="date" name="gelecek" value="'.$info['gelecek'].'" class="form-control">
  Saat:<br>
  <input type="time" name="saat" value="'.$info['saat'].'" class="form-control"><br>
  <input type="hidden" name="id" value="'.$info['id'].'">
  <input type="hidden" name="update">
  <button type="button" class="btn btn-dark update">Yenile</button>
  <button type="button" class="btn btn-danger insert">Legv et</button>
 </form>
</div>';  
}

//------------------------------------------DELETE----------------------------------------//

if(isset($_POST['tapsil']))
{
  $sil=mysqli_query($con,"DELETE FROM mytapsiriq WHERE id='".$_POST['tapsil']."' ");

  if($sil==true)
  {echo'<div class="alert alert-success" role="alert" id="ugursil">Melumatlar ugurla silindi !</div>';}
    else
    {echo'<div class="alert alert-danger" role="alert">Melumatlar silinmedi !</div>';}
}

//-------------------------------------------------DAXIL------------------------------------------------//

if(isset($_POST['insert']))
{
  $tapsiriq=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['tapsiriq']))));

  if(!empty($tapsiriq) && !empty($_POST['gelecek']) && !empty($_POST['saat']))
    {
      if($tarix < $_POST['gelecek'] OR $_POST['saat'])
      {
  $daxil=mysqli_query($con,"INSERT INTO mytapsiriq(tapsiriq,gelecek,saat,user_id,tarix) 
                      VALUES('".$tapsiriq."','".$_POST['gelecek']."','".$_POST['saat']."','".$_SESSION['user_id']."','".$tarix."')");

    if($daxil==true)
      {echo'<div class="alert alert-success" role="alert" id="gir">Melumatin cavabi hazirdir.</div>';}
    else
      {echo'<div class="alert alert-danger" role="alert">Melumat hesablana bilmedi.</div>';}

}
else
  {echo'<div class="alert alert-danger" role="alert">Gelecek vaxt indiden geri ola bilmez.</div>';}
}
else
  {echo'<div class="alert alert-warning">Bosh xanalari doldurun !</div>';}
}

//-----------------------------------------------SECIM DELETE-------------------------------------------//

if(!empty($_POST['secim']) && count($_POST['secim'])>0)
{
  if(!empty($_POST['secim'][0]))
  {
    for($i=0;$i<count($_POST['secim']); $i++)
      $sil=mysqli_query($con,"DELETE FROM mytapsiriq WHERE id='".$_POST['secim'][$i]."'");
  }
  if($sil==true)
  {echo'<div class="alert alert-success" id="silinme" role="alert">Secimler ugurla silindi.</div>';}
  else
  {echo'<div class="alert alert-success" role="alert">Secimleri silmek mumkun olmadi.</div>';}
}



//------------------------------------------------UPDATE---------------------------------------------------//

if(isset($_POST['update']))
{
    $tapsiriq=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['tapsiriq']))));
    
    if(!empty($_POST['tapsiriq']) && !empty($_POST['gelecek']) && !empty($_POST['saat']))
    {

      if($tarix < $_POST['gelecek'])
      {

        $updating=mysqli_query($con,"UPDATE mytapsiriq SET
                               tapsiriq='".$tapsiriq."',
                               gelecek='".$_POST['gelecek']."',
                               saat='".$_POST['saat']."'
                            
                               WHERE id='".$_POST['id']."'");

        if($updating==true)
            {echo'<div class="alert alert-success" id="ugurupdate" role="alert">Melumatlar ugurla yenilendi.</div>';}
        else
            {echo'<div class="alert alert-danger" role="alert">Melumatlari yenilemek mumkun olmadi.</div>';}
}
else
{echo'<div class="alert alert-warning" role="alert">Gelecek vaxtiniz indiki vaxtdan geride ola bilmez.</div>';}
}
else
{echo'<div class="alert alert-warning" role="alert">Bosh xanalari doldurun !</div>';}

}

//-------------------------------------------SELECT-----------------------------------------//

$input=$_POST['input'];

$sec=mysqli_query($con,"SELECT * FROM mytapsiriq WHERE (tapsiriq LIKE '%{$input}%' OR gelecek LIKE '%{$input}%') AND user_id='".$_SESSION['user_id']."' ORDER BY id DESC");
$say=mysqli_num_rows($sec);

echo'<form method="post" id="sil_form">
    <table class="table">
    <thead class="thead-dark">

        <th>#</th>
        <th>Tapsiriq</th>
        <th>Tarix</th>
        <th>Saat</th>
        <th>B.Tarix</th>
        <th>Qalan Vaxt</th>
        <th><button type="button" class="btn btn-danger btn-sm secsil">Secimleri sil</button></th>
        
        </thead>

        <tbody>';


$aktiv= 0;
$bitmis= 0;

echo'
<div class="alert alert-secondary" role="alert">
<b>Toplam tapsiriq: '.$say.'</b>|
<b>Aktiv tapsiriq: '.$aktiv.'</b> |
<b>Bitmis tapsiriq: '.$bitmis.'</b>
</div>';

$i=0;

while($info=mysqli_fetch_array($sec)) 
{

$t1=time();
$t2=strtotime($info['gelecek'].''.$info['saat']);

 if($t1>$t2)
  {$bitmis++;}
 else
  {$aktiv++;}

$t=time();
$gun=strtotime($info['gelecek'].' '.$info['saat']);
$t3=strtotime(date('Y-m-d H:i:s'));

$ferq=$gun-$t3;
$deq=round($ferq/60);
$saat=round($deq/60);
$gun=round($saat/24);

if($deq>0 && $deq<60 && $saat<1)
  {$qalanvaxt = $deq.'deq';}
else 
    {$qalanvaxt='<span><i class="fa fa-check-square"></i></span>';}

if($deq>59 && $saat<25)
  {$qalanvaxt = $saat.'saat';}

if($saat>24)
  {$qalanvaxt = $gun.'gun';}

$i++;

if($qalanvaxt==0)
  {$class='class="alert alert-success" ';}
else
  {$class='class="alert alert-warning" ';}

if($qalanvaxt==0)
{$qalanvaxt='<button class="btn btn-success btn-sm"><i class="bi bi-check"></i></button>';}

  echo'<tr '.$class.'>';
  echo'<td>'.$i.' <input type="checkbox" name="secim[]" value="'.$info['id'].'"></td>';
  echo'<td>'.$info['tapsiriq'].'</td>';
  echo'<td>'.$info['gelecek'].'</td>';
  echo'<td>'.$info['saat'].'</td>';
  echo'<td>'.$info['tarix'].'</td>';
  echo'<td>'.$qalanvaxt.'</td>';


echo'<td>
<form method="post">
<input type="hidden" name="id" value="'.$info['id'].'">
<button type="button" class="btn btn-danger btn-sm sil" id="'.$info['id'].'">Sil</button>
<button type="button" class="btn btn-primary btn-sm edit" id="'.$info['id'].'">Redakte</button>
</form>
</td>';

echo'</tr>';

}

echo'</tbody>
</table>

</div>';

}

?>


<?php 

if($_GET['a']=='admin')
{


if($_POST['f1']=='ASC' )
{$order = ' ORDER BY ad ASC'; $f1 = '<button type="button" class="btn btn-light f1" id="DESC"><i class="bi bi-sort-alpha-down-alt"></i></button>';}

elseif($_POST['f1']=='DESC' )
{$order = ' ORDER BY ad DESC'; $f1 = '<button type="button" class="btn btn-light f1" id="ASC"><i class="bi bi-sort-alpha-down"></i></button>';}

else
{$f1 = '<button type="button" class="btn btn-light f1" id="ASC"><i class="bi bi-sort-alpha-down"></i></button>';}

if($_POST['f2']=='ASC' )
{$order = ' ORDER BY tarix ASC'; $f2 = '<button type="button" class="btn btn-light f2" id="DESC"><i class="bi bi-sort-alpha-down-alt"></i></button>';}

elseif($_POST['f2']=='DESC' )
{$order = ' ORDER BY tarix DESC'; $f2 = '<button type="button" class="btn btn-light f2" id="ASC"><i class="bi bi-sort-alpha-down"></i></button>';}

else
{$f2 = '<button type="button" class="btn btn-light f2" id="ASC"><i class="bi bi-sort-alpha-down"></i></button>';}

if(!isset($_POST['f1']) && !isset($_POST['f2']))
{$order = ' ORDER BY id DESC';}


if(isset($_POST['secsil']) && count($_POST['secim'])>0)
{
    for($i=0; $i<count($_POST['secim']); $i++)
    {
        $sil=mysqli_query($con,"DELETE FROM users WHERE id='".$_POST['secim'][$i]."'");
    }
    if($sil==true)
    {echo'<div class="alert alert-success" role="alert">Seçilmiş şəxslər uğurla silindi</div>';}
    else
    {echo'<div class="alert alert-success" role="alert">Seçilmiş şəxslər silmək mümkün olmadı</div>';}

}

if(isset($_POST['edit_id']))
{
    $edit_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['edit_id']))));

    $sech=mysqli_query($con,"SELECT * FROM users WHERE id='".$edit_id."'");
    $info=mysqli_fetch_array($sech);
    echo'
    <div class="alert alert-secondary" role="alert">
    <form method="post" enctype="multipart/form-data" id="admin_update">
    Ad:<br>
    <input required type="text" name="ad" value="'.$info['ad'].'" class="form-control"><br>
    Soyad:<br>
    <input required type="text" name="soyad" value="'.$info['soyad'].'" class="form-control"><br>
    Telefon:<br>
    <input required type="text" name="telefon" value="'.$info['telefon'].'" class="form-control"><br>
    Email:<br>
    <input required type="email" name="email" value="'.$info['email'].'" class="form-control"><br>
    Parol:<br>
    <input required type="password" name="parol" class="form-control"><br>
    Təkrar parol:<br>
    <input required type="password" name="tekrar_parol" class="form-control"><br>
    <input type="hidden" name="id" value="'.$_POST['id'].'">
    <input type="hidden" name="update">
    <button type="button" class="btn btn-primary update">Yenilə</button>&nbsp;
    <button type="button" class="btn btn-danger d">Legv et</button>
</form>
</div>';
}

if(isset($_POST['sil_id']))
{
    $sil=mysqli_query($con,"DELETE FROM users WHERE id='".$_POST['sil_id']."'");
    if($sil==true)
        {echo'<div class="alert alert-success" role="alert">Məlumatlar uğurla silindi!</div>';}
    else
        {echo'<div class="alert alert-danger" role="alert">Məlumatlar silinmədi!</div>';}
}

if(isset($_POST['d']))
{
    if($_POST['parol']==$_POST['tekrar_parol'])
    {
            $ad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['ad']))));
            $soyad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['soyad']))));
            $telefon = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['telefon']))));
            $email = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
            $parol = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['parol'])))));

        if (!empty($ad) && !empty($soyad) && !empty($telefon) && !empty($email) && !empty($parol))
          {
            $yoxla=mysqli_query($con,"SELECT * FROM users WHERE email='".$email."' OR telefon='".$telefon."' ");
            
           if(mysqli_num_rows($yoxla)==0)
            {  
           
                $insert=mysqli_query($con,"INSERT INTO users(ad,soyad,telefon,email,parol)
                  VALUES('".$ad."','".$soyad."','".$telefon."','".$email."','".$parol."')");
                
                if($insert==true)
                 {echo '<div class="alert alert-primary" id="ugurgir" role="alert">İstifadəçi bazaya daxil edildi!</div>';}
                else
                 {echo '<div class="alert alert-danger" role="alert">Istifadəçini bazaya daxil etmək mümkün olmadı!</div>';}
        }
           else
            {echo '<div class="alert alert-danger" role="alert">Bu email və ya telefon mövcüddur</div>';}
          
          }
         else
          {echo '<div class="alert alert-danger" role="alert">Zəhmət olmasa məlumatları doldurun!</div>';}
    }
    else
    {echo '<div class="alert alert-danger" role="alert">Parollar üst-üste düşmür</div>';}
}

if(isset($_POST['update']))
{
  if($_POST['parol']==$_POST['tekrar_parol'])
  {
      $ad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['ad']))));
      $soyad = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['soyad']))));
      $telefon = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['telefon']))));
      $email = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
      $parol = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim(sha1($_POST['parol'])))));

      $yoxla=mysqli_query($con,"SELECT * FROM users WHERE telefon='".$telefon."' AND id!='".$_POST['id']."' AND user_id='".$_SESSION['user_id']."' OR email='".$email."' AND id!='".$_POST['id']."' AND user_id='".$_SESSION['user_id']."' ");
      
      if(mysqli_num_rows($yoxla)==0)
    {
    $yenile=mysqli_query($con,"UPDATE users SET 
    ad='".$ad."',
    soyad='".$soyad."',
    telefon='".$telefon."',
    email='".$email."',
    parol='".$parol."'
    
    WHERE id='".$_POST['id']."' ");
    
        if($yenile==true)
            {echo '<div class="alert alert-primary" id="ugurupdate" role="alert">Məlumatlar uğurla yeniləndi!</div>';}
        else
            {echo '<div class="alert alert-danger" role="alert">Məlumatlar yenilemek mümkün olmadı!</div>';}
        }
   else
   {echo '<div class="alert alert-danger" role="alert">Bu email və ya telefon mövcuddur!</div>';}
}
  else
  {echo '<div class="alert alert-danger" role="alert">Parollar üst-üstə düşmür!</div>';}
}

if(!isset($_POST['edit']) && !isset($_POST['edit_id']))
{
echo'
<div class="alert alert-secondary" role="alert">
<form method="post" id="admin_insert">
    Ad:<br>
    <input required type="text" name="ad" class="form-control"><br>
    Soyad:<br>
    <input required type="text" name="soyad" class="form-control"><br>
    Telefon:<br>
    <input required type="text" name="telefon" class="form-control"><br>
    Email:<br>
    <input required type="email" name="email" class="form-control"><br>
    Parol:<br>
    <input required type="password" name="parol" class="form-control"><br>
    Təkrar parol:<br>
    <input required type="password" name="tekrar_parol" class="form-control"><br>
    <input type="hidden" name="d">
    <button type="button" class="btn btn-dark d">Daxil et</button>
</form>
</div>';
}

echo'<form method="post">
          <table class="table table-hover table-dark">
          <thead class="thead-dark">

          <th>#</th>
          <th>Foto</th>
          <th>Istifadəçi '.$f1.'</th>
          <th>Telefon</th>
          <th>Email</th>
          <th>Tarix '.$f2.'</th>
          <th><button class="btn btn-danger btn-sm" name="secsil">Seçilmişləri sil</button></th>
          </thead>
        
         <tbody>';


$sec=mysqli_query($con,"SELECT * FROM users WHERE id != '".$_SESSION['user_id']."' ".$order);

$say=mysqli_num_rows($sec);
echo'<div class="alert alert-warning" role="alert"><b>Istifadəçilərin sayi:</b> '.$say.'</div>';

$i=0;

while($info=mysqli_fetch_array($sec))
{
    $i++;
    echo'<tr>';
    echo'<td><input type="checkbox" name="secim[]" value="'.$info['id'].'"> '.$i.'</td>';
    echo'<td><img style="width:75px; height:60px;" src="'.$info['foto'].'"></td>';
    echo'<td>'.$info['ad'].' '.$info['soyad'].'</td>';
    echo'<td>'.$info['telefon'].'</td>';
    echo'<td>'.$info['email'].'</td>';
    echo'<td>'.$info['tarix'].'</td>';
    echo'
    <td>
    <form method="post">
    <input type="hidden" name="id" value="'.$info['id'].'">';

        if($info['blok']==0)
    {
        
    echo'
    <button type="button" name="edit" class="btn btn-warning edit" id="'.$info['id'].'"><i class="bi bi-pencil"></i></button>
    <button type="button" name="sil"  class="btn btn-danger sil" id="'.$info['id'].'"><i class="bi bi-trash"></i></button>
    <button type="submit" name="blok"  class="btn btn-success"><i class="bi bi-check2"></i></button>';
     }
     
     else
    {echo'<button type="submit" name="levg" class="btn btn-danger"><i class="bi bi-x-octagon"></i></button>';}
    
    echo'
    </form>
    </td>
    </tr>';

}
echo'</tbody>     
    </table>';  

}

?>