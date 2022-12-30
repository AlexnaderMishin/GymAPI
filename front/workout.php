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
        select{
           
            background: none;
            color: white;
            font-size: 16px;
            outline: none;
            border: none;
          
        }
        select option{
            background: #2f3640;          
            color: white;
        }
       
    </style>

<!-- форма для заполнения -->
<div class="settings">
    <!-- счётчик выполненых подходов -->
    <p id="counterField">Подход | 1</p>

    <!-- вывысти список упржанений -->
    <select id="exercise">
    <?php
                  $stmt = $pdo->query("SELECT * FROM `exercises`");
                  while($row = $stmt->fetch()){
                  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                  }
    ?>
    </select>
    <!-- вес -->
    <label for="weight">Вес  </label>
    <input type="text" id="weight">
    <!-- кол-во -->
    <label for="count">Повт.  </label>
    <input type="text" id="count">     
    <!-- кнопка отправки -->
    <button onclick="sendStat()" id="counter">Далее</button>
</div>
<!-- Таблица реузльтатов по подходам -->
<div class="tableResult">
    <table>
        <tr>
            <th>№</th>
            <th>Вес</th>
            <th>Кол-во</th>
        </tr>
        <tr>
            <th>1</th>
            <th>12</th>
            <th>4</th>
        </tr>
    </table>
</div>

<script>
    //создаю массив для значений подхода
    var arrStatistic = new Map([
                ['keyRepeat', 'counterVal'],
                ['keyWeight', 'weight'],
                ['keyCount', 'count'],
            ]);
    //счётчик подходов
    
    

   
    var counterVal = 1;

    function sendStat(){
        
        
        var exercise = $('#exercise').val();
        var weight = $('#weight').val();
        var count = $('#count').val();
        //перменные статусы для сравнения 
        var weightStat = 0;
        var countStat = 0;
        
       //регулярное выражения для валидации веса и повторений
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
        
       
        
        var toServer = {
            exercise: exercise,
            weight : weight,
            count : count,
          }

          var JSONToServer = JSON.stringify(toServer);

          if(countStat && weightStat == 1){
            arrStatistic.set([
                ['keyRepeat', counterVal],
                ['keyWeight', weight],
                ['keyCount', count],
            ]);

            Object.keys(arrStatistic).forEach(function(key, value) {
  console.log(this[value]);
}, arrStatistic);

            // console.log(arrStatistic.get('keyRepeat'));
            updateDisplay(++counterVal);
            
            function updateDisplay(val) {
            document.getElementById("counterField").innerHTML = ("Подход | " + val);
            }

            console.log(arrStatistic);
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

//           $.each(arrStatistic, function(index, value)
// {
// console.log('Индекс: ' + index + '; Значение: ' + value);
// });
    }
        // сброс счётчкика
//     function resetCounter() {
//     counterVal = 0;
//     updateDisplay(counterVal);
// }

</script>


</body>