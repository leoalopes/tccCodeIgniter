<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Home</title>

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


  <ul id="slide-out" class="side-nav white">
    <li><div class="userView">
      <a href="user"><img class="circle" src="https://image.freepik.com/free-icon/male-user-shadow_318-34042.jpg"></a>
      <a href="name"><span class="name"><?php echo $session['nome'] ?></span></a>
      <a href="email"><span class="email"><?php echo $session['email'] ?></span></a>
    </div></li>
    <li class="divider"></li>
  </ul>


    <div class="navbar-fixed">
      <nav class="row">
        <div class="nav-wrapper blue darken-4 white-text">

          <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>


          <a href="" class="brand-logo"><b>Plataforma</b></a>
          <ul class="right hide-on-med-and-down">
            <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </nav>
    </div>

    <br><br><div class="container">
    <ul>
        <li><h3><b>Projetos</b></h3></li>
        <li class="divider"></li><br>
        <?php
          foreach($projetos as $projeto){
            echo '<li class="itens projetos"><b><a href="'.$projeto['nome'].'">'.$projeto['nome'].'</a></b></li><br>';
          }
        ?>
        <li class="itens"><a href="#proj-modal">Criar novo projeto</a></li>
    </ul>
    </div>

    <br><br><div class="container">
    <ul>
        <li><h3><b>Grupos</b></h3></li>
        <li class="divider"></li><br>
        <li class="itens"><a href="#group-modal">Criar novo grupo</a></li>
    </ul>
    </div>

    <!--  Scripts-->
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/init.js"></script>


    <div id="proj-modal" class="modal">
        <div class="modal-content">
            <form>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nome" id="nome" type="text" class="validate">
                  <label for="nome">Nome do projeto</label>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Cancelar</a>
          <a class="modal-action modal-close blue darken-4 white-text btn-flat">Criar</a>
        </div>
    </div>

    <div id="group-modal" class="modal">
        <div class="modal-content">
            <form>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nomegrupo" id="nomegrupo" type="text" class="validate">
                  <label for="nomegrupo">Nome do grupo</label>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Cancelar</a>
          <a class="modal-action modal-close blue darken-4 white-text btn-flat">Criar</a>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('.modal').modal();
    });
    </script>
    </body>
</html>
