<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<!-- 상단 시작 { -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a href="<?php echo G5_URL; ?>" class="navbar-brand">
            <img src="<?php echo G5_THEME_IMG_URL; ?>/logo.png" alt="<?php echo $config['cf_title']; ?> Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?php echo $config['cf_title']; ?></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item"><a href="<?php echo G5_URL; ?>" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <fieldset id="hd_sch">
                <!--legend>사이트 내 전체검색</legend -->
                <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" class="form-inline ml-0 ml-md-3">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어 필수</label>
                <div class="input-group input-group-sm">
                    <input type="text" name="stx" id="sch_stx" class="form-control form-control-navbar" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit" id="sch_submit" value="검색">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                </form>

                <script>
                function fsearchbox_submit(f)
                {
                    var stx = f.stx.value.trim();
                    if (stx.length < 2) {
                        alert("검색어는 두글자 이상 입력하십시오.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                    var cnt = 0;
                    for (var i = 0; i < stx.length; i++) {
                        if (stx.charAt(i) == ' ')
                            cnt++;
                    }

                    if (cnt > 1) {
                        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }
                    f.stx.value = stx;

                    return true;
                }
                </script>

            </fieldset>

            <ul class="navbar-nav">
                <?php if ($is_member) { ?>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $member['mb_nick']; ?>님 접속</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                            <li><a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/memo.php">쪽지함</a></li>
                            <li><a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/scrap.php">스크랩</a></li>
                            <li><a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                <li class="nav-item"><a href="<?php echo G5_BBS_URL; ?>/login.php" class="nav-link">Login</a></li>
                <?php } ?>
            </ul>
        </div><!-- /.collapse -->
    </div><!-- /.container -->
</nav>
<!-- } 상단 끝 -->

<?php
if(defined('_INDEX_')) { // index에서만 실행
    //include(G5_BBS_PATH.'/newwin.inc.php'); // 팝업레이어
}
?>