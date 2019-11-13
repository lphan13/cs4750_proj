<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_patient natural join h_takes where name like ?") or die(mysqli_error($db))) {
          $searchString = '%' . $_GET['searchName'] . '%';
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($p_id, $room_no, $name, $age, $frequency, $dosage, $m_name);
          echo "<table border=1><th>Patient ID</th><th>Room #</th><th>Name</th><th>Age</th><th>Frequency</th><th>Dosage</th><th>Medicine Name</th>>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$p_id</td><td>$room_no</td><td>$name</td><td>$age</td><td>$frequency</td><td>$dosage</td><td>$m_name</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
