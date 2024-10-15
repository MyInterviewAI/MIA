<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>
<!-- 콘텐츠 시작 { -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) { -->
    <section class="content-header">
        <div class="container">
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
        <div class="container">
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
                            <?php echo $str; ?>
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
