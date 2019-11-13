<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("insert into h_medical_supply(name, quantity) values (?, ?)") or die(mysqli_error($db))) {
          $msname = $_GET['addName'];
          $msquantity = $_GET['addQuantity'];
          $stmt->bind_param(si, $msname, $msquantity);
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
