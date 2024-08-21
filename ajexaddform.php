

<?php
   $data="
    <form enctype='multipart/form-data'>
        <h2>Student Information</h2><hr><br>
        Name: <input type='text' id='name' name='name' required><br>
        Age: <input type='number' id='age' name='age' required><br>
        Gender: <input type='radio' id='gender' name='gender' value='Male'>Male
                <input type='radio' id='gender' name='gender' value='Female'>Female
                <input type='radio' id='gender' name='gender' value='Other'>Other 
                <br>
        Date of Birth: <input type='date' id='dob' name='dob'><br><br>
        <input type='file' id='img' name='img'><br><br>

        <b>Enter Obtained Marks</b><br><br>
        English: <input type='number' name='englishmarks' id='englishmarks'> <br>
        Math: <input type='number' name='mathmarks' id='mathmarks'> <br>
        Urdu: <input type='number' name='urdumarks' id='urdumarks'> <br><br>
        
        <b>Guardian Details</b><br><br>
        Guardian Name: <input type='text' id='guardianname' name='guardianname'><br>
        Relatation: <input type='text' id='relation' name='relation'><br>
        contact Info: <input type='number' id='contactinfo' name='contactinfo'><br><br><hr>
        
        <input type='submit' value='Add' style='width: 100px; height: 25px'>
    </form>";
    echo $data;
?>