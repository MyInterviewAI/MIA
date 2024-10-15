<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Interview Ai - No.1 대입면접 서비스</title>
    <?php include_once(G5_PATH.'/head.php'); ?>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-image: url('./img/background.jpg');
            background-color: #6d707f;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; /* 이미지 반복 제거 */
        }
        #wrapper {
            min-height: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
		
		/*
        .bg-primary {
            background-color: #6d707f; /* 배경 색상 설정 */
            border-top: 1px solid #ffffff; /* border 색상 설정 */
        }
		*/
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <?php include_once(G5_PATH.'/head.php'); ?>
        </div>
        <!-- 페이지의 내용 -->
        <div style="font-size:3.5em; color:#fff;">
            <h2>My Interview Ai</h2>
            <p>텍스트로 모의면접.</p>
        </div>
    </div>

    <?php include_once(G5_PATH.'/tail.php'); ?>
    
<!--
<div style="margin-top:-1px; padding-bottom:50px;">
    <?php
	/*
        $height = 0; // 초기 높이 설정
        $color = 0; // 초기 색상 설정 (검정색의 rgb 값은 0)
        for ($i = 0; $i < 25; $i++) { // 24개의 div 생성
            echo '<div class="bg-primary" style="margin-top:'.$i.'px;height:'.$height++.'px;background-color:rgb('.$color.','.$color.','.$color.')"></div>';
            $color += 50; // 색상 값 증가
        }
	*/
    ?>
</div>
-->

</body>
</html>
