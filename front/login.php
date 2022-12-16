<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <link rel="stylesheet" href="/css/nav_style.css">
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Авторизация</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="registrationForm" id="form1">
        <p>Регистрация</p>
        <input type="text" id="loginReg" placeholder="Введите логин : " required>
        <p id="log_error"></p>
        <input type="password" id="passwordReg" placeholder="Введите пароль : " required>
        <p id="pass_error">Ошибки пароля</p>
        <input type="password" id="passwordConfirmReg" placeholder="Подтвердите пароль : " required>
        <p id="pass_error1">Ошибки пароля</p>
        <button onclick="RegFunc()">Регистрация</button>
        <button id="form1btn">Войти в существующий аккаунт</button>
        

    </div>

    <div class="authorizationForm" id="form2">
        <p>Авторизация</p>
        <input type="text" id="loginAuth" placeholder="Введите логин : ">
        
        <input type="password" id="passwordAuth" placeholder="Введите пароль : ">
        <p id="logAuth_error"></p>
        <button onclick="AuthFunc()">Авторизация</button><br>
        <p id="form2btn">Регистрация нового пользователя</p>
    </div>
    <script>
        $("#form2").css("display", "none"); // so it's initially invisible
        $("#form1btn").on("click", function() {
        $("#form1").css("display", "none");
        $("#form2").css("display", "block");
});
$("#form2btn").on("click", function() {
        $("#form2").css("display", "none");
        $("#form1").css("display", "block");
});

function RegFunc(){
          var RegLogin = $('#loginReg').val();
          var RegPassword = $('#passwordReg').val();
          var RegPasswordConfirm = $('#passwordConfirmReg').val();

          var usernameRegex = /^[a-z][a-z0-9]{4,12}$/i;
          var passwordRegex = /^[a-zA-Z0-9]{8,16}$/;

          var toServer = {
              login: RegLogin,
              password: RegPassword,
              passwordConf: RegPasswordConfirm
          }
          
          
          //проверка логина
          if(usernameRegex.exec(RegLogin)!== null){
            $('#log_error').text('Логин подходит!');
            $('#log_error').css("color" , "green");
            $('#loginReg').css("border-color" , "green");
          }else{
            $('#log_error').text('Ошбика валидации логина!');
            $('#log_error').css("color" , "red");
            $('#loginReg').css("border-color" , "red");

          }

          if(passwordRegex.exec(RegPassword)!== null){
            $('#pass_error').text('Пароль подходит!');
            $('#pass_error').css("color" , "green");
            $('#passwordReg').css("border-color" , "green");

          }else{
            $('#pass_error').text('Ошбика валидации пароля!');
            $('#pass_error').css("color" , "red");
            $('#passwordReg').css("border-color" , "red");

          }
          if(RegPassword == RegPasswordConfirm && RegPasswordConfirm !== ''){
            $('#pass_error1').text('Пароли совпадают!');
            $('#pass_error1').css("color" , "green");
            $('#passwordConfirmReg').css("border-color" , "green");

          }else{
            $('#pass_error1').text('Пароли не совпадают!');
            $('#pass_error1').css("color" , "red");
            $('#passwordConfirmReg').css("border-color" , "red");

          }

          var JSONToServer = JSON.stringify(toServer);

          $.ajax({
              url: '/back/reg.php',
              type: 'post',
              data: 'data=' + JSONToServer,

              error: function(){
                  console.log('error');
              },
              success: function(){
                  console.log('Данные отправлены на проверку!');
              }
          })
      }
      
      //Авторизация
      function AuthFunc(){
          var AuthLogin = $('#loginAuth').val();
          var AuthPassword = $('#passwordAuth').val();

          var toServer = {
              login: AuthLogin,
              password: AuthPassword
          }

          var JSONToServer = JSON.stringify(toServer);

          $.ajax({
              url: '/back/auth.php',
              type: 'post',
              data: 'data=' + JSONToServer,

              error: function(response){
                  console.log(response["message"]);
              },
              success: function(response){
                console.log(response["login"]);
                if(response["status"] == false){
                    $('#logAuth_error').text(response["login"]);
                    $('#logAuth_error').css("color" , "red");
                    $('input').css("border-color" , "red");
                }
                if(response["status"] == true){
                    // window.location = "index.php";
                    window.location.href = "http://api/";
                }
                $('#userInfo').html("Добрый день : " + response["login"] + " ! ");
                // window.location = "index.php";
                 
              }
          }) 

      }
    </script>
</body>
</html>