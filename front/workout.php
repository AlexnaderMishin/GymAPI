<?php 
include 'header.php'; 
include '../back/connect.php';
?>
<body>

<div class="container-fluid p-3 mb-2 d-flex align-items-center justify-content-center">
<!-- форма для заполнения -->
<div class="container">
    <!-- счётчик выполненых подходов -->
    <p id="counterField">Подход | 1</p>

    <!-- вывысти список упржанений -->
    
    <select class="form-select" aria-label="Default select example" id="exercise">
    <?php
                  $stmt = $pdo->query("SELECT * FROM `exercises`");
                  while($row = $stmt->fetch()){
                  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                  }
    ?>
    </select>
    <!-- вес -->
    <label for="weight" class="form-label">Вес:</label>
    <input type="number" id="weight" class="form-control" placeholder="Вес:"/>
    <!-- <input type="text" id="weight"> -->
    <!-- кол-во -->

    <!-- <input type="text" id="count"> -->
    <label for="count" class="form-label">Кол-во повторений:</label>
    <input type="number" id="count" class="form-control" placeholder="Кол-во повторений:"/><br>   
    <!-- кнопка отправки -->
    <div class="d-grid gap-2">
    <button type="button" class="btn btn-outline-warning btn-lg" onclick="sendStat()" id="counter">Далее</button><br> 
    </div>
    <table class="table table-dark table-hover" id="tableResult">
        <tr>
            <th>Подход</th>
            <th>Вес</th>
            <th>Кол-во</th>
        </tr>
        
    </table>
</div>


<!-- Таблица реузльтатов по подходам -->


<script>    
    //счётчик подходов
    var counterVal = 0;
    //функция отправки
    function sendStat(){
        //получение данных из полей
        var exercise = $('#exercise').val();
        var weight = $('#weight').val();
        var count = $('#count').val();
        //перменные статусы для сравнения 
        var weightStat = 0;
        var countStat = 0;
        
       //регулярное выражения для валидации веса и повторений
        var weightRegex = /^[1-9]{1,3}$/;
        var countRegex = /^[1-9]{1,3}$/;
        //валидация полей
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
        //объект для отправки
        var toServer = {
            exercise: exercise,
            weight : weight,
            count : count,
          }
          //формирование json строки
          var JSONToServer = JSON.stringify(toServer);
            //условие отправки
            if(weightStat && countStat == 1 ){
            //обновление счётчика подхода
            updateDisplay(++counterVal);
            function updateDisplay(val) {
            document.getElementById("counterField").innerHTML = ("Подход | " + ++val);
            }
            //Отправка данных
            $.ajax({
              url: '/back/work.php',
              type: 'post',
              data: 'data=' + JSONToServer,
              success: function(response){
                //если ОК, обновить данные в таблице подходов
                $('#tableResult').append('<tr class="child"><th>'+ counterVal +'</th><th>'+ weight +'</th><th>'+ count +'</th></tr>');
                  //проверка      
                  console.log('Данные отправлены!');
                  console.log(response["message"]);
              },
              error: function(response){
                  console.log(response["message"]);
              }
            });
            }
          //конец функции
          }
        
    
        // сброс счётчкика
//     function resetCounter() {
//     counterVal = 0;
//     updateDisplay(counterVal);
// }

</script>

</div>
</body>