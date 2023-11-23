<?php
include_once "../db.php";

$id=$_GET['id'];

del('files',$id);

header("location:../manage.php");