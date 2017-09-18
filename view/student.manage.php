<?php
require_once "../controller/header.php";
require_once "../helper/common.helper.php";
require_once "../helper/form.helper.php";
$baseUrl = getBaseUrl();
$accountObj = new AccountObj();
$accountMod = new AccountMod();
$academyObj = new AcademyObj();
$academyMod = new AcademyMod();
$classMod = new ClassMod();
$clsObj = new ClassObj();
$clsObj->setIdClass('DI1496A1');
var_dump($classMod->getListAccount($clsObj));
?>
<div class="container-fluid">
    <!Start content manage student-->
    <div class="container main-academy-container">
        <div class="academy-action-list text-center">

            <h4>Danh sách sinh viên</h4>
            <div class="form-group">
                <form action="" method="post">

                    <!---->
                    <!--Start combobox academy for student-->
					<?php
					require "../controller/student/student.filter.academy.php";
					?>
                    <!--End combobox academy for student-->

                    <!---->
                    <!--Start combobox class for student-->
					<?php
					require "../controller/student/student.filter.class.php";
					?>
                    <!--End combobox class for student-->

                    <!---->
                    <!--Start buttun filter-->
                    <input type="submit" value="Lọc" class="btn btn-primary col-sm-1">

                    <!--End buttun filter-->
                </form>
                <br>
                <br>
            </div>
            <!--End filter table-->
            <!--Begin table-->
			<?php
			require_once "../controller/student/student.content.php";
			?>
            <!--End table-->

        </div>
    </div>
    <!--End content manage student-->
</div>

<script src="../public/js/student_action.js"></script>

<?php
require_once "../controller/footer.php";
?>
