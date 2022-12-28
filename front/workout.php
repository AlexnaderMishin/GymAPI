<?php 
include 'header.php'; 
include '/program/ospanel/domains/api/back/connect.php';
?>
<body>
    <style>
        .settings{
            color: white;
            margin: 50px;
            display: block;
        }
        .settings input{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 14px;
        }
    </style>

<!-- форма для заполнения -->
<div class="settings">
    <!-- счётчик выполненых подходов -->
    <p>CЕТ: 1/3</p>

    <!-- вывысти список упржанений -->
    <select id="exercise">
    <?php
                  $stmt = $pdo->query("SELECT * FROM `exercises`");
                  while($row = $stmt->fetch()){
                  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                  }
    ?>
    </select><br>
    <!-- вес -->
    <label for="weight">Вес  </label>
    <input type="text" id="weight">
    <!-- кол-во -->
    <label for="count">Повт.  </label>
    <input type="text" id="count">     
    <!-- кнопка отправки -->
    <button onclick="sendStat()">Далее</button>
</div>

<script>
    function sendStat(){
        var exercise = $('#exercise').val();
        var weight = $('#weight').val();
        var count = $('#count').val();
        var weightStat = 0;
        var countStat = 0;

       
        var weightRegex = /^[1-9]{1,3}$/;
        var countRegex = /^[1-9]{1,3}$/;

        if(weightRegex.exec(weight) == null){
            $('#weight').css("color" , "red");
            $('#weight').css("border-color" , "red");
            var weightStat = 0;
        }else{
            $('#weight').css("color" , "green");
            $('#weight').css("border-color" , "green");
            var weightStat = 1;
        }
        if(countRegex.exec(count) == null){
            $('#count').css("color" , "red");
            $('#count').css("border-color" , "red");
            var countStat = 0;
        }else{
            $('#count').css("color" , "green");
            $('#count').css("border-color" , "green");
            var countStat = 1;
        }
        
        console.log(exercise, weight, count);

        var toServer = {
            exercise: exercise,
            weight : weight,
            count : count,
          }

          var JSONToServer = JSON.stringify(toServer);

          if(countStat && weightStat == 1){
            $.ajax({
              url: '/back/work.php',
              type: 'post',
              data: 'data=' + JSONToServer,

              success: function(response){
                // $("#textInfo").text("Данные отправлены!");
                // $("#textInfo").text(response['status']);
              
                
                  console.log('Данные отправлены!');
                  console.log(response["message"]);
                
              },
              error: function(response){
                // $("#textInfo").text("Произошла ошибка!");
                  console.log(response["message"]);
              }
              
          });
          }else{
            $('#count').css("color" , "red");
            $('#count').css("border-color" , "red");
            $('#weight').css("color" , "red");
            $('#weight').css("border-color" , "red");
          }

          
    }
</script>


</body>