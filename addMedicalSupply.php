<?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();
      if($stmt->prepare("select * from People where LastN like ?") or die(mysqli_error($db))) {
          $searchString = '%' . $_GET['searchLastName'] . '%';
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($FirstN, $LastN, $Age);
          echo "<table border=1><th>First Name</th><th>Last Name</th><th>Age</th>\n";
          while($stmt->fetch()) {
                  echo "<tr><td>$FirstN</td><td>$LastN</td><td>$Age</td></tr>";
          }
          echo "</table>";
            $stmt->close();
      }
      $db->close();

?>
