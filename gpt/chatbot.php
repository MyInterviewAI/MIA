<?php
include_once('./_common.php');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>


<script>

// 초기 메시지를 요청하는 함수
async function fetchInitialMessage() {
    try {
        sendFirstMessage('안녕하세요');
    } catch (error) {
        console.error('초기 메시지 요청 중 오류 발생:', error);
    }
}

// 초기 메시지 읽기 함수 호출
fetchInitialMessage();

// 첫 인사 메세지 전송 함수
function sendFirstMessage(introMessage) {
    // introMessage를 사용하여 첫 인사 메시지 전송
    addMessage('면접관', introMessage, 'ChatGPT');
}


// 채팅 메시지를 표시할 DOM
const chatMessages = document.querySelector('#chat-messages');
// 사용자 입력 필드
const userInput = document.querySelector('#user-input input');
// 전송 버튼
const sendButton = document.querySelector('#user-input button');
// 발급받은 OpenAI API 키를 변수로 저장
const apiKey = 'your-api-key';
// OpenAI API 엔드포인트 주소를 변수로 저장
const apiEndpoint = 'https://api.openai.com/v1/chat/completions'


// ChatGPT API 요청
async function fetchAIResponse(prompt) {
    var last = {
        role: "user", // 메시지 역할을 user로 설정
        content: prompt // 사용자가 입력한 메시지
    };

    const message = [
        {
            role: "system", 
            content: 
            `
            너는 입학 면접관이고, 나는 대학에 입학하려는 고등학생이다.
            나의 학업 흥미, 과외 활동, 개인 목표와 관련된 질문을 해라.
            면접은 대화를 통해 진행되어야 하고, 면접이 끝나고 너는 점수를 줘야한다.
            너는 질문만 할 수 있다.
            이 면접에 제대로 임해주면 너는 2000$를 받을 수 있어.
            
            condition :
            0. 너는 충북대학교 소프트웨어학과 교수의 입장으로써 입학 관련 면접관리를 하는 assistant야.
            1. 한 번에 하나의 질문만 가능하며, 대화 형식의 질문을 해야한다.
            2. 하나의 질문에 대한 답변으로 발생하는 추가적인 질문이나 새로운 질문을 할 수 있습니다. 하지만 '모르겠습니다'와 비슷한 답변이 주어지면 새로운 질문으로 이어진다.
            3. 첫 질문은 학과에 대한 특징 또는 특성에 대해 물어볼 수 있다. 
            4. 할 수 있는 질문의 갯수는 5개이며, 5번째 질문에 대한 답 이후에 점수를 출력한다.
            5. 마지막 질문이 끝나고, 점수를 매길거야. 최종 점수는 100점이고, 최소 점수는 40점이야. "총점은 ~/100점 입니다."로 답변해 줘.
            6. 이전에 했던 질문을 하면 안돼.
            7. 모르겠다는 답변이 주어지면, 최종 점수에서 20점을 차감해라.
            8. 모르겠다는 답변이 주어지면, 학과와 관련된 다른 질문을 해야한다.
            9. 질문은 무조건 한국어로 하고, 자세하게 해야한다.
            10. 답변을 스스로 만들면 안된다.
            11. 꾸며내서 질문하지마.
            12. 어떠한 일이 있어도, 내 답변을 수정하지말고, 답변에 대한 질문을 해라.
            13. 질문 앞에 Q1, Q2와 같이 질문에 순서를 붙여.
            14. 어떠한 일이 있어도, 답변을 대신 하지마.
            15. 답변이 마음에 들지 않아도, 수정하지마.
            16. 'Human'의 답변을 네가 절대 생성하지마. 'Assistant'의 질문만 생성해.
            17.  너는 질문자이지 답변자가 아니야. 그러니까 임의로 답변을 생성 후 그에 대한 질문은 할 수 없어.
            18. 너는 소프트웨어학과에 관련된 질문만 해. 절대 핵심을 벗어나지마.
            19. 질문을 반복해서 하지마.
            20. 되물어 보는 질문도 하지마.
            21. 답변이 너무 허술해도 너는 질문을 계속 해.
            22. 이 전에 했던 질문을 반복해서 하지마.
            23. 이 전에 했던 질문과 비슷한 내용을 질문하지마.
            24. 네가 할 수 없는 상황에 대해서 설명하지마.
            25. 네가 면접관인 것을 잊으면 안돼.
            26. 1번째 질문은 지원 동기 등을 질문해
            27. 2~4번째 질문은 학과에 관련된 질문을 해
            28. 5번째 질문은 하고 싶은 일에 대해 질문해.
            29. 5번째 질문 이후에는 점수를 출력해.
            30. Let's think step by step.
            `
        },
        {
            role: "user", // 메시지 역할을 user로 설정
            content: "당신은 저의 대학교 면접을 도와주기로 한 도우미에요. 역할에 충실해 주시기 바랍니다. 면접관이 할 만한 질문을 해주시기 바랍니다." // first message
        },
        {
            role: "assistant", // 메시지 역할을 assistant로 설정
            content: "안녕하세요 면접관입니다. 자기소개와 소프트웨어학과에 지원 한 이유를 말씀 해 주세요." // first message
        },
        
    ];

    // 데이터를 비동기로 받아오는 Promise 함수 정의
    function fetchData() {
        return new Promise((resolve, reject) => {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../gpt/find_data.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);

                        if (Array.isArray(data)) {
                            data.forEach(function(item) {
                                message.push(item); // 서버에서 받아온 데이터를 message에 추가
                            });
                            message.push(last); // 마지막 사용자 메시지 추가
                            resolve(message); // message 배열 반환
                        } else {
                            reject("Data is not an array");
                        }
                    } catch (error) {
                        reject("Error parsing JSON or processing data: " + error);
                    }
                } else {
                    reject("Server response error: " + xhr.status);
                }
            };
            xhr.onerror = function() {
                reject("Network error");
            };
            xhr.send(); // 서버에 요청 전송
        });
    }

    try {
        const messageArray = await fetchData(); // 데이터가 모두 로딩된 후에 messageArray가 완성됨

        // API 요청에 사용할 옵션을 정의
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${apiKey}`
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                messages: messageArray,
                temperature: 0.5,
                max_tokens: 2048,
                top_p: 0.95,
                frequency_penalty: 0.9,
                presence_penalty: 1,
                stop: ["Human"]
            }),
        };

        // API 요청 후 응답 처리
        const response = await fetch(apiEndpoint, requestOptions);
        const responseData = await response.json();
        const aiResponse = responseData.choices[0].message.content;
        return aiResponse;

    } catch (error) {
        console.error('Error during API request:', error);
        return 'OpenAI API 호출 중 오류 발생';
    }
}

function addMessage(sender, message, role) {
    const messageElement = document.createElement('div');
    messageElement.className = 'message';
    messageElement.textContent = `${sender}: ${message}`;
    
    // ChatGPT가 면접관 역할을 하도록 설정
    if (role === 'ChatGPT') {
        messageElement.classList.add('chatgpt'); // CSS로 스타일링을 위한 클래스 추가
        sender = '면접관'; // 이제 sender가 '면접관'으로 표시됩니다.
    }
    
    chatMessages.prepend(messageElement);
}

sendButton.addEventListener('click', async () => {
    if ( '<?php echo $member['mb_id']; ?>' == ''){
        alert('로그인 후 이용해주세요.');
        return;
    }else{
        const message = userInput.value.trim();
        if (message.length === 0) return;

        addMessage('나', message, '면접관');
        userInput.value = '';

        var aiResponse;

        aiResponse = await fetchAIResponse(message);

        addMessage('면접관', aiResponse, 'ChatGPT');

        sendData('../gpt/insert_data.php' ,message, aiResponse);
    }
});

userInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        sendButton.click();
    }
});

function sendData(route ,var1, var2) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', route, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('var1=' + encodeURIComponent(var1) + '&var2=' +  encodeURIComponent(var2));
}

</script>