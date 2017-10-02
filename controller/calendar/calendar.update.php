<?php
require_once("../../model/ConnectToSQL.php");
require_once("../../model/PermissionObj.php");
require_once("../../model/PermissionMod.php");
require_once("../../model/CalendarScoringMod.php");
require_once("../../model/CalendarScoringObj.php");
switch ($_POST['btn-submit']) {
  case 'save':
    $newDate = new CalendarScoringObj(date("Y-m-d", strtotime($_POST['txt-date-open'])), date("Y-m-d", strtotime($_POST['txt-date-close'])), $_POST['select']);
    $newCalendar = new CalendarScoringMod();
    $newCalendar->updateCalendar($newDate);
    break;

  default:
    break;
}
echo '<script>window.location.assign("../../view/calendarScoring.php")</script>';
?>
