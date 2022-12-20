<?php 
include 'header.php'; 
include '/program/ospanel/domains/api/back/connect.php';
?>

<body>
    <div class="container">
        <div class="userChar">
            <h2>Основные показатели:</h2>
            <label for="height">Рост:</label><br>
            <input type="text" id="height" name="height"></input><br>

            <label for="weight">Вес:</label><br>
            <div>
            <input type="text" id="weight" name="weight"></input><br>
            </div>
            <label for="imb">Индекс массы тела:</label><br>
            <input type="text" id="imb" name="imb"></input><br>

            <label for="ifb">Процент жира в теле:</label><br>
            <input type="text" id="ifb" name="ifb"></input><br>
            <p id="textInfo"></p>
            <button onclick="sendChar()">Добавить</button>
        </div>
        <div class="charResult">
        
        <table>
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
              url: '/back/back.php',
              type: 'post',
              data: 'data=' + JSONToServer,

              success: function(response){
                $("#textInfo").text("Данные отправлены!");
                $("#textInfo").text(response['status']);
                console.log(response['data']);
                
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