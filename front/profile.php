<?php include 'header.php'; ?>
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

              error: function(){
                $("#textInfo").html("Произошла ошибка!");
                  console.log('error');
              },
              success: function(){
                $("#textInfo").html("Данные отправлены!");
                  console.log('Данные отправлены!');
                  console.log(imb);
              }
          })
      }

      
</script>
</body>