<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Registro</title>
</head>
<body>
  
  <div class="message">
    <?php $this->showMessages();?>
  </div>
  <section class = 'section-form'>
  <form  action = '<?php echo constant('URL');?>/signup/newUser' method = 'POST'>
    <h1>Registro</h1>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="username" id="floatingUsername" placeholder = 'UserName'>
      <label for="floatingUsername" class="form-label" id="floatingUsername">Username</label>
      
    </div>
  <div class="form-floating mb-2">
    <input type="password" name="password" class="form-control" id="floatingPassword"  placeholder = 'Password'>
    <label for="floatingPassword" class="form-label" >Password</label>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <div class="mb-3">
    <p>¿Tienes una cuenta? <a href='<?php echo constant('URL');?>'>Iniciar Sesión</a></p>
  </div>
</form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>