<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <link rel="stylesheet" href="nav_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Главная</title>
</head>
<body>

<nav class="navigation"> 
<div><a href="/"><img src="/image/logo.png">MYGYM</a></div>

    <div>
        <a href="/">ГЛАВНАЯ</a> 
        <a href="#">ПРОФИЛЬ</a> 
        <a href="#">СТАТИСТИКА</a> 
        <a href="#">УПРАЖНЕНИЯ</a> 
        <?php if(! isset($_SESSION['userLogin'])){echo '<a href="login.php">ВОЙТИ</a>';}else{ echo '<a href="ClearSession.php">ВЫЙТИ</a>';} ?>
    </div> 
  
</nav> 
</body>
</html>