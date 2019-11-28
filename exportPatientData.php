<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from h_patient") or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->bind_result($p_id, $room_no, $name, $age);
    $fp = fopen('php://output', 'w');
    $headers = array("Patient ID", "Room Number", "Name", "Age");
    if ($fp) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="patient_data.csv"');
        fputcsv($fp, $headers);
        while ($row = $stmt->fetch()) {
            fputcsv($fp, array($p_id, $room_no, $name, $age));
        }
        die;
    }
}
?> 