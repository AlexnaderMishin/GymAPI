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
        
        // console.log(exercise, weight, count);
    }
</script>


</body>