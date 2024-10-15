<?php
// MySQL 데이터베이스 연결
$servername = "127.0.0.1";
$username = "cbnu";
$password = "koaroo1!";
$dbname = "cbnu";

// POST 데이터 수신
$userMessage = @$_POST['user_message']; // 클라이언트에서 전송된 사용자 메시지
$chatbotReply = ''; // 여기에 챗봇 응답을 받으면 저장

// 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결에 실패했습니다: " . $conn->connect_error);
}

// SQL 쿼리 생성
$sql = "INSERT INTO chat_history (gr_id, chat_index, user_input, chatbot_reply) VALUES ('$userMessage', '$chatbotReply')";

// 쿼리 실행
if ($conn->query($sql) === TRUE) {
    //echo "메시지가 성공적으로 저장되었습니다.";
} else {
    echo "에러: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 닫기
$conn->close();
?>