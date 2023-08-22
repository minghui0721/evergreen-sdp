<?php
function ClassNameCheck($ClassName){
    include "../dbConn.php";

    //Check the class name exist or not
    $ClassCheck_query="SELECT * FROM `class` WHERE `class_name`='$ClassName'";
    $ClassCheck_result=mysqli_query($connection,$ClassCheck_query);
    $ClassCheck_count=mysqli_num_rows($ClassCheck_result);

    if($ClassCheck_count!=0){
        return "Classroom Exist";
    }
    else{
        return "pass";
    }
}
?>