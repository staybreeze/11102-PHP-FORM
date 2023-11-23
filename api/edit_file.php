<?php
include_once "../db.php";
if (isset($_POST['id'])) {
    $file = find('files', $_POST['id']);
} else {
    exit();
}

// ----媒體----

if (!empty($_FILES['img']['tmp_name'])) {

    // 以下三行在新增時已執行
    // $tmp = explode(".", $_FILES['img']['name']);
    // $subname = "." . end($tmp);
    // $filename= date("YmdHis") . rand(10000, 99999) . $subname;

    // ----檔名----

    if ($_POST['name'] != $file['name']) {
        // 先搬移
        // $_POST['name']已經在新增時產生$filename(eg. 546451564.jpg)
        move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_POST['name']);
        $file['name'] = $_POST['name'];
    } else {
        // 如果新檔名跟舊檔名一樣，代表無修改，因此只要搬移檔案就好
        move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_POST['name']);
    }

    // ----媒體----

    //  利用switch轉化複雜檔名
    switch ($_FILES['img']['type']) {
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            $type = "msword";
            break;
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            $type = 'msexcel';
            break;
        case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            $type = 'msppt';
            break;
        case "application/pdf":
            $type = 'pdf';
            break;
        case "image/webp":
        case "image/jpeg":
        case "image/png":
        case "image/gif":
        case "image/bmp":
            // 維持原本檔名
            $type = $_FILES['img']['type'];
            break;
        default:
            $type = 'other';
    }


    // 副檔名
    if ($type != $file['type']) {
        $file['type'] = $type;
        $subname = end(explode(".", $_FILES['img']['name']));
        $tmp = explode(".", $file['name']);
        // 陣列的最後一個索引值可以用count-1
        $tmp[count($tmp) - 1] = $subname;
        $file['name'] = join(".", $tmp);
    }

    $file['type'] = $type;
    $file['size'] = $_FILES['img']['size'];
} else {
    // 檔名
    if ($_POST['name'] != $file['name']) {

        rename('../imgs/' . $file['name'], '../imgs/' . $_POST['name']);
        $file['name'] = $_POST['name'];
    }
}

// ----描述----

if ($_POST['desc'] != $file['desc']) {
    $file['desc'] = $_POST['desc'];
}

update('files', $_POST['id'], $file);

header("location:../manage.php");

    // header("location:../edit_file.php?err=上傳失敗");
