<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$nick = get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
if($kind == "recv") {
    $kind_str = "보낸";
    $kind_date = "받은";
}
else {
    $kind_str = "받는";
    $kind_date = "보낸";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지보기 시작 { -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) { -->
    <section class="content-header">
        <div class="container"><!--div class="container-fluid" -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $g5['title']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo G5_URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $g5['title']; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- } Content Header (Page header) -->

    <!-- Main content { -->
    <section class="content">
        <div class="container"><!--div class="container-fluid" -->
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $g5['title']; ?></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="bi bi-dash-lg"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new_win_con2">
                                <!-- 쪽지함 선택 시작 { -->
                                <a class="btn<?php if ($kind == 'recv') { ?> bg-gradient-info<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo.php?kind=recv">받은 쪽지</a>
                                <a class="btn<?php if ($kind == 'send') { ?> bg-gradient-success<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo.php?kind=send">보낸 쪽지</a>
                                <a class="btn<?php if (!$kind) { ?> bg-gradient-warning<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo_form.php">쪽지 쓰기</a>
                                <!-- } 쪽지함 선택 끝 -->

                                <div class="memo_list">
                                    <ul>
                                        <li>
                                            <div class="memo_li profile_big_img">
                                                <?php echo get_member_profile_img($mb['mb_id']); ?>
                                            </div>
                                            <div class="memo_li memo_name">
                                                <?php echo $nick; ?> <span class="sound_only"><?php echo $kind_date; ?>시간</span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $memo['me_send_datetime'] ?>
                                                <div class="memo_preview">
                                                    <a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $memo_preview; ?></a>
                                                </div>
                                            </div>
                                            <a class="float-right" href="<?php echo $del_link; ?>" onclick="del(this.href); return false;" class="memo_del btn_b01 btn"><i class="fa fa-trash-o" aria-hidden="true"></i> <span class="sound_only">삭제</span></a>
                                        </li>
                                        
                                        <div class="container" style="margin:10px;"><?php echo conv_content($memo['me_memo'], 0); ?></div>
                                        <div class="win_btn" style="padding-top:20px;">
                                            <?php if ($kind == 'recv') {  ?><a href="./memo_form.php?me_recv_mb_id=<?php echo $mb['mb_id']; ?>&amp;me_id=<?php echo $memo['me_id'] ?>" class="btn btn-primary">답장</a><?php }  ?>
                                            <!--button type="button" onclick="window.close();" class="btn_close">창닫기</button -->
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.card-body -->

                        <!--div class="card-footer">
                            Footer
                        </div --><!-- /.card-footer-->
                    </div><!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    <!-- } Main content -->
</div><!-- /.content-wrapper -->
<!-- } 콘텐츠 끝 -->
<!-- } 쪽지보기 끝 -->