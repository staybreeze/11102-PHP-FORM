<?php

/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */
include_once "./db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="header">檔案管理練習</h1>
    <!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->
    <h3><a href="upload.php">上傳檔案</a></h3>




    <!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->
    <?php
    $files = all('files');

    ?>
    <div class="col-8 mx-auto">
        <table class='table table-success'>
            <tr>
                <td>id</td>
                <td>檔名</td>
                <td>類型</td>
                <td>大小</td>
                <td>描述</td>
                <td>上傳時間</td>
                <td>操作</td>
            </tr>
            <?php
            foreach ($files as $file) {
                // 透過switch製作不同檔案的img顯示結果
                // 因為'type'已經在upload.php分類成不同$type，因此可以沿用
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
                <tr>
                    <td><?= $file['id']; ?></td>
                    <!-- 指定顯示的結果為img -->
                    <td><img class='thumbs' src="<?= $imgname; ?>"></td>
                    <td><?= $file['type']; ?></td>
                    <td><?= $file['size']; ?></td>
                    <td><?= $file['desc']; ?></td>
                    <td><?= $file['create_at']; ?></td>
                    <td>
                        <button class="btn btn-info" onclick="location.href='./api/edit_file.php?id=<?= $file['id'];?>'">編輯</button>
                        <!-- 把刪除的資料帶給del_file.php -->
                        <!-- <button class="btn btn-danger"><a href='./api/del_file.php?id=<?//= $file['id'];?>'>刪除</a></button> -->
                        <button class="btn btn-danger" onclick="location.href='./api/del_file.php?id=<?= $file['id'];?>'">刪除</a></button>
                   
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>