<?php 
require_once("connection.php");
ini_set('auto_detect_line_endings', true);
if(isset($_POST["upload"])){
    var_dump($_FILES);
    $file_name =  $_FILES["csv"]["name"];
    // echo "<br>";
    // echo $_FILES["csv"]["tmp_name"];
    echo "hello";
    if($_FILES["csv"]["size"] > 0){
        echo "hello2";
        $file = fopen($file_name,"r");
        $take = fgetcsv($file);
        while(($column = fgetcsv($file,1000,",")) !== FALSE){
            echo "hello";
            $first_name =  escape_this_string($column[0]);
            $last_name =  escape_this_string($column[1]);
            $address =  escape_this_string($column[2]);
            $company =  escape_this_string($column[3]);
            $city =  escape_this_string($column[4]);
            $country =  escape_this_string($column[5]);
            $state =  escape_this_string($column[6]);
            $zip =  escape_this_string($column[7]);
            $phone1 =  escape_this_string($column[8]);
            $phone2 =  escape_this_string($column[9]);
            $email =  escape_this_string($column[10]);
            $web =  escape_this_string($column[11]);
            echo "<br />";

            $sql = "INSERT INTO customers(first_name,last_name,address,company,state,zip,phone1,phone2,email,web,created_at)
            VALUES('$first_name','$last_name','$address','$company','$state','$zip','$phone1','$phone2','$email','$web',NOW())";
            $run_query = run_mysql_query($sql);
            echo "hello";
            echo $sql;
            echo "<br /><br />";
            header("Location: index.php");
        }
       
    }


}
?>