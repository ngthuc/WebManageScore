<!--
<?php
if(isset($_POST['xoa'])) {
    $branchO = new BranchObj();
    $branchM = new BranchMod();
    foreach ($_POST['xoa'] as $key=> $value){
            $branchO->setidBranch($value);
            $branchM->deleteBranch($branchO);
    }
}
?>
-->
<!--Start delete Branch-->
<div id="deleteBranch" class="modal fade " tabindex="-1" role="dialog" aria-labelledby aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="">Xóa Chi Hội!</h4>
            </div>
            <div class="modal-body">
                <h4>Hành động này cần xác nhận: Không thể hoàn tác!</h4>
                <p>Vui lòng kiểm tra cẩn thận!</p>
                <div class="modal-footer">
                    <input type="hidden" name="deleteBranch" id="deleteBranch">
                    <button name="deleteYes" id="yes" onclick="submitform();" class="btn btn-danger">Đồng ý</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitform() {
        $('#deleteForm').submit();
    }
</script>
<!--End delete Branch-->

<!--
<script language="JavaScript">
    function toggle(checkall) {
        checkboxes = document.getElementsByName('idBranch');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = checkall.checked;
        }
    }
</script>



<script language="javascript">
    document.getElementById('action').onclick = function(e){
        if (this.checked){
            alert("Bạn vừa tích");
        }
        else{
            alert("Bạn vừa bỏ tích");
        }
    };
</script>
-->
