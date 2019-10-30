<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_procedure where room_no = ?") or die(mysqli_error($db))) {
          $searchNumber = '%' . $_GET['searchNumber'] . '%';
          $stmt->bind_param(i, $searchNumber);
          $stmt->execute();
          $stmt->bind_result($time, $procedure_type, $room_no, $p_id, $supply_id, $staff_id);
          echo "<table border=1><th>Time</th><th>Procedure Type</th><th>Room #</th><th>Patient ID</th><Supply ID</th><th>Staff ID</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$time</td><td>$procedure_type</td><td>$room_no</td><td>$p_id</td><td>$supply_id</td><td>$staff_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
