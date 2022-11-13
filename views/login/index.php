<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/index.css">
    
    <title>Login</title>
</head>
<body>
    <div class="message">
        <?php $this->showMessages()?>
        <?php (isset($this->errorMessage))?  $this->errorMessage : '' ?>
    </div>
 
    <h1>Login</h1>
    <section class = 'section-form'>
        <form action="<?php echo constant('URL'); ?>/login/authenticate" method="POST">           
            <p class="form-floating mb-3">
                <input class="form-control" type="text" name="username" id="floatingUsername" placeholder = 'UserName' >
                <label for="floatingUsername"  class="form-label" >Username</label>
            </p>
            <p class="form-floating mb-3">
                <input class="form-control" type="password" name="password" id="floatingPassword" placeholder = 'Password'>
                <label class="form-label" for="floatingPassword">password</label>
            </p>
            <p>
                <input class="btn btn-primary" type="submit" value="Iniciar sesión" />
            </p>

            <p>
                ¿No tienes cuenta? <a href="<?php echo constant('URL'); ?>/signup">Registrarse</a>
            </p>
        </form>
    </section>
        <p>
</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>