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
    if (mysqli_query($conn, $sql)) {} 
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


    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $firstname = htmlspecialchars($_POST["firstName"] ?? "");
        $middlename = htmlspecialchars($_POST["middleName"] ?? "");
        $lastname = htmlspecialchars($_POST["lastName"] ?? "");
        $suffix = htmlspecialchars($_POST["suffix"] ?? "");
        $mobilenumber = htmlspecialchars($_POST["mobileNumber"] ?? "");
        $section = htmlspecialchars($_POST["section"] ?? "");
        $technology = htmlspecialchars($_POST["technology"] ?? "");
        $batch = htmlspecialchars($_POST["batch"] ?? "");
        $schoolid = htmlspecialchars($_POST["schoolId"] ?? "");

         $insert = "INSERT INTO students (firstname, middlename, lastname, suffix, mobilenumber, section, technology, batch, schoolid)
                   VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$mobilenumber', '$section', '$technology', '$batch', '$schoolid')";

       if( mysqli_query($conn, $insert)){
            header("Location: database.php");
       }else{
            echo "Error" . mysqli_error($conn);
       }
           
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Database</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="sidebar">
        <a href="">Home</a>
        <a href="">Dashboard</a>
        <a href="">Exit</a>
    </div>

    <div class="main">
        <div class="topbar">
            <a href="">Home</a>
            <a href="">Dashboard</a>
            <a href="index.php">Exit</a>
        </div>

        
        <div class="content">

            <h2>Students Table</h2>
                
            <div class="table">
                <table cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Lastname</th>
                <th>Suffix</th>
                <th>Mobile Number</th>
                <th>Section</th>
                <th>Technology</th>
                <th>Batch</th>
                <th>School ID</th>
                <th>Actions</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM students");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['middlename']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['suffix']}</td>
                        <td>{$row['mobilenumber']}</td>
                        <td>{$row['section']}</td>
                        <td>{$row['technology']}</td>
                        <td>{$row['batch']}</td>
                        <td>{$row['schoolid']}</td>
                        <td>
                            <button>EDIT</button>
                            <button>DELETE</button>
                        </td>
                    </tr>
            ";}
            ?>
             </table>

            </div>
        </div>
    </div>

<script src="assets/js/database.js"></script>
</body>
</html>