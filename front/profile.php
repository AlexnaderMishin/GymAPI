<?php 
include 'header.php'; 
include '../back/connect.php';
?>

<body>
<div class="container-fluid p-3 mb-2 d-flex align-items-center justify-content-center">
  <div class="container">
            <h2>Основные показатели:</h2>
            
            <label for="height" class="form-label">Рост:</label>
            <input type="number" class="form-control" id="height" name="height"/>

            <label for="weight" class="form-label">Вес:</label>
            <input type="number" id="weight" class="form-control" name="weight"/>
           
            <label for="imb" class="form-label">Индекс массы тела:</label>
            <input type="number" id="imb" class="form-control" name="imb"/>

            <label for="ifb" class="form-label">Процент жира в теле:</label>
            <input type="number" id="ifb" class="form-control" name="ifb"/>
            
            <div class="d-grid gap-2">
            <p id="textInfo"></p>
            <button type="button" class="btn btn-outline-warning btn-lg" onclick="sendChar()" id="counter">Добавить</button><br> 
            </div>
            
        
        
        <table class="table table-dark table-hover" id="tableResult">
          <h2>Основные показатели:</h2>
            <tr>
              <th>Дата:</th>
              <th>Рост:</th>
              <th>Вес:</th>
              <th>ИМТ:</th>
              <th>ИЖМ:</th>
                <?php
                  $log = $_SESSION['userId'];
                  $stmt = $pdo->query("SELECT * FROM `user_info` WHERE `user_id` = '$log'");
                  while($row = $stmt->fetch()){
                  echo '<tr><td>'.$row['date'].'</td><td>'.$row['user_height'].'</td><td>'.$row['user_weight'].'</td><td>'.$row['ibm'].'</td><td>'.$row['bfm'].'</td></tr>';
                  }
                ?>
        </table>
  </div>
</div>
    

    <script>

    $( "#imb" ).click(function() {
    var height = $("#height").val();
    var weight = $("#weight").val();
    var indexmass = weight/(Math.pow(height/100,2));
    
  // заношу данные в поле
    $('input[name="imb"]').val(indexmass.toFixed(2));
});
  

    function sendChar(){
    var height = $("#height").val();
    var weight = $("#weight").val();
    var imb = $("#imb").val();
    var ifb = $("#ifb").val();
    // var indexmass = weight/(Math.pow(height/100,2));

          var toServer = {
            height: height,
            weight : weight,
            imb : imb,
            ifb : ifb
          }

          
          

          var JSONToServer = JSON.stringify(toServer);

          
          $.ajax({
              url: '../back/back.php',
              type: 'post',
              data: 'data=' + JSONToServer,

              success: function(){
                $("#textInfo").text("Данные отправлены!");
                
                
                  // console.log('Данные отправлены!');
                  // console.log(imb);
                
              },
              error: function(){
                $("#textInfo").text("Произошла ошибка!");
                  console.log('error');
              }
              
          });
      }

      
</script>
</body>