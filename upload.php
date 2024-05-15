<?php
function upload_file($file)
{
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_ext = explode(".", $file_name);
    $file_ext = strtolower(end($file_ext));
    $file_name_new = uniqid('', true) . $file_name;
    $file_destination = __DIR__ . '/uploads/' . $file_name_new;

    if (move_uploaded_file($file_tmp, $file_destination)) {
        return "http://localhost/mizustickers" . '/uploads/' . $file_name_new;
    }
    return false;
}
?>