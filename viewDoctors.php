<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_doctor where name like ?") or die(mysqli_error($db))) {
          $searchString = '%' . $_GET['searchName'] . '%';
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($staff_id, $name, $age);
          echo "<table border=1><th>Staff ID</th><th>Name</th><th>Age</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$staff_id</td><td>$name</td><td>$age</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
