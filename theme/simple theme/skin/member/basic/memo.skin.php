<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
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
                            <h3 class="card-title"><?php echo $g5['title']; ?>&nbsp;&nbsp;</h3>

                            <div class="btn btn-outline-primary btn-xs">전체 <?php echo $kind_title; ?> 쪽지 <span class="badge bg-info"><?php echo $total_count; ?></span></div>
                            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="bi bi-dash-lg"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                        <div class="card-body">                            
                            <div class="container">

                                <a class="btn<?php if ($kind == 'recv') { ?> bg-gradient-info<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo.php?kind=recv">받은 쪽지</a>
                                <a class="btn<?php if ($kind == 'send') { ?> bg-gradient-success<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo.php?kind=send">보낸 쪽지</a>
                                <a class="btn<?php if (!$kind) { ?> bg-gradient-warning<?php } else { ?> bg-gradient-secondary<?php } ?>" href="./memo_form.php">쪽지 쓰기</a>
                                
                                <div class="memo_list">
                                    <ul>
                                        <?php
                                        for ($i=0; $i<count($list); $i++) {
                                        $readed = (substr($list[$i]['me_read_datetime'],0,1) == 0) ? '' : 'read';
                                        $memo_preview = utf8_strcut(strip_tags($list[$i]['me_memo']), 30, '..');
                                        ?>
                                        <li class="<?php echo $readed; ?>">
                                            <div class="memo_li profile_big_img">
                                                <?php echo get_member_profile_img($list[$i]['mb_id']); ?>
                                                <?php if (! $readed){ ?><span class="no_read">안 읽은 쪽지</span><?php } ?>
                                            </div>
                                            <div class="memo_li memo_name">
                                                <?php echo $list[$i]['name']; ?> <span class="memo_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['me_send_datetime']; ?></span>
                                                <div class="memo_preview">
                                                    <a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $memo_preview; ?></a>
                                                </div>
                                            </div>	
                                            <a class="float-right" href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;" class="memo_del"><i class="fa fa-trash-o" aria-hidden="true"></i> <span class="sound_only">삭제</span></a>
                                        </li>
                                        <?php } ?>
                                        <?php if ($i==0) { echo '<li class="empty_table">아직 해당 쪽지가 없습니다.</li>'; }  ?>
                                    </ul>
                                </div>

                                <!-- 페이지 -->
                                <?php echo $write_pages; ?>
                                
                            </div><!-- /.container -->
                        </div><!-- /.card-body -->

                        <div class="card-footer">
                        <p class="win_desc"><i class="fa fa-info-circle" aria-hidden="true"></i> 쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.</p>
                        </div><!-- /.card-footer-->
                    </div><!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    <!-- } Main content -->
</div><!-- /.content-wrapper -->
<!-- } 콘텐츠 끝 -->
<!-- } 쪽지 목록 끝 -->