<?php
 session_start();
if(!isset($_SESSION['email'])) {
    header("Location: signin.php");
    die();
}
if(isset($_POST['logout'])){
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: signin.php"); // Redirect to login page
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sty.css">
</head>
<body bgcolor="lightgrey" align="center">
<div class="navbar" >
  <div class="dropdown" align = "center">
    <button class="dropbtn">MENU
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <hr><a href="dataintable.php">Student Record</a><hr>
      <form action="" method="post" style="margin-bottom: 10px; margin-top:15px">
        <input type="submit" name="logout" value="LOGOUT">
      </form></div>
</div>
</div>

<!-- For Edit -->
<div id="model">
  <div id="editform">
    <form id="edit" enctype="multipart/form-data"></form>
    <div id="closebtn">X</div>
  </div>
</div>

<!-- For ADD -->
<button id="adddata" style="margin-top: 20px;">Add Data</button><hr>
<div id="model2">
  <div id="addform">
    <form id="add" enctype="multipart/form-data"></form>
    <div id="closebtn2">X</div>
  </div>
</div>

<!-- For Viewing data in table -->
<table id="tabledata" border="1px solidbllack" cellspacing="1px" cellpadding="1px" align="center" style="margin-top:20px; margin-bottom: 20px ;">
</table>

<!-- For view Button in table -->
<div id="model3">
  <div id="view">
    <p id="viewpage"></p>
    <div id="closebtn3">X</div>
  </div>
</div>

<!-- For Resultcard Button in table -->
<div id="model4">
  <div id="resultcard">
    <p id="resultcardpage"></p>
    <div id="closebtn4">X</div>
  </div>
</div>

<script>
    $(document).ready(function(){

      // -----TO Load Data WIth Ajex------ //
        function loaddata(){
            $.ajax({
              url: "ajexfetchdata.php",
              type: "POST",
              success: function(data){
              $("#tabledata").html(data);
              }
            
            })    
        }
        loaddata()


      // ----------TO Delete Data With Ajex ----------- //
      
      $(document).on("click", ".deletebtn", function(){
        swal({
       title: "Are you sure?",
       text: "Once deleted, you will not be able to recover this record",
       icon: "warning",
       buttons: true,
       dangerMode: true,
       })
        .then((willDelete) => {
        if (willDelete) {
           var id = $(this).data("id");
            $.ajax({
             url:"ajexdelete.php",
             type:"POST",
             data:{id:id},
             success: function(data){
              if(data == 1 ){
                loaddata();
             }
        else{
            alert("Failed To Delete Record")
            }
          }
        })
       swal("Deleted successfully",{
      icon: "success",
    });
  }
});
      })
     //---------------------------------------------To Edit and Update data with ajex-------------------------------------------//
    $(document).on("click", ".editbtn" , function(){
      $("#model").show();
      var stdid = $(this).data("id");

    // ----Ajex load data----//
      $.ajax({
        url: "ajexeditloaddata.php",
        type:"POST",
        data:{id:stdid},
        success: function(data){
          $("#edit").html(data);
        }
      })
    })
     // -----------------Ajex Update data--------------- //
     $(document).on("submit", "#edit", function(e){
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url:"ajaxupdatedata.php",
        type:"POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data){
          if(data==1){
          swal("Edited!", "Data Has been edited successfully", "success");
          $("#model").hide();
          loaddata()
          }
          else{
            alert("Failed To Edit Data")
          }
        }
      })
     })

     // ---------To close the Fragment -------------------//
     $("#closebtn").on("click",function(){
        $("#model").hide();
      })



      //--------------------------------------------------------Add data with ajex--------------------------------------------------------//
    $("#adddata").on("click", function(){
      $("#model2").show();
      $.ajax({
        url: "ajexaddform.php",
        type:"POST",
        success: function(data){
          $("#add").html(data);
        }
      })
    })

    $(document).on("submit", "#add", function(e){
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url:"ajexadd.php",
        type:"POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response){
          if(response == 1){
            swal("Added!", "Data Has been added successfully", "success");
            $("#model2").hide();
            loaddata();
         } else {
          alert("Failed to add data");
         }
         },
         error: function(xhr, status, error) {
           alert("An error occurred: " + error);
        }
      })
     })
    
    $("#closebtn2").on("click",function(){
        $("#model2").hide();
      })
//----------------------------------------------------------------------------------------------------------------------------------------//

//----------------view data with ajex--------------------//
$(document).on("click" ,".viewbtn",function(){
  var id = $(this).data("id");
  $("#model3").show();
  $.ajax({
    url:"ajaxview.php",
    type:"POST",
    data:{id:id},
    success: function(data){
      $("#viewpage").html(data)
    }
  })
})
$("#closebtn3").on("click",function(){
        $("#model3").hide();
      })

//----------------view Resultcard with ajex--------------------//
$(document).on("click" ,".resultcardbtn",function(){
  var id = $(this).data("id");
  $("#model4").show();
  $.ajax({
    url:"ajaxresultcard.php",
    type:"POST",
    data:{id:id},
    success: function(data){
      $("#resultcardpage").html(data)
    }
  })
})
$("#closebtn4").on("click",function(){
        $("#model4").hide();
      })  
      
//----------------Copy data with ajax with ajex--------------------//
$(document).on("click", ".copybtn", function(){
  swal({
  title: "Are you sure?",
  text: "This will copy the current record",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    var id = $(this).data("id");
        $.ajax({
          url:"ajaxcopy.php",
          type:"POST",
          data:{id:id},
          success: function(data){
            if(data == 1 ){
              loaddata();
            }
            else{
              alert("Failed To Copy Record")
            }
          }
        })
    swal("Record has been copied successfully", {
      icon: "success",
    });
  } 
});
      })


})




</script>

</body>
</html>