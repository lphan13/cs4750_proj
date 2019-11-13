<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_shift where staff_id=?") or die(mysqli_error($db))) {
          $searchString = $_GET['searchId'];
          $stmt->bind_param(i, $searchString);
          $stmt->execute();
          $stmt->bind_result($start_time, $end_time, $staff_id);
          echo "<table border=1><th>Start Time</th><th>End Time</th><th>Staff Id</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$start_time</td><td>$end_time</td><td>$staff_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
