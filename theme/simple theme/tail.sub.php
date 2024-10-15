<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($is_admin == 'super') {
    echo "<div>RUN TIME: " . get_microtime()-$begin_time . "</div>";
}
run_event('tail_sub');
?>
<!-- Theme App -->
<script src="<?php echo G5_THEME_JS_URL; ?>/theme.default.js"></script>
</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>