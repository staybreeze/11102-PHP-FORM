<?php
include_once "./db.php";
if (isset($_GET['id'])) {
    $file = find('files', $_GET['id']);
} else {
    exit();
}
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯檔案</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
</head>

<body>
    <h1 class="header">編輯檔案</h1>
    <!----建立你的表單及設定編碼----->
    <?php

    if (isset($_GET['err'])) {
        echo $_GET['err'];
    }

    ?>
    <div class="text-center"><a href="manage.php">回列表</a></div>
    <form action="./api/edit_file.php" method="post" enctype="multipart/form-data">
        <div class="col-6  mx-auto">
            <table class="table">
                <tr>
                    <td>媒體</td>
                    <td>
                        <?php
                    switch ($file['type']) {
                        // image顯示原圖
                    case "image/webp":
                    case "image/jpeg":
                    case "image/png":
                    case "image/gif":
                    case "image/bmp":

                        // 創造一個新的變數儲存顯示的img的路徑
                        $imgname = "./imgs/" . $file['name'];
                        break;
                    case 'msword':
                        $imgname = "./icon/wordicon.png";
                        break;
                    case 'msexcel':
                        $imgname = "./icon/msexcel.png";
                        break;
                    case 'msppt':
                        $imgname = "./icon/msppt.png";
                        break;
                    case 'pdf':
                        $imgname = "./icon/pdf.png";
                        break;
                    default:
                        $imgname = "./icon/other.png";
                }
                ?>
                <img src="<?=$imgname;?>" alt=""  style="width:300px;250px">
                        <input type="file" name="img" id="">
                </td>
                </tr>
                <tr>
                    <td>檔名</td>
                    <td><input type="text" name="name" id="" value="<?= $file['name'];?>"></td>
                </tr>
                <tr>
                    <td>說明</td>
                    <td><textarea type="text" name="desc" id="" style="width:350px;height:200px"><?=$file['desc']?></textarea></td>
                </tr>
            </table>
            <div class="text-center m-3">
                <input type="submit" value="更新">
            </div>
        </div>
    </form>



    <!----建立一個連結來查看上傳後的圖檔---->
    <?php

    if (isset($_GET['img'])) {
        echo "<img src='./imgs/{$_GET['img']}' style='width:250px;height:150px'>";
    }

    ?>

</body>

</html>