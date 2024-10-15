<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}
?>

</div><!-- /.wrapper -->

<div class="float-end">
    <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-bar-up"></i></a>
</div><!-- /.float-end: Back to top -->


<!-- 하단 시작 { -->
<footer class="container pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
        <div class="col-12 col-md">
            <h5>CUSTOMER CENTER</h5>
            <h5 class="text-center">1234-9876</h5>
            <small class="d-block mb-3 text-body-secondary text-center">
                운영시간 09:30~18:000<br>
                토, 일, 공휴일 휴무
            </small>
        </div>
        <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Stuff for developers</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="<?php echo G5_BBS_URL; ?>/qalist.php">Resource 1:1문의</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=1">Resource name FAQ</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another resource</a></li>
                <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Final resource</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
                <li class="mb-1"><a href="<?php echo get_pretty_url('content', 'company'); ?>" class="link-secondary text-decoration-none">회사소개</a>
                <li class="mb-1"><a href="<?php echo get_pretty_url('content', 'privacy'); ?>" class="link-secondary text-decoration-none">개인정보처리방침(Privacy)</a>
                <li class="mb-1"><a href="<?php echo get_pretty_url('content', 'provision'); ?>" class="link-secondary text-decoration-none">서비스이용약관(Terms)</a>
                <li class="mb-1"><a href="<?php echo get_device_change_url(); ?>" class="link-secondary text-decoration-none">모바일버전</a>
            </ul>
        </div>
    </div><!-- /.row -->

    <div class="main-footer row">
        <div class="col-3 col-lg-3">
            <img src="<?php echo G5_THEME_IMG_URL; ?>/logo.png" alt="">
        </div>
        <div class="col-sm-8 col-lg-8">
            회사명: 회사명 | 대표: 대표자명 | 사업자 등록번호  : 123-45-67890<br>
            주소: OO도 OO시 OO구 OO동 123-45 | 전화:  02-123-4567  팩스  : 02-123-4568<br>
            통신판매업신고번호: 제 OO구 - 123호 | 개인정보관리책임자: 정보책임자명<br>
            <small class="d-block mb-3 text-body-secondary">Copyright &copy; 2017–2023 <b>소유하신 도메인.</b> All rights reserved.</small>
        </div> 
    </div>
</footer><!-- /.container: footer -->

<?php if ($config['cf_analytics']) { echo $config['cf_analytics']; } ?>
<!-- } 하단 끝 -->

<script>
$(function() {
    // 상단으로 버튼
    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});

$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>