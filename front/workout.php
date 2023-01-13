<?php 
include 'header.php'; 
include '../back/connect.php';
?>
<body>

<div class="container-fluid p-3 mb-2 d-flex align-items-center justify-content-center">
<!-- форма для заполнения -->

<!-- Настройка тренировки -->
<!-- Создание программы тренировки -->


    <!-- счётчик выполненых подходов -->
<div class="container">
<div class="d-grid gap-2">
   <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
    Настроить тренировку
  </button>
</div>
<div class="collapse" id="collapseSettings">
  <div class="card card-body bg-dark text-white">
       <!-- название / описание -->
        <label for="exercise" class="form-label">Название:</label>
        <input type="text" class="form-control" id="exercise" name="exercise"/>
        <label for="description" class="form-label">Описания тренировки:</label>
        <input type="text" class="form-control" id="description" name="exercise"/><br>
        <!-- Таймер отдыха -->
        <label for="customRange3" class="form-label">Укажите время отдыха между подходами:</label>
        <input type="range" class="form-range" min="0" max="300" step="10" id="customRange3">
        <span id="slider_value"></span>
        <!-- кнопка -->
        <div class="d-grid gap-2">
            <p id="textInfo"></p>
            <button type="button" class="btn btn-outline-warning btn-lg" onclick="sendEx()" id="counter">Подтвердить настройки</button><br> 
        </div>
  </div>
</div><br>
<div class="d-grid gap-2">
   <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMuscleGroups" aria-expanded="false" aria-controls="collapseMuscleGroups">
    Выбор упражнений
  </button>
</div>
<div class="collapse" id="collapseMuscleGroups">
  <div class="card card-body bg-dark text-white">

  <select class="form-select" aria-label="Default select example" id="groups">
  <option value="">Выберите группу мышц:</option>
    <?php
                  $stmt = $pdo->query("SELECT * FROM `Muscle_group`");
                  while($row = $stmt->fetch()){
                  echo '<option value="'.$row['id'].'">'.$row['desk'].'</option>';
                  }
                 $title = $row['id'];
                 global $title;
    ?>
    </select><br>
    <!-- список упражнений -->
    <table class="table table-dark table-hover" id="tableResult">
        <tr>
            <th>№</th>
            <th>Название</th>
         
            <th>Добавить</th>
        </tr>
        
    </table>
        
        <!-- кнопка -->
        <div class="d-grid gap-2">
            <p id="textInfo"></p>
            <button type="button" class="btn btn-outline-warning btn-lg" onclick="sendEx()" id="counter">Подтвердить настройки</button><br> 
        </div>
  </div>
</div>
        
</div>


<!-- Таблица реузльтатов по подходам -->


<script>    

$(document).on('input', '#customRange3', function() {
    $('#slider_value').html( $(this).val() + ' секунд' );
});

$( "#groups" ).click(function() {
    var group = $('#groups').val();

    var toServer = {
        group: group,
            
          }
          //формирование json строки
          var JSONToServer = JSON.stringify(toServer);
    
     $.ajax({
              url: '/back/work.php',
              type: 'post',
              data: 'data=' + JSONToServer,
              success: function(response){
                //если ОК, обновить данные в таблице подходов
                
                  //проверка      
                  console.log('Данные отправлены!');
                  console.log(response['message']);
                  var exercise = response['exercise'];
                  
                  // console.log(exercise);
                  exercise.forEach((element, index, array) => {
                  $('#tableResult').append('<tr class="child"><th>'+ element.id +'</th><th>'+ element.title +'</th><th>'+ element.description +'</th></tr>');
                  console.log(element.title); // 100, 200, 300
                  });
                //   $('#tableResult').append('<tr class="child"><th>'+ counterVal +'</th><th>'+ weight +'</th><th>'+ count +'</th></tr>');
              },
              error: function(response){
                  console.log("error");
                  console.log(response['message']);
              }
            });
          
          //конец функции
          
console.log(group);
});









    //счётчик подходов
    // var counterVal = 0;
    // //функция отправки
    // function sendStat(){
    //     //получение данных из полей
    //     var exercise = $('#exercise').val();
    //     var weight = $('#weight').val();
    //     var count = $('#count').val();
    //     //перменные статусы для сравнения 
    //     var weightStat = 0;
    //     var countStat = 0;
        
    //    //регулярное выражения для валидации веса и повторений
    //     var weightRegex = /^[1-9]{1,3}$/;
    //     var countRegex = /^[1-9]{1,3}$/;
    //     //валидация полей
    //     if(weightRegex.exec(weight) == null){
    //         $('#weight').css("color" , "red");
    //         $('#weight').css("border-color" , "red");
    //         var weightStat = 0;
    //     }else{
    //         $('#weight').css("color" , "green");
    //         $('#weight').css("border-color" , "green");
    //         var weightStat = 1;
    //     }
    //     if(countRegex.exec(count) == null){
    //         $('#count').css("color" , "red");
    //         $('#count').css("border-color" , "red");
    //         var countStat = 0;
    //     }else{
    //         $('#count').css("color" , "green");
    //         $('#count').css("border-color" , "green");
    //         var countStat = 1;
    //     }    
    //     //объект для отправки
    //     var toServer = {
    //         exercise: exercise,
    //         weight : weight,
    //         count : count,
    //       }
    //       //формирование json строки
    //       var JSONToServer = JSON.stringify(toServer);
    //         //условие отправки
    //         if(weightStat && countStat == 1 ){
    //         //обновление счётчика подхода
    //         updateDisplay(++counterVal);
    //         function updateDisplay(val) {
    //         document.getElementById("counterField").innerHTML = ("Подход | " + ++val);
    //         }
    //         //Отправка данных
    //         $.ajax({
    //           url: '/back/work.php',
    //           type: 'post',
    //           data: 'data=' + JSONToServer,
    //           success: function(response){
    //             //если ОК, обновить данные в таблице подходов
    //             $('#tableResult').append('<tr class="child"><th>'+ counterVal +'</th><th>'+ weight +'</th><th>'+ count +'</th></tr>');
    //               //проверка      
    //               console.log('Данные отправлены!');
    //               console.log(response["message"]);
    //           },
    //           error: function(response){
    //               console.log(response["message"]);
    //           }
    //         });
    //         }
    //       //конец функции
    //       } 
        
    
    //   сброс счётчкика
//     function resetCounter() {
//     counterVal = 0;
//     updateDisplay(counterVal);
// } -->

</script>

</div>
</body>