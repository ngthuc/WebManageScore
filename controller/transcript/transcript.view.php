<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 30/9/2017
 * Time: 5:03 PM
 */

if (empty($trTree))
	return;
?>
<div class="text-right div-btn-grading">
    <!--    <button class="btn btn-primary btn-sm">-->
    <!--        <span class="glyphicon glyphicon-ok"></span>-->
    <!--        Lưu lại-->
    <!--    </button>-->
    <a class="btn btn-default btn-sm" href="<?php echo $privilege == STUDENT ? 'main.php' : 'grading.php' ?>">
        <span class="glyphicon glyphicon-backward"></span>
        Quay về
    </a>

	<?php if ($privilege != STUDENT) { ?>
        <a id="copy-from-student-score" class="btn btn-sm btn-primary">
            <span class="glyphicon glyphicon-copy"></span>
            Chép điểm của sinh viên
        </a>
	<?php } ?>
</div>
<br>
<div class="form-grading" id="div-grading">
    <form method="post">
        <div class="table-score-wrapper">
            <table id="table-score" class="table-bordered table-responsive table-condensed table-grading">
                <thead>
                <tr>
                    <th><strong>Nội dung đánh giá (Thông tư 16)</strong></th>
                    <th><strong>Mức điểm</strong></th>
                    <th><strong>Gợi ý chấm</strong></th>
                    <th><strong>SV tự chấm</strong></th>
                    <th><strong>CVHT chấm</strong></th>
                    <th><strong>Quản lý khoa chấm</strong></th>
                </tr>
                </thead>
                <tbody class="text-center">
				<?php echo $trTree->getHtmlText(); ?>
                </tbody>
            </table>
        </div>
        <div>
            <input type="hidden" name="privilege" value="<?php echo $privilege; ?>">
            <input type="hidden" name="requestName" value="saveTranscript">
        </div>
        <br>
        <div class="text-right div-btn-grading">
            <button class="btn btn-primary">
                <span class="glyphicon glyphicon-ok"></span>
                Lưu lại
            </button>
            <a class="btn btn-default" href="<?php echo $privilege == STUDENT ? 'main.php' : 'grading.php' ?>">
                <span class="glyphicon glyphicon-backward"></span>
                Quay về
            </a>
        </div>
    </form>
</div>
<div class="navigator btn-group btn-group-sm" id="nav">
    <a href="" id="prev" class="btn btn-primary">Trước</a>
    <a href="" id="next" class="btn btn-primary">Sau</a>
    <a href="#diem-cong" class="btn btn-primary">Điểm cộng</a>
    <a href="#minh-chung" class="btn btn-primary">Minh chứng</a>
</div>

<script>

    var currentProvIdx = 0;
    var provisionRef = [];
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        var provisions = $('.section-1');
        var html = "";
        $.each(provisions, function (i, provision) {
            if (provision.id !== "")
                provisionRef[i] = provision.id;
//                html += '<a href="#' + provision.id + '" class="link-nav">' + toNumber(provision.id) + '</a>';
        });
        $('#prev').attr('href', '#' + provisionRef[currentProvIdx]);
        $('#next').attr('href', '#' + provisionRef[currentProvIdx]);
        $('#prev').click(function () {
            if (currentProvIdx > 0)
                currentProvIdx--;
            $(this).attr('href', '#' + provisionRef[currentProvIdx]);
        });
        $('#next').click(function () {
            if (currentProvIdx < provisionRef.length - 1)
                currentProvIdx++;
            $(this).attr('href', '#' + provisionRef[currentProvIdx]);
        });

        $('#copy-from-student-score').click(copyFromStudentScore);
    });

    function copyFromStudentScore() {
        var provisionScores = $('.std-score');
        $.each(provisionScores, function (i, provisionScore) {
            var score = $(provisionScore).text();
            var prName = $(provisionScore).data('name');
            $('[name="' + prName + '"]').val(score);
            console.log($('[name="' + prName + '"]'));
			<?php if ($privilege == ADVISER) {?>

			<?php } else {?>
			<?php }?>

        });
        return false;
    }
</script>
