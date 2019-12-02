<!-- PHP documentation used as a reference to write this code :
    https://www.php.net/manual/en/wrappers.php.php
    https://www.geeksforgeeks.org/php-fputs-function/  -->
<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from h_procedure") or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->bind_result($time, $procedure_type, $room_no, $p_id, $supply_id, $staff_id);
    $fp = fopen('php://output', 'w');
    $headers = array("Time", "Procedure Type", "Room Number", "Patient ID", "Supply ID", "Staff ID");
    if ($fp) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="procedure_data.csv"');
        fputcsv($fp, $headers);
        while ($row = $stmt->fetch()) {
            fputcsv($fp, array($time, $procedure_type, $room_no, $p_id, $supply_id, $staff_id));
        }
        die;
    }
}
?> 