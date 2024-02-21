<?php
// 指定目錄路徑
$dir = "./imgs";

// 掃描目錄並列出所有文件
$files = scandir($dir);

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

            // 構建新的文件名
            $filename = 'thumb_' . $filestr . sprintf("%04d", $idx + 1) . "." . $ext;

            // 重命名文件
            rename($dir . "/" . $file, $dir . "/" . $filename);

            // 輸出圖片列表的 HTML 標籤
            echo "<li>";
            echo "<img src='$dir/$filename'>";
            echo "</li>";
        }
    }
}

// 輸出圖片列表的 HTML 結束標籤
echo "</ul>";
?>
