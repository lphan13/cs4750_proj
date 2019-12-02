<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from h_medical_supply") or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->bind_result($name, $quantity, $supply_id);
    $fp = fopen('php://output', 'w');
    $headers = array("Name", "Quantity", "Supply ID");
    if ($fp) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="medical_supply_data.csv"');
        fputcsv($fp, $headers);
        while ($row = $stmt->fetch()) {
            fputcsv($fp, array($name, $quantity, $supply_id));
        }
        die;
    }
}
?> 