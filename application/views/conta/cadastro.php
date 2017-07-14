<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Cadastro</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <div class="container row">
    <div class="section">
        <h1 class="center blue-text text-darken-4"><b>Cadastro</b></h1><br>

        <div class="row">
            <?php echo form_open('usuarios/cadastro', array('class' => 'col s12 m6 offset-m3'));?>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nome" id="nome" type="text">
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input name="email" id="email" type="email">
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input name="senha" id="senha" type="password">
                  <label for="senha">Senha</label>
                </div>
              </div>
              <div class="center row">
                <h6 class="red-text center-align"><?php echo validation_errors(); ?></h6>
              </div>
              <div class="center row"><br>
                <button class="btn blue darken-4 waves-effect waves-light submit-button" type="submit" name="btncadastrar">Cadastrar</button>
                <span class="col s12 m8 offset-m2" style="margin-top: 5vh">Já possui uma conta? <a href="login">Entrar</a></span>
              </div>
            </form>
        </div>


    </div>
  </div>

  <!--  Scripts-->
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/submit.js"></script>

  <script>
    $(document).ready(function() {
      Materialize.updateTextFields();
    });
  </script>

</body>
</html>
