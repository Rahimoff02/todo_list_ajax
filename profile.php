<?php
include"header.php";

echo'<div class="container">';


if($_SESSION['user_id']!=1)
{
    if(isset($_POST['he']) && !empty($_POST['sparol']) && (sha1($_POST['sparol'])) == $_SESSION['parol'])
    {
        $sil=mysqli_query($con,"DELETE FROM users WHERE id='".$_SESSION['user_id']."' ");
        $sil=mysqli_query($con,"DELETE FROM mytapsiriq WHERE user_id='".$_SESSION['user_id']."' ");
    
        if($sil==true)
        {echo'<meta http-equiv="refresh" content="0; URL=exit.php">';}
    }

if(!isset($_POST['bit']))
{
echo'
<div class="card">
 <form method="post">
  <div class="card-body">
    <h5 class="card-title">Profilinizi silin :( </h5>
    <p class="card-text">Profilinizi silmek istediyinizden emin olduqda "hesabimi sil" duymesine basa bilersiniz.</p>
     <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
     <button type="submit" class="btn btn-outline-danger" name="bit">Hesabımı sil</button>
  </div>
 </form>
</div><br>';
}

if(isset($_POST['bit']))
{
echo '
<div class="alert alert-warning text-dark" role="alert"><b>Profilinizi silmek ucun sizin cari parolunuzu daxil etmeniz lazimdir.</b>
 <form method="post"><br>
 <input type="password" name="sparol">
 <input type="submit" name="he" value="Sil" class="btn btn-danger btn-sm">
 <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
</form>
</div>';
  
}



}

?>

<div id="result"><br><br><br><br><br><img style="width: 300px; height:300px;" class="rounded mx-auto d-block" src="images/cat.gif"></div>

</div>

<script>

$(document).on('click','.update',function(){
        let form = $('#profile_update')[0]
        let data = new FormData(form)
     
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "main.php?p=profile",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                $('#result').html(response)
                setTimeout(function(){
                  $("#ugurupdate").slideUp();
                },5000);
            },
        })
    })


$.ajax({  

  type:'GET',
  url:'main.php?p=profile',
  dataType:'html',
  success:function(response){
    $('#result').html(response)
  }

})
</script>