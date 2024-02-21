<?php

/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

// 檢查是否有上傳檔案
// 如果有上傳檔案，則執行以下操作
if (!empty($_FILES['img']['tmp_name'])) {

    // 移動上傳的檔案到指定目錄
    move_uploaded_file($_FILES['img']['tmp_name'], './imgs/' . $_FILES['img']['name']);

    // 指定上傳的檔案路徑
    $source_path = './imgs/' . $_FILES['img']['name'];

    // 取得上傳檔案的類型
    $type = $_FILES['img']['type'];

    // 根據檔案類型進行相應的處理
    switch ($type) {
        case 'image/jpeg':
            // 創建一個 JPEG 圖像
            $source = imagecreatefromjpeg($source_path);
            list($width, $height) = getimagesize($source_path);
            // list($width, $height) 是 PHP 中的一種語法，用於將陣列的值分別賦予多個變數。

            // 在這裡，list($width, $height) 會從函數 getimagesize($source_path) 返回的陣列中，取出第一個元素賦值給 $width，取出第二個元素賦值給 $height。

            // 簡單來說，這行程式碼將 getimagesize($source_path) 函數返回的圖像寬度和高度值分別賦值給了 $width 和 $height 這兩個變數。
                    break;
        case 'image/png':
            // 創建一個 PNG 圖像
            $source = imagecreatefrompng($source_path);
            list($width, $height) = getimagesize($source_path);
            break;
        case 'image/gif':
            // 創建一個 GIF 圖像
            $source = imagecreatefromgif($source_path);
            list($width, $height) = getimagesize($source_path);
            break;
        case 'image/bmp':
            // 創建一個 BMP 圖像
            $source = imagecreatefrombmp($source_path);
            list($width, $height) = getimagesize($source_path);
            break;
    }

    // 指定壓縮後的圖像路徑
    $dst_path = './imgs/small_' . $_FILES['img']['name'];

    // 指定壓縮後的圖像寬度和高度
    $dst_width = 150;
    $dst_height = 200;

    // 創建一個指定大小的真彩色圖像
    $dst_source = imagecreatetruecolor($dst_width, $dst_height);

    // 重取樣拷貝圖像的一部分到指定大小的圖像
    imagecopyresampled($dst_source, $source, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);

    // 根據檔案類型進行相應的處理
    switch ($type) {
        case 'image/jpeg':
            // 將圖像保存為 JPEG 格式
            imagejpeg($dst_source, $dst_path);
            break;
        case 'image/png':
            // 將圖像保存為 PNG 格式
            imagepng($dst_source, $dst_path);
            break;
        case 'image/gif':
            // 將圖像保存為 GIF 格式
            imagegif($dst_source, $dst_path);
            break;
        case 'image/bmp':
            // 將圖像保存為 BMP 格式
            imagebmp($dst_source, $dst_path);
            break;
    }

    // 釋放原始圖像資源
    imagedestroy($source);
    // 釋放壓縮後的圖像資源
    imagedestroy($dst_source);
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形檔案處理</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="header">圖形處理練習</h1>
    <!---建立檔案上傳機制--->
    <form action="?" method="post" enctype="multipart/form-data">
        <label for="">選擇檔案:</label>
        <input type="file" name="img" id="">
        <input type="submit" value="上傳">
    </form>


    <!----縮放圖形----->
    <img src="<?= $dst_path; ?>" alt="">

    <!----圖形加邊框----->


    <!----產生圖形驗證碼----->



</body>

</html>