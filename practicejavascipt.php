<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>Document</title>
</head>
<body align='center' bgcolor="lightgrey">
    <h2>JavaScript Practice</h2><hr><br><br>
    <form action="" method="post">
      Enter First Number:<input type="number" id="firstnum"><br><br>
      Enter Second Number:<input type="number" id="secondnum"><br><br>
      <input type="submit"  id="add" value="Enter Data"><br><br>
    </form>

    <hr><b style="font-size: 16px;">The Addition of your input is:</b><p id="result">----------</p>

    <p id="para">Change ME</p>


  <script>
    document.getElementById('add').addEventListener('click',function(event){
        event.preventDefault();
        var firstnum = parseFloat(document.getElementById('firstnum').value );
        var secondnum = parseFloat(document.getElementById('secondnum').value );

        if (!isNaN(firstnum) && !isNaN(secondnum)) {
        var num = myfunction(firstnum,secondnum);
        document.getElementById('result').innerHTML= num;
        }
        else{
            document.getElementById('result').innerHTML= "Please Enter valid number";
        }
    });
    function myfunction($num1,$num2){
        return $num1+$num2
    }  
  </script>



<!-- Jquery Practice -->
<script>
  $(document).ready(function(){
    $("#para").on({
      click: function(){
        $(this).css("background-color", "red")
      },
      mouseenter: function(){
        $(this).css("background-color", "blue")
      },
      mouseleave: function(){
        $(this).css("background-color", "lightgrey")
      }
    })
  });

</script>
  

</body>
</html>