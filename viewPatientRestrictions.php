<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_restrictedby where p_id=?") or die(mysqli_error($db))) {
          $pId = $_GET['pId'];
          $stmt->bind_param(i, $pId);
          $stmt->execute();
          $stmt->bind_result($allergy, $tolerance, $m_name, $p_id);
          echo "Restricted medications:\n<table border=1><th>Allergy</th><th>Tolerance</th><th>Medicine Name</th><th>Patient ID</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$allergy</td><td>$tolerance</td><td>$m_name</td><td>$p_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
