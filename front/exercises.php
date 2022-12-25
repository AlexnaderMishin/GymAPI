<?php 
include 'header.php'; 
include '/program/ospanel/domains/api/back/connect.php';
?>
<body>
    <div class="list_exercises">
        <?php
                  $stmt = $pdo->query("SELECT * FROM `exercises`");
                  while($row = $stmt->fetch()){
                  echo '<p>'.$row['group_id'].'-'.$row['title'].'-'.$row['desk'].'</p>';
                  }
    ?>
    
    </div>
</body>