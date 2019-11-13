<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("insert into h_takes(frequency, dosage, p_id, m_name) values (?, ?, ?, ?)") or die(mysqli_error($db))) {
          $frequency = $_GET['presFrequency'];
          $dosage = $_GET['presDosage'];
          $pId = $_GET['presPId'];
          $mName = $_GET['presMedName'];
          $stmt->bind_param(siis, $frequency, $dosage, $pId, $mName);
          $stmt->execute();
          $stmt->bind_result($frequency, $dosage, $pId, $mName);
          echo "Added prescription:\n<table border=1><th>Frequency</th><th>Dosage</th><th>Patient ID</th><th>Medicine Name</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$frequency</td><td>$dosage</td><td>$p_id</td><td>$m_name</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
