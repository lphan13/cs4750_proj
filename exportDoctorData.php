<!-- PHP documentation used as a reference to write this code :
    https://www.php.net/manual/en/wrappers.php.php
    https://www.geeksforgeeks.org/php-fputs-function/  -->
<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from h_doctor") or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->bind_result($staff_id, $name, $age);
    $fp = fopen('php://output', 'w');
    $headers = array("Staff ID", "Name", "Age");
    if ($fp) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="doctor_data.csv"');
        fputcsv($fp, $headers);
        while ($row = $stmt->fetch()) {
            fputcsv($fp, array($staff_id, $name, $age));
        }
        die;
    }
}
?> 