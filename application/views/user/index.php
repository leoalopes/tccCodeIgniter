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


    <div class="navbar-fixed">
      <nav class="row">
        <div class="nav-wrapper blue darken-4 white-text">


          <a href="<?php echo base_url("home"); ?>" class="brand-logo" style="font-size: 1.3em !important; margin-left: 2vh"><i class="material-icons hide-on-med-and-down">home</i><b>Home</b></a>
          <ul class="right hide-on-med-and-down">
            <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="container" style="display: table; height: 80%">
    <div style="display: table-cell; vertical-align: middle;">
    <ul>
        <li><h3><b>Projetos</b></h3></li>
        <li class="divider"></li><br>
        <?php
          if(isset($projetos) && $projetos){
            foreach($projetos as $projeto){
              echo '<li class="itens projetos"><b><a href="'.$id.'/projeto/'.$projeto['nome'].'">'.ucfirst($projeto['nome']).'</a></b></li>';
            }
          }
        ?>
        <li class="itens"><a href="#proj-modal">Criar novo projeto</a></li>
    </ul>

    <br><br>
    <ul>
        <li><h3><b>Grupos</b></h3></li>
        <li class="divider"></li><br>
        <?php
          if(isset($grupos) && $grupos){
            foreach($grupos as $grupo){
              echo '<li class="itens projetos"><b><a href="'.$id.'/grupo/'.$grupo['id_grupo'].'">'.ucfirst($grupo['nome']).'</a></b></li>';
            }
          }
        ?>
        <li class="itens"><a href="<?php echo $id; ?>/grupo/cadastro">Criar novo grupo</a></li>
    </ul>
    </div></div>

    <!--  Scripts-->
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/submit.js"></script>


    <div id="proj-modal" class="modal">
        <div class="modal-content">
            <?php echo form_open('criar/projeto', array('id' => 'projeto')) ?>
              <div class="input-field">
                <input name="nome" id="nome" type="text">
                <label for="nome">Nome do projeto</label>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Cancelar</a>
          <button type="submit" form="projeto" class="blue darken-4 white-text btn-flat submit-button">Criar</button>
        </div>
    </div>

    <?php
      if(validation_errors() != null){
        echo '<div id="error" class="modal">
            <div class="modal-content">
                <h4 class="red-text text-lighten-2">Erro</h4>'.validation_errors().'
            </div>
            <div class="modal-footer">
              <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Ok</a>
            </div>
        </div>';
      }
    ?>

    <script>
    $(document).ready(function(){
        $('.modal').modal();
        $('#error').modal('open');
        history.pushState('', 'Home', '<?php echo base_url($id); ?>');
    });
    </script>
    </body>
</html>
