<?php
// 指定目錄路徑
$dir = "./imgs";

// 掃描目錄並列出所有文件
$files = scandir($dir);
print_r($files);
// 預設圖片檔案名稱
$filestr = 'beauty';

// 輸出圖片列表的 HTML 開始標籤
echo "<ul>";

// 確認文件陣列不為空
if (!empty($files)) {
    // 遍歷文件陣列
    foreach ($files as $idx => $file) {
        // 檢查是否是縮略圖且是否是文件
        if (str_contains($file, 'thumb') && is_file($dir . "/" . $file)) {
            // 獲取文件擴展名
            $ext = explode(".", $file)[1];
            echo $ext;

            // 構建新的文件名
            $filename = 'thumb_' . $filestr . sprintf("%04d", $idx + 1) . "." . $ext;

            // %04d是格式化字符串的一部分，它告訴 sprintf() 函數將數字格式化為至少4位數，並在必要時使用前導零進行填充。具體解釋如下：

            // %：表示格式化字符串的開始。
            // 0：表示使用零進行填充。
            // 4：表示最小寬度為4個字符。
            // d：表示參數應被視為十進制整數。
            // $idx + 1：這是要格式化的整數值，它是索引 $idx 的值加1。

            // 重命名文件
            rename($dir . "/" . $file, $dir . "/" . $filename);
            // 這行程式碼是將檔案 $file 從目前的路徑 $dir 移動或重新命名為 $filename。
            // 這裡使用了 rename() 函式，它接受兩個參數，分別是舊的檔案路徑和新的檔案路徑。
            // 在這行程式碼中，舊的檔案路徑是 $dir . "/" . $file，新的檔案路徑是 $dir . "/" . $filename。
            
            // 輸出圖片列表的 HTML 標籤
            echo "<li>";
            echo "<img src='$dir/$filename'>";
            echo "</li>";
        }
    }
}

// 輸出圖片列表的 HTML 結束標籤
echo "</ul>";
