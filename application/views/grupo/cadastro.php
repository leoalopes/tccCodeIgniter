<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Cadastrar grupo</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <ul id="user_dropdown" class="dropdown-content blue darken-4">
      <li><a href="" class="white-text drop-item">Editar perfil</a></li>
      <li><a href="conta/logout" class="white-text drop-item">Sair</a></li>
  </ul>

  <div class="navbar-fixed">
    <nav class="row">
      <div class="nav-wrapper blue darken-4 white-text">

        <a href="<?php echo base_url() . explode('@', $session['email'])[0]; ?>" class="brand-logo"><i style="margin-left: 2vh; font-size: 5vh !important;" class="material-icons">keyboard_backspace</i><b>Voltar</b></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container row">
    <div class="section">
        <h3 class="center blue-text text-darken-4"><b>Criar grupo</b></h3><br>

        <div class="row">
            <form>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nome" id="nome" type="text">
                  <label for="nome">Nome do grupo</label>
                </div>
              </div>
              <div class="row">
                  <div class="col s12 input-field">
                    <input name="usuarios" id="usuarios" type="text" readonly>
                    <label for="usuarios">Adicionar usuários</label>
                  </div>
                </div>
              </div>
              <br>
              <div class="right-align row">
                <button class="btn blue darken-4 waves-effect waves-light" type="submit" name="">Criar</button>
              </div>
            </form>
        </div>


    </div>
  </div>

  <!--  Scripts-->
  <script src="<?php echo base_url(); ?>/assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/init.js"></script>

  <script>
    $(document).ready(function() {
      setTimeout(function() {
        Materialize.updateTextFields();
      }, 1000);
    });
  </script>

</body>
</html>
