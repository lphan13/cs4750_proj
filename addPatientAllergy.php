<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("insert into h_restrictedby(allergy, tolerance, m_name, p_id) values (?, ?, ?, ?)") or die(mysqli_error($db))) {
          $allergyP = $_GET['allergyP'];
          $toleranceP = $_GET['toleranceP'];
          $medNameP = $_GET['medNameP'];
          $pIdP = $_GET['pIdP'];
          $stmt->bind_param(issi, $allergyP, $toleranceP, $medNameP, $pIdP);
          $stmt->execute();
          $stmt->bind_result($allergy, $tolerance, $m_name, $p_id);
          echo "Added new allergy:\n<table border=1><th>Allergy</th><th>Tolerance</th><th>Medicine Name</th><th>Patient ID</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$allergy</td><td>$tolerance</td><td>$m_name</td><td>$p_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
