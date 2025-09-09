<?php 
    // mysql connection requirements
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "studentdb"; //mysql database name
    $conn = "";
    

    try{
        //tries connect to the mysql 
        $conn = mysqli_connect($db_server,$db_user,$db_pass);
    }
    catch(mysqli_sql_exception){
        die("Connection Failed " . mysqli_connect_error());
    }

    //create database if it does not exists and stores it to $sql
    $sql = "CREATE DATABASE IF NOT EXISTS $db_name";  


    //uses the $conn to connect to the mysql then executes the $sql to create database
    if (mysqli_query($conn, $sql)) {
        echo "Database checked/created!<br>";
    } 
    else{
         die("Error creating database: " . mysqli_error($conn));
    }
    

    //connect to the created database and stores it to the $conn database
    $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);

    //create table requirements and stores it to the $table variable
    $table = "CREATE TABLE IF NOT EXISTS students(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(12) NOT NULL,
        middlename VARCHAR(12) NOT NULL,
        lastname VARCHAR(12) NOT NULL,
        suffix VARCHAR(10),
        mobilenumber CHAR(11) NOT NULL,
        section VARCHAR(1) NOT NULL,
        technology VARCHAR(20) NOT NULL,
        batch VARCHAR(10) NOT NULL,
        schoolid VARCHAR(20) NOT NULL
    )";

    //it connects to the mysql using $conn and execute the $table 
    mysqli_query($conn,$table);

    
?>


 
const dashboardbtn = document.getElementById('dashboardbtn');

dashboardbtn.addEventListener('click', function(){
  // window.location.href = 'database.php';
  alert("Hello");
})






const dashboardbtn = document.getElementById('dashboardbtn');

dashboardbtn.addEventListener('click', function(){
  // window.location.href = 'database.php';
  alert("Hello");
})
