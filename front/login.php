<?php 
include 'header.php';
// include '../back/connect.php';
?>
<div class="registrationForm" id="form1">

<h4 align="center">Регистрация</h4>
<p id="reginfo"></p>
<p id="regPassinfo"></p>
  <div class="mb-3">
    <label id="log_error" for="loginReg" class="form-label">Логин:</label>
    <input type="text" class="form-control" id="loginReg">
  </div>
  <div class="mb-3">
    <label id="pass_error" for="passwordReg" class="form-label">Пароль:</label>
    <input type="password" class="form-control" id="passwordReg">
  </div>
  <div class="mb-3">
    <label id="pass_error1" for="passwordConfirmReg" class="form-label">Повторите пароля:</label>
    <input type="password" class="form-control" id="passwordConfirmReg">
  </div>
  <button class="btn btn-warning" onclick="RegFunc()">Регистрация</button>
  <button class="btn btn-outline-warning" id="form1btn">Войти в аккаунт</button>

 
  </div>

    <div class="authorizationForm" id="form2">
        <h4 align="center">Авторизация</h4>
        <div class="mb-3">
        <label for="loginAuth" class="form-label">Логин:</label>
        <input type="text" class="form-control" id="loginAuth">
        </div>
        <div class="mb-3">
        <label for="passwordAuth" class="form-label">Пароль:</label>
        <input type="password" class="form-control" id="passwordAuth">
        </div>
        <p id="logAuth_error"></p>
        <button class="btn btn-warning" onclick="AuthFunc()">Войти</button>
        
        <button class="btn btn-outline-warning" id="form2btn">Создать новый аккаунт</button>
    </div>

    <script>
        $("#form2").css("display", "none"); 
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

          var usernameRegex = /^[a-z][a-z0-9]{3,12}$/i;
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
            $('#reginfo').text('');
          }else{
            $('#log_error').text('Ошбика валидации логина!');
            $('#log_error').css("color" , "red");
            $('#loginReg').css("border-color" , "red");
            $('#reginfo').text('Логин должен состоять из латинских букв и цифр. Не менее 4х символов. Первый симвл - Буква!');
            $('#reginfo').css("color" , "red");
            
            

          }

          if(passwordRegex.exec(RegPassword)!== null){
            $('#pass_error').text('Пароль подходит!');
            $('#pass_error').css("color" , "green");
            $('#passwordReg').css("border-color" , "green");

          }else{
            $('#pass_error').text('Ошбика валидации пароля!');
            $('#pass_error').css("color" , "red");
            $('#passwordReg').css("border-color" , "red");
            $('#regPassinfo').text('Пароль должен состоять из латинскх букв и цифр, не менее 8 символов и не более 16!');
            $('#regPassinfo').css("color" , "red");
            

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

              error: function(response){
                  console.log('error');
              },
              success: function(response){
                  console.log('Данные отправлены на проверку!');
                  if(response["stat"] == true){
                    
                    window.location.href = "http://gym.alexat1m.beget.tech/";
                }
                $('#userInfo').html("Добрый день : " + response["userLogin"] + " ! ");
                
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
                    window.location.href = "http://gym.alexat1m.beget.tech/";
                }
                $('#userInfo').html("Добрый день : " + response["login"] + " ! ");
                // window.location = "index.php";
                 
              }
          }) 

      }
    </script>
</body>
</html>