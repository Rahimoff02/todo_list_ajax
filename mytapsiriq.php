<?php
include"header.php";

echo'<div class="container">';
?>

<div id="result"><br><br><br><br><br><img style="width: 300px; height:300px;" class="rounded mx-auto d-block" src="images/cat.gif"></div>

<script>

$(document).on('click','.insert',function(){
        let form = $('#insert_form')[0]
        let data = new FormData(form)
     
        $.ajax({
            type: "POST",
            url: "main.php?t=tapsiriq",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                $('#result').html(response)
                setTimeout(function(){
                  $("#gir").slideUp();
                },3000);
            },
        })
    })


$(document).on('click','.secsil',function(){
        let form = $('#sil_form')[0]
        let data = new FormData(form)

        if (confirm('Tapsiriqlari silmeye eminsinizmi ?')) {
        $('#result').html(
        '<br><br><br><img style="width: 450px; height:450px;" class="rounded mx-auto d-block" src="images/cat.gif">'
        )
     
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "main.php?t=tapsiriq",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                $('#result').html(response)
                setTimeout(function(){
                  $("#silinme").slideUp();
                },3000);
            },
        })
       }
    })

$(document).ready(function(){

  $("#search").keyup(function(){
    let input = $(this).val();

        if(input !=" "){
      $.ajax({
      method:'POST',
      url:'main.php?t=tapsiriq',
      data:{input:input},
      success:function(response){
        $('#result').html(response)
          }
      });
    }
    
  });
});


$(document).on('click','.edit',function(){

  let id = $(this).attr('id')

      $.ajax({
      method:'POST',
      url:'main.php?t=tapsiriq',
      data:{edit_id:id},
      success:function(response){
        $('#result').html(response)
      }
    })
  
})


$(document).on('click','.update',function(){
        let form = $('#update_form')[0]
        let data = new FormData(form)
     
        $.ajax({
            type: "POST",
            url: "main.php?t=tapsiriq",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                $('#result').html(response)
                setTimeout(function(){
                  $("#ugurupdate").slideUp();
                },3000);
            },
        })
    })


$(document).on('click','.sil',function(){
  let id = $(this).attr('id')
  if(confirm('Mushterini silmeye eminsinizmi ?')){

    $('#result').html('<br><br><br><img style="width: 450px; height:450px;" class="rounded mx-auto d-block" src="images/cat.gif">')

    $.ajax({
      method:'POST',
      url:'main.php?t=tapsiriq',
      data:{tapsil:id},
      success:function(response){
        $('#result').html(response)
        setTimeout(function(){
                  $("#ugursil").slideUp();
                },3000);
      }
    })
  }
})

/*

$(document).on('click','.f1',function(){

let id = $(this).attr('id')

  $.ajax({
    method:'POST',
    url:'loader.php?c=clients',
    data:{f1:id},
    success:function(response){
      $('#result').html(response)
    }
  })

})


$(document).on('click','.f2',function(){

let id = $(this).attr('id')

  $.ajax({
    method:'POST',
    url:'loader.php?c=clients',
    data:{f2:id},
    success:function(response){
      $('#result').html(response)
    }
  })

})
   */

$.ajax({  

  type:'GET',
  url:'main.php?t=tapsiriq',
  dataType:'html',
  success:function(response){
    $('#result').html(response)
  }

})

</script>