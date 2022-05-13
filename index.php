<?php
/*
Использование:

Инклуд класса на странице с формой
include('ValidatorController.php');

Класс принимает 4 параметра: Имя, Имэйл, Телефон, Пароль
Описание компонентов в файле класса

Пример использования ниже
*/

include('ValidatorController.php');
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Validator Form</title>
  </head>  
  <body>
    <div class="container col-md-6">
    <h1>Validator Form</h1>

<?php
if (!empty($_POST)) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];

  $validator = new ValidatorController($name, $email, $phone, $password);

  $validator->checkName();

  $validator->checkEmail();

  $validator->checkPhone();

  $validator->checkPassword();

  $validator->showErrors();

  if ($validator->isSuccess()) {
    echo "<div style='color:green;'>Everything is OK! You can send data to DB here</div>";
  } else {
    echo "<div style='color:red;'>{$validator->showErrors()}</div>";
  }
}
?>

<form action="/" method="post">
  <div class="mb-3">
    <label class="form-label">Name (не менее 3 и не более 16 символов)</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label class="form-label">Phone (+375123456789)</label>
    <input type="text" class="form-control" name="phone">
  </div>
  <div class="mb-3">
    <label class="form-label">Password (более 6 символов, обязательно должно содержать более 1 цифрового символа)</label>
    <input type="text" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>
  </body>
</html>