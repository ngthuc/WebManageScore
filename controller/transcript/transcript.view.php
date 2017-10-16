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
    <button class="btn btn-primary btn-sm">
        <span class="glyphicon glyphicon-ok"></span>
        Lưu lại
    </button>
    <a class="btn btn-default btn-sm" href="<?php echo $privilege == STUDENT ? 'main.php': 'grading.php' ?>">
        <span class="glyphicon glyphicon-backward"></span>
        Quay về
    </a>
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
            <a class="btn btn-default" href="<?php echo $privilege == STUDENT ? 'main.php': 'grading.php' ?>">
                <span class="glyphicon glyphicon-backward"></span>
                Quay về
            </a>
        </div>
    </form>
</div>
<div class="navigator" id="nav">
<!--    <a href="" id="top" class="link-nav"><span class="glyphicon glyphicon-chevron-up"></span> </a>-->
<!--    <a href="" id="prev" class="link-nav"></a>-->
<!--    <a href="" id="next" class="link-nav"></a>-->
<!--    <a href="" id="bot" class="link-nav"><span class="glyphicon glyphicon-chevron-down"></span> </a>-->

    <a href="#viewScoreAdd" class="link-nav">Điểm cộng</a>
</div>

<script>
    $(function(){
        $('[data-toggle="tooltip]').tooltip();
        var provisions = $('.section-1');
        var html = "";
        $.each(provisions, function(i, provision){
            if (provision.id !== "")
                html += '<a href="#' + provision.id + '" class="link-nav">' + toNumber(provision.id) + '</a>';
        });
        $('#nav').prepend(html);
    });
    function toNumber(str){
        var number = {
            I: 4,
            II: 5,
            III: 6,
            IV: 7,
            V: 8
        };
        return number[str];
    }
</script>
