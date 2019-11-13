<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_takes natural join h_medicine where p_id=?") or die(mysqli_error($db))) {
          $pId = $_GET['pId'];
          $stmt->bind_param(i, $pId);
          $stmt->execute();
          $stmt->bind_result($frequency, $dosage, $p_id, $m_name, $quantity);
          echo "Patient medications:\n<table border=1><th>Frequency</th><th>Dosage</th><th>Patient ID</th><th>Medicine Name</th><th>Medicine Stock</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$frequency</td><td>$dosage</td><td>$p_id</td><td>$m_name</td><td>$quantity</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
