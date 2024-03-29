<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("update h_medical_supply set quantity = ? where name = ?") or die(mysqli_error($db))) {
          $squantity = $_GET['updateQuantity'];
          $sname = $_GET['updateName'];
          $stmt->bind_param(is, $squantity, $sname);
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
