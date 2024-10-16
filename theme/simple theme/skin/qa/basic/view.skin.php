<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 콘텐츠 시작 { -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) { -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $qaconfig['qa_title']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo G5_URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $qaconfig['qa_title']; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- } Content Header (Page header) -->

    <!-- Main content { -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?php echo '<span class="btn btn-outline-secondary btn-xs">'.$view['category'].'</span>&nbsp;'; // 분류 출력 끝 ?>
                                <?php echo $view['subject']; // 글제목 출력 ?>
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="bi bi-dash-lg"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <span class="sound_only">작성자</span><?php echo $view['name']; ?>&nbsp;
                                <span class="sound_only">작성일</span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $view['datetime']; ?>&nbsp;
                                <?php if($view['email'] || $view['hp']) { ?>
                                    <?php if($view['email']) { ?>
                                    <span class="sound_only">이메일</span>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $view['email']; ?>&nbsp;
                                    <?php } ?>
                                    <?php if($view['hp']) { ?>
                                    <span class="sound_only">휴대폰</span>
                                    <i class="fa fa-phone" aria-hidden="true"></i> <?php echo $view['hp']; ?>&nbsp;
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <div class="bo_v_com">
                                <span><a href="<?php echo $list_href ?>" class="btn_b01 btn" title="목록"><i class="fa fa-list" aria-hidden="true"></i><span class="sound_only">목록</span></a></span>
                                <?php if ($write_href) { ?><span><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></span><?php } ?>
                                <?php if ($update_href || $delete_href) { ?>
                                <span>
                                    <button type="button" class="btn_more_opt btn_b01 btn" title="게시판 읽기 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 읽기 옵션</span></button>
                                    <ul class="more_opt">
                                        <?php if ($update_href) { ?><span><a href="<?php echo $update_href ?>" class="btn_b01 btn" title="수정">수정<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span><?php } ?>
                                        <?php if ($delete_href) { ?><span><a href="<?php echo $delete_href ?>" class="btn_b01 btn" onclick="del(this.href); return false;" title="삭제">삭제<i class="fa fa-trash-o" aria-hidden="true"></i></a></span><?php } ?>
                                    </ul>
                                </span>
                                <?php } ?>
                            </div>
                            <script>
                                // 게시판 리스트 옵션
                                $(".btn_more_opt").on("click", function() {
                                    $(".more_opt").toggle();
                                })
                            </script>

                            <section id="bo_v_atc">
                                <h2 id="bo_v_atc_title">본문</h2>

                                <?php
                                // 파일 출력
                                if($view['img_count']) {
                                    echo "<div id=\"bo_v_img\">\n";

                                    for ($i=0; $i<$view['img_count']; $i++) {
                                        //echo $view['img_file'][$i];
                                        echo get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
                                    }

                                    echo "</div>\n";
                                }
                                ?>

                                <!-- 본문 내용 시작 { -->
                                <div id="bo_v_con"><?php echo get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?></div>
                                <!-- } 본문 내용 끝 -->

                                <?php if($view['qa_type']) { ?>
                                    <div id="bo_v_addq"><a href="<?php echo $rewrite_href; ?>" class="btn_b01">추가질문</a></div>
                                <?php } ?>

                                <?php if($view['download_count']) { ?>
                                <!-- 첨부파일 시작 { -->
                                <section id="bo_v_file">
                                    <h2>첨부파일</h2>
                                    <ul>
                                    <?php
                                    // 가변 파일
                                    for ($i=0; $i<$view['download_count']; $i++) {
                                    ?>
                                        <li>
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <a href="<?php echo $view['download_href'][$i];  ?>" class="view_file_download" download>
                                                <strong><?php echo $view['download_source'][$i] ?></strong>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </section>
                                <!-- } 첨부파일 끝 -->
                                <?php } ?>
                            </section>
                        </div><!-- /.card-body -->

                        <div class="card-footer">
                            <?php
                            // 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
                            if(!$view['qa_type']) {
                                if($view['qa_status'] && $answer['qa_id']) {
                                    include_once($qa_skin_path.'/view.answer.skin.php');
                                } else {
                                    include_once($qa_skin_path.'/view.answerform.skin.php');
                                }
                            }
                            ?>
                        </div><!-- /.card-footer-->
                    </div><!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    <!-- } Main content -->
</div><!-- /.content-wrapper -->
<!-- } 콘텐츠 끝 -->







<article id="bo_v">

    
    <?php if ($prev_href || $next_href) { ?>
    <ul class="bo_v_nb">
        <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01 btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> 이전글</a></li><?php } ?>
        <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01 btn">다음글 <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li><?php } ?>
    </ul>
    <?php } ?>

    <?php
    // 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
    if(!$view['qa_type']) {
        if($view['qa_status'] && $answer['qa_id'])
            include_once($qa_skin_path.'/view.answer.skin.php');
        else
            include_once($qa_skin_path.'/view.answerform.skin.php');
    }
    ?>

    <?php if($view['rel_count']) { ?>
    <section id="bo_v_rel">
        <h2>연관질문</h2>

        <div class="tbl_head01 tbl_wrap">
            <table>
            <thead>
            <tr>
                <th scope="col">제목</th>
                <th scope="col">등록일</th>
                <th scope="col">상태</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i=0; $i<$view['rel_count']; $i++) {
            ?>
            <tr>
                <td>
                    <span class="bo_cate_link"><?php echo get_text($rel_list[$i]['category']); ?></span>

                    <a href="<?php echo $rel_list[$i]['view_href']; ?>" class="bo_tit">
                        <?php echo $rel_list[$i]['subject']; ?>
                    </a>
                </td>
                <td class="td_date"><?php echo $rel_list[$i]['date']; ?></td>
                <td class="td_stat"><span class="<?php echo ($rel_list[$i]['qa_status'] ? 'txt_done' : 'txt_rdy'); ?>"><?php echo ($rel_list[$i]['qa_status'] ? '<i class="fa fa-check-circle" aria-hidden="true"></i> 답변완료' : '<i class="fa fa-times-circle" aria-hidden="true"></i> 답변대기'); ?></span></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
            </table>
        </div>
    </section>
    <?php } ?>



</article>
<!-- } 게시판 읽기 끝 -->

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>