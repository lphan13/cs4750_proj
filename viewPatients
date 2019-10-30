<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_patient where name like ?") or die(mysqli_error($db))) {
          $searchString = '%' . $_GET['searchName'] . '%';
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($p_id, $room_no, $name, $age);
          echo "<table border=1><th>Patient ID</th><th>Room #</th><th>Name</th><th>Age</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$p_id</td><td>$room_no</td><td>$name</td><td>$age</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
