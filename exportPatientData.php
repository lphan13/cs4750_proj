<!-- PHP documentation used as a reference to write this code :
    https://www.php.net/manual/en/wrappers.php.php
    https://www.geeksforgeeks.org/php-fputs-function/  -->
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