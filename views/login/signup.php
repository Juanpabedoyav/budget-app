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
  <form  action = '<?php echo constant('URL');?>/signup/newUser' method = 'POST'>
    <h1>Registro</h1>
    <div class="mb-3">
      <label for="username" class="form-label">User Name</label>
      <input type="text" class="form-control" name="username" id="username">
      
    </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <div class="mb-3">
    <p>¿Tienes una cuenta? <a href='<?php echo constant('URL');?>'>Iniciar Sesión</a></p>
  </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>