<?php
include_once('./_common.php');
sql_connect('localhost', 'myai', 'whdals7721!', 'myai');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .message {
            border-top: 1px solid #ccc;
            padding: 10px 0;
            margin-top: 5px;
            background-color: #e6e6e6;
        }

        #chat-container {
            margin-top: 1px;
            display: flex;
            flex-direction: column;
            overflow : auto;
            border: 1px solid #ccc;
            width: 100%;
            min-height: 700px; /* 대화창의 최소 높이 설정 */
        }

        #camera_module {
            display: none; /* 초기 상태에서 카메라 모듈 숨김 */
            position: absolute; /* 화면의 특정 위치에 고정 */
            right: -420px; /* 오른쪽에 고정 */
            top: 47px; /* 상단에 고정 */
            width: 35%; /* 화면의 30%를 차지 */
            height: 50%; /* 브라우저 높이 전체를 차지 */
            background-color: #e6e6e6; /* 배경 색 */
            border-left: 1px solid #ccc; /* 좌측 테두리 추가 */
        }

        table {
            width: 100%;
            height: 100%; /* 부모 요소의 높이를 상속 */
        }

        td {
            height: 100%; /* 부모 요소의 높이를 상속 */
            vertical-align: top;
        }

        #chat-messages {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
        }

        #user-input {
            display: flex;
            padding: 10px;
        }

        #user-input input {
            flex: 1;
            padding: 10px;
            outline: none;
        }

        #user-input button {
            border: none;
            background-color: #1e88e5;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
        }

        #camera-activation {
            margin-right: 10px;
            padding: 10px 15px;
            background-color: #1e88e5;
            color: white;
            cursor: pointer;
        }
    </style>
    <title>모의면접</title>
</head>
<body>
    <div id="container_title" style="text-align:left;">
        모의면접
        <button id="camera-activation">카메라 활성화</button>
    </div>

    <table>
        <tr>
            <td id="chat-container">
                <div id="chat-messages">
                <div class="message">면접관: 안녕하세요 면접관입니다. 자기소개와 소프트웨어학과에 지원 한 이유를 말씀 해 주세요.</div>
                </div>
                <div id="user-input">
                    <input type="text" id="korea" placeholder="질문에 대한 답변을 해주세요." />
                    <button><i style="font-size:1.5em;" class="fa-solid fa-microphone"></i></button>
                </div>
            </td>
            <!-- 카메라 -->
            <td id="camera_module">
                <?php include_once('camera.php'); ?>
            </td>
        </tr>
    </table>
    <?php include_once('chatbot.php'); ?>
    <!-- <script src="../gpt/chatbot.js"></script> -->

    <style>
        body {
            text-align: center;
        }
        button {
            padding: 8px;
        }
        #message {
            color: #996600;
        }
        .textbox {
            height: 100px;
            border: 1px solid #d3d3d3;
            flex: 1;
            margin: 5px 15px;
            border-radius: 6px;
            text-align: left;
            padding: 16px;
        }
    </style>

    <h1>면접 내용 마이크 입력</h1>
    <button id="speech" onclick="startSTT()">입력</button>
    <button id="stop" onclick="stopSTT()">Stop</button>
    <p id="message">버튼을 누르고 대화내용을 말하세요.</p>

    <script type="text/javascript">

        console.log("<?php echo $member['mb_id']; ?>");
        var message = document.querySelector("#message");
        var button = document.querySelector("#speech");
        var korea = document.querySelector("#korea");
        var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();
        var isRecognizing = false;
        var isPaused = false;
        var isCameraActive = false; // 카메라 활성화 상태 저장 변수

        recognition.lang = 'ko-KR';
        recognition.interimResults = false;
        recognition.maxAlternatives = 5;

        function startSTT() {
            if (!isRecognizing) { // 음성인식이 이미 시작된 경우 다시 시작하지 않음
                recognition.start();
                isRecognizing = true;
            }
        }

        function stopSTT() {
            recognition.stop();
            isRecognizing = false;
        }

        recognition.onstart = function() {
            console.log("음성인식이 시작되었습니다. 이제 마이크에 무슨 말이든 하세요.");
            message.innerHTML = "음성인식 시작...";
        };

        recognition.onspeechend = function() {
            console.log("사용자가 말을 마쳤습니다.");
            message.innerHTML = "버튼을 누르고 아무 말이나 하세요.";
        };

        recognition.onresult = function(event) {
            console.log('You said: ', event.results[0][0].transcript);
            var resText = event.results[0][0].transcript;
            korea.value = resText;
            text_to_speech(resText);
        };

        recognition.onend = function() {
            console.log("음성인식이 종료되었습니다.");
            isRecognizing = false;
            if (isPaused) {
                startCountdown();
            }
        };

        function startCountdown() {
            var count = 3;
            var countdownInterval = setInterval(function() {
                message.innerHTML = count;
                if (count === 0) {
                    clearInterval(countdownInterval);
                    message.innerHTML = "음성인식 시작...";
                    recognition.start();
                    isRecognizing = true;
                    isPaused = false;
                }
                count--;
            }, 1000);
        }

        function text_to_speech(txt) {
            if ('speechSynthesis' in window) {
                console.log("음성합성을 지원하는 브라우저입니다.");
            }
            var msg = new SpeechSynthesisUtterance();
            var voices = window.speechSynthesis.getVoices();
            msg.voiceURI = 'native';
            msg.volume = 1;
            msg.rate = 1.3;
            msg.text = txt;
            msg.lang = 'ko-KR';
            msg.onend = function(e) {
                console.log('음성합성이 완료되었습니다.');
                isPaused = true;
                setTimeout(startCountdown, 2000); // 음성합성이 완료된 후 2초 후에 카운트다운 시작
            };
            window.speechSynthesis.speak(msg);
        }

        // 페이지 로드 시 카메라 지원 여부 확인
        window.addEventListener("load", function() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        // 카메라 모듈 보이기
                        activateCameraModule();
                        // 스트림 중지 (카메라 접근 확인만 함)
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    })
                    .catch(function(error) {
                        console.error('getUserMedia error:', error);
                        // 카메라 모듈 숨기기
                        document.getElementById('camera_module').style.display = 'none';
                        // 채팅창 전체 너비와 높이로 설정
                        document.getElementById('chat-container').style.width = '100%';
                        document.getElementById('chat-container').style.height = 'auto';
                    });
            } else {
                // 카메라 모듈 숨기기
                document.getElementById('camera_module').style.display = 'none';
                // 채팅창 전체 너비와 높이로 설정
                document.getElementById('chat-container').style.width = '100%';
                document.getElementById('chat-container').style.height = 'auto';
            }
        });

        // 카메라 활성화 버튼 클릭 시 상태 토글
        document.getElementById("camera-activation").addEventListener("click", function() {
            // 브라우저에서 카메라 지원 여부 확인
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("이 브라우저는 카메라를 지원하지 않습니다. 다른 브라우저를 사용하거나 카메라 권한 설정을 확인해주세요.");
            } else {
                // 권한 확인
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                        if (isCameraActive) {
                            deactivateCameraModule();
                        } else {
                            activateCameraModule();
                            startSTT(); // 카메라 활성화시 음성인식 시작
                        }
                    })
                    .catch(function(error) {
                        if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
                            alert("카메라 권한이 거부되었습니다. 브라우저의 카메라 권한 설정을 확인해주세요.");
                        } else {
                            alert("카메라를 활성화하는 중에 오류가 발생했습니다.");
                            console.error('getUserMedia error:', error);
                        }
                    });
            }
        });

        // 카메라 모듈 활성화 함수
        function activateCameraModule() {
            var cameraModule = document.getElementById('camera_module');
            cameraModule.style.display = "block"; // 카메라 모듈 보이기

            // 카메라 활성화 상태 업데이트
            isCameraActive = true;
            document.getElementById("camera-activation").innerText = "카메라 끄기";
        }

        // 카메라 모듈 비활성화 함수
        function deactivateCameraModule() {
            var cameraModule = document.getElementById('camera_module');
            cameraModule.style.display = "none"; // 카메라 모듈 숨기기

            // 카메라 활성화 상태 업데이트
            isCameraActive = false;
            document.getElementById("camera-activation").innerText = "카메라 활성화";
        }


        // 카메라 모듈 비활성화 함수
        function deactivateCameraModule() {
            var chatContainer = document.getElementById('chat-container');
            var cameraModule = document.getElementById('camera_module');

            // 면접 창의 너비를 100%로 설정하고 플로팅 해제
            chatContainer.style.width = "100%";
            chatContainer.style.float = "";

            // 카메라 모듈 숨기기
            cameraModule.style.display = "none";

            // 카메라 활성화 상태 업데이트
            isCameraActive = false;
            document.getElementById("camera-activation").innerText = "카메라 활성화";
        }
    </script>
</body>
</html>
