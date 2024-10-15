<?php
include_once('./_common.php');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
if (isset($_POST['var1']) && isset($_POST['var2'])) {
    $message = $_POST['var1'];
    $aiResponse = $_POST['var2'];
} else {
    echo '데이터가 없습니다.';
}

sql_connect('localhost', 'myai', 'whdals7721!', 'myai');

// MySQL 데이터베이스 연결
$sql = "INSERT INTO convgpt (id, convnum, myconv, gptconv, convorder) VALUES ('{$member['mb_id']}', '', '{$message}', '{$aiResponse}', '')";
sql_query($sql, false);

?>