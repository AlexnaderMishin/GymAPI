<?php 
include 'header.php'; 
include '../back/connect.php';
?>
<body>

   <div class="container">
   <div class="d-grid gap-2">
   <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Добавить новое упражнение
  </button>
   </div>
<div class="collapse" id="collapseExample">
  <div class="card card-body bg-dark text-white">
        <select class="form-select" aria-label="Default select example" id="group">
            <?php
                  $stmt = $pdo->query("SELECT * FROM `Muscle_group`");
                  while($row = $stmt->fetch()){
                  echo '<option value="'.$row['id'].'">'.$row['desk'].'</option>';
                  }
            ?>
        </select>
        <label for="exercise" class="form-label">Название:</label>
        <input type="text" class="form-control" id="exercise" name="exercise"/>
        <label for="description" class="form-label">Описания выполнения:</label>
        <input type="text" class="form-control" id="description" name="exercise"/>
        <div class="d-grid gap-2">
            <p id="textInfo"></p>
            <button type="button" class="btn btn-outline-warning btn-lg" onclick="sendEx()" id="counter">Добавить упражнение</button><br> 
        </div>
  </div>
</div>
        
</div>



   <script> 
    //функция отправки
    function sendEx(){
        //получение данных из полей
        var exercise = $('#exercise').val();
        var description = $('#description').val();
        var group = $('#group :selected').val();
        var extStat = 0;
        var descStat = 0;

       //регулярное выражения для валидации веса и повторений
        var exerciseRegex = /^[a-zA-Zа-яА-Я]{3,100}$/;
        var descriptionRegex = /^[a-zа-я]{3,255}$/;
        //валидация полей
        if(exerciseRegex.exec(exercise) == null){
            $('#exercise').css("color" , "red");
            $('#exercise').css("border-color" , "red");
            extStat = 0;
        }else{
            $('#exercise').css("color" , "green");
            $('#exercise').css("border-color" , "green");
            extStat = 1;
        }
        if(descriptionRegex.exec(description) == null){
            $('#description').css("color" , "red");
            $('#description').css("border-color" , "red");
            descStat = 0;
        }else{
            $('#description').css("color" , "green");
            $('#description').css("border-color" , "green");
            descStat = 1;
        }    
        console.log(group);
        //объект для отправки
         var toServer = {
             exercise: exercise,
             description : description,
             group : group,
           }
           //формирование json строки
           var JSONToServer = JSON.stringify(toServer);
             //условие отправки
             if(extStat && descStat == 1 ){
             
             //Отправка данных
             $.ajax({
               url: '../back/exercise.php',
               type: 'post',
               data: 'data=' + JSONToServer,
               success: function(response){
                   //проверка      
                   console.log('Данные отправлены!');
                   
               },
               error: function(response){
                   console.log('error');
               }
             });
             }
        //конец функции
          }
        
   


</script>
</body>