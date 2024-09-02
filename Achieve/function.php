<?php
require "dbconnect.php";

function getParams()
{
    foreach ($_REQUEST as $key => $value) {
        $GLOBALS[$key] = trim($value);
    }
}

function signup($mail, $fname, $lname, $age, $gender, $pass, $country, $city)
{
    echo $city;
    global $conn;
    $countryid = "null";
    $cityid = "null";

    if ($mail != "" && $pass != "" && $age != "" && $fname != "" && $lname != "" && $gender != "") {
        if ($country != "") {
            $statement = "SELECT * FROM `countries` WHERE `name` = :country";
            $stmt = $conn->prepare($statement);
            $stmt->bindParam(':country', $country);
            $stmt->execute();
            $number_of_rows = $stmt->rowCount(); 

            if ($number_of_rows > 0) {
                foreach ($stmt->fetchAll() as $k => $v) {  
                    $countryid = "'".$v["id"]."'";  
                }
            }
        }

        if ($city != "") {
            $statement = "SELECT * FROM `city` WHERE `name` = :city";
            $stmt = $conn->prepare($statement);
            $stmt->bindParam(':city', $city);
            $stmt->execute();
            $number_of_rows = $stmt->rowCount();

            if ($number_of_rows > 0) {
                foreach ($stmt->fetchAll() as $k => $v) {
                    $cityid = "'".$v['id']."'";
                }
            }
        }

        echo "country: $countryid city: $cityid";
        try {
            $sql = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `gender`, `password`, `countryid`, `cityid`) VALUES (:fname, :lname, :email, :gender, :password, $countryid, $cityid);";  
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':email', $mail);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':password', $pass);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    } 
}

function signin($mail, $pass)
{
    global $conn;
    $res = null; // Initialize $res to null
    try {
        $sql = "SELECT * FROM `user` WHERE BINARY `email`=  BINARY :email AND BINARY `password`= BINARY :password;"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $mail);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();
        $res = $stmt; // Assign the statement to $res if successful
        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); 
    }
    return $res; // Return $res, which will be null if the query failed
}
