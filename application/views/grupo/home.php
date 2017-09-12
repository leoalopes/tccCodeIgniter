<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo ucfirst($grupo['nome']); ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/highlight/styles/default.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/highlight/highlight.pack.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/submit.js"></script>
</head>
<body>

<ul id="user_dropdown" class="dropdown-content blue darken-4">
    <li><a href="" class="white-text drop-item">Editar perfil</a></li>
    <li><a href="<?php echo base_url('conta/logout'); ?>" class="white-text drop-item">Sair</a></li>
</ul>

<ul id="slide-out" class="side-nav white">
  <li><div class="userView">
    <img class="circle" src="https://image.freepik.com/free-icon/male-user-shadow_318-34042.jpg">
    <span class="name"><?php echo $session['nome'] ?></span>
    <span class="email"><?php echo $session['email'] ?></span>
  </div></li>
  <li class="divider"></li>
</ul>

<div class="navbar-fixed">
  <nav class="row">
    <div class="nav-wrapper blue darken-4 white-text">
      <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
      <div class="brand-logo">
        <a href="<?php echo base_url("home"); ?>" class="breadcrumb"><b>Home</b></a>
        <a href="" class="breadcrumb"><b>Grupo <?php echo ucfirst($grupo['nome']); ?></b></a>
      </div>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>
<br><br>
<div class="container">
<h3 class="blue-text text-darken-4"><b>Projetos</b></h3>
<?php
  if($projetos){
    echo '<br><ul>';
    foreach($projetos as $proj){
      $nome = $session['nome'];
      $idg = $grupo['id_grupo'];
      $projnome = $proj['nome'];
      echo '<a href="'.base_url("$nome/grupo/$idg/projeto/$projnome").'"><li class="itens gprojetos"><b>'.ucfirst($proj['nome']).'</b></li><li class="divider" style="margin-top: 2vh"></li><br>';
    }
    echo '</ul>';
  }
?>
<a href="#proj-modal">Criar novo projeto</a>
</div>

<div id="proj-modal" class="modal">
    <div class="modal-content">
        <div class="input-field">
          <input name="nome" id="nome" type="text">
          <label for="nome">Nome do projeto</label>
        </div>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Cancelar</a>
      <a id="criarProj" class="blue darken-4 white-text btn-flat">Criar</a>
    </div>
</div>

<div id="error-modal" class="modal">
    <div class="modal-content">
        <h4 class="red-text text-lighten-2">Erro</h4><div id="erro"></div>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Ok</a>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('.modal').modal();
  });

  $("#criarProj").click(function(e){
    e.preventDefault();
    $("#proj-modal").modal('close');

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url('grupo/criarProjeto') ?>',
      data: { 'nome': $("#nome").val(), 'id_grupo': '<?php echo $grupo['id_grupo']; ?>'},
      success: function(response){
        console.log(response);
        if(response == ''){

        } else {
          $("#erro").text(response);
          $("#error-modal").modal('open');
        }
      }
    });
  });
</script>

</body>
