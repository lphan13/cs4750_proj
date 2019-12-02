<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from h_shift") or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->bind_result($start_time, $end_time, $staff_id);
    $fp = fopen('php://output', 'w');
    $headers = array("Start Time", "End Time", "Staff ID");
    if ($fp) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="shift_data.csv"');
        fputcsv($fp, $headers);
        while ($row = $stmt->fetch()) {
            fputcsv($fp, array($start_time, $end_time, $staff_id));
        }
        die;
    }
}
?> 