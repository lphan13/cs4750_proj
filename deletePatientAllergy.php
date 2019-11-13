<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("delete from h_restrictedby where p_id=? AND m_name=?") or die(mysqli_error($db))) {
          $pId = $_GET['pId'];
          $mName = $_GET['medName'];
          $stmt->bind_param(is, $pId, $mName);
          $stmt->execute();
          $stmt->bind_result($allergy, $tolerance, $m_name, $p_id);
          echo "Deleted:\n<table border=1><th>Allergy</th><th>Tolerance</th><th>Medicine Name</th><th>Patient ID</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$allergy</td><td>$tolerance</td><td>$m_name</td><td>$p_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();
?>
