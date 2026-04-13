<?php
session_start();
$conn = new mysqli("localhost","root","","real_madrid_db");

// دخول أدمن
if(isset($_POST['login'])){
    if($_POST['pass']=="1111"){
        $_SESSION['admin']=true;
    }
    header("Location:index.php");
}

// خروج
if(isset($_GET['logout'])){
    session_destroy();
    header("Location:index.php");
}

// إضافة فقط للأدمن
if(isset($_POST['add']) && isset($_SESSION['admin'])){
    $title=$_POST['title'];
    $content=$_POST['content'];
    $cat=$_POST['category'];

    $stmt=$conn->prepare("INSERT INTO club_info(title,content,category_id) VALUES(?,?,?)");
    $stmt->bind_param("ssi",$title,$content,$cat);
    $stmt->execute();
}

header("Location:index.php");