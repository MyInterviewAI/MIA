<?php
include_once('./_common.php');
header('Content-Type: application/json; charset=utf-8');  // UTF-8 헤더 설정
sql_connect('localhost', 'myai', 'whdals7721!', 'myai');

$sql = "SELECT * FROM convgpt WHERE id = '{$member['mb_id']}'";

$result = sql_query($sql, false);
$data = array();

if ($result->num_rows > 0) {
    // 결과를 연관 배열로 반환
    while($row = $result->fetch_assoc()){
        //$data[] = $row; // 데이터를 배열에 추가"
        $data[] = [
            "role" => "user",
            "content" => $row['myconv']
        ];
        $data[] = [
            "role" => "assistant",
            "content" => $row['gptconv']
        ];
    }
}

// 데이터를 JSON 문자열로 변환하여 출력
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>
