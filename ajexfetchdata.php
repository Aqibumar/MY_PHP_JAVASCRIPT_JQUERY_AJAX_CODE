<?php
    $data = "";
    $data = "<table>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Student Age</th>
        <th>Student Gender</th>
        <th>Date of Birth</th>
        <th>Guardian Name</th>
        <th>Relationship</th>
        <th>Contactinfo</th>
        <th>English</th>
        <th>Grade</th>
        <th>Math</th>
        <th>Grade</th>
        <th>Urdu</th>
        <th>Grade</th>
        <th>Overall Marks</th>
        <th>Overall Grade</th>
        <th colspan='5'>Options</th>
     </tr>";
    include "connection.php";
    $sql = "SELECT * From students";
    $result= $conn->query($sql);
    if($result->num_rows >0){
        while ($row=$result->fetch_assoc()){
            $data .= 
                 "<tr>
                 <td>{$row["id"]}</td>
                 <td>{$row["name"]}</td>
                 <td>{$row["age"]}</td>
                 <td>{$row["gender"]}</td>
                 <td>{$row["dob"]}</td>
                 <td>{$row["guardianname"]}</td>
                 <td>{$row["relationship"]}</td>
                 <td>{$row["contactinfo"]}</td>
                 <td>{$row["englishmarks"]}</td>
                 <td>{$row["englishgrade"]}</td>
                 <td>{$row["mathmarks"]}</td>
                 <td>{$row["mathgrade"]}</td>
                 <td>{$row["urdumarks"]}</td>
                 <td>{$row["urdugrade"]}</td>
                 <td>{$row["marks"]}</td>
                 <td>{$row["grade"]}</td>
                 <td><button class='viewbtn' data-id={$row['id']}>View</button></td>
                 <td><button class='editbtn' data-id={$row['id']}>Edit</button></td>
                 <td><button class='copybtn' data-id={$row['id']}>Copy</button></td>
                 <td><button class='deletebtn' data-id={$row['id']}>Delete</button></td>
                 <td><button class='resultcardbtn' data-id='{$row['id']}'>Result Card</button></td>   
                 </tr>";
        }
        $data .= "</table>"; 
        echo $data;
    }
    ?>