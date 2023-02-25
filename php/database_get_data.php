<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "../php/database_connect.php");
function check_user_exists($email)
{
    $conn = openCon();
    $sql = "SELECT f_name FROM users WHERE email='$email' || ph_no='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return 1;
        }
    } else {
        return 0;
    }
}
function get_user_state($email)
{
    $conn = openCon();
    $sql = "SELECT user_state FROM users WHERE email='$email' || ph_no='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['user_state'];
        }
    } else {
        return 0;
    }
}

function get_email($email)
{
    $conn = openCon();
    $sql = "SELECT email FROM users WHERE email='$email' || ph_no='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['email'];
        }
    } else {
        return 0;
    }
}
function get_donors()
{
    $supr_arr=array();
    $conn = openCon();
    $sql = "SELECT * FROM donors_list";
    $result = $conn->query($sql);
    $c=0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr = array(
                "name" => $row["name"], "ph_no" =>   $row["ph_no"], "age" => $row["age"], "blood_group" => $row["blood_group"], "gender" => $row["gender"],
                "last_donation_date" => $row["last_donation_date"], "times_donated" => $row["times_donated"], "probable_donor" => $row["probable_donor"],
            );
           $supr_arr[$c++]=$arr;
        }
        $supr_arr["count"]=$c;
        $json = json_encode($supr_arr);
        return $json;
    } else {
        return "nf";
    }
}
function get_donors_filter($group)
{
    $conn = openCon();
    $sql = "SELECT * FROM donors_list WHERE blood_group='$group' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr = array(
                "name" => $row["name"], "ph_no" =>   $row["ph_no"], "age" => $row["age"], "blood_group" => $row["blood_group"], "gender" => $row["gender"],
                "last_donation_date" => $row["last_donation_date"], "times_donated" => $row["times_donated"], "probable_donor" => $row["probable_donor"],
            );
            $json = json_encode($arr);
            return $json;
        }
    } else {
        return "nf";
    }
}
function get_doctors()
{
    $conn = openCon();
    $sql = "SELECT * FROM doctors_list";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr = array(
             "name" => $row["name"], "ph_no" =>   $row["ph_no"],
             "email" => $row["email"], "hospital_id" => $row["hospital_id"], "gender" => $row["gender"] 
            );
            $json = json_encode($arr);
            return $json;
        }
    } else {
        return "nf";
    }
}
function get_hospitals()
{
    $conn = openCon();
    $sql = "SELECT * FROM hospitals_list";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr = array(
                "s_no" => $row["s_no"],"name" => $row["name"], "patients" =>   $row["patients"],
                "doctors" => $row["doctors"]
            );
            $json = json_encode($arr);
            return $json;
        }
    } else {
        return "nf";
    }
}