<?php
include_once "../db.php";

$id=$_GET['id'];

// 給予unlink刪除
$id=$_GET['id'];
$file=find('files',$id)['name'];

del('files',$id);

unlink('../imgs/'.$file);


header("location:../manage.php");