<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">   -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script  src="https://code.jquery.com/jquery-3.6.3.min.js"  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="  crossorigin="anonymous"></script>

    <link href="../css/workout.css" rel="stylesheet">
    <title>Главная</title>
</head>

<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="http://gym.alexat1m.beget.tech/">
      <img src="/image/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
      MyGym
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/front/profile.php">Профиль</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/front/exercises.php">Упражнения</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/front/workout.php">Тренировка</a>
        </li>
        
      </ul>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item justify-content-end">
          
          <?php if(! isset($_SESSION['userLogin'])){echo '<a class="nav-link" href="/front/login.php">Войти</a>';}else{ echo '<a class="nav-link" href="../back/ClearSession.php">ВЫЙТИ('.$_SESSION['userLogin'].')</a>';} ?>
    </li>
    </ul>
      
    </div>
  </div>
</nav><br>

</body>
</html>