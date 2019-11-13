<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from h_medical_supply where name like ? or supply_id = ?") or die(mysqli_error($db))) {
          $sname = '%' . $_GET['searchInput'] . '%';
          $sid = $_GET['searchInput'];
          $stmt->bind_param(si, $sname, $sid);
          $stmt->execute();
          $stmt->bind_result($name, $quantity, $supply_id);
          echo "<table border=1><th>Supply Name</th><th>Quantity</th><th>Supply ID</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$name</td><td>$quantity</td><td>$supply_id</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
