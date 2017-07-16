<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo ucfirst($projeto); ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/submit.js"></script>
</head>
<body>

<ul id="user_dropdown" class="dropdown-content blue darken-4">
    <li><a href="" class="white-text drop-item">Editar perfil</a></li>
    <li><a href="conta/logout" class="white-text drop-item">Sair</a></li>
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
        <a href="" class="breadcrumb"><b><?php echo ucfirst($projeto); ?></b></a>
      </div>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>

<a href="<?php echo base_url("$id/projeto/$projeto/documentacao"); ?>">Criar documentacao</a>

<br><br>
<?php
  foreach($documentacoes as $documentos){
    echo '<div>'.$documentos['conteudo'].'</div>';
  }
?>

<script>
$(document).ready(function(){
    $('.modal').modal();
    $('#error').modal('open');
    history.pushState('', 'Home', '<?php echo base_url("$id/projeto/$projeto"); ?>');
});
</script>

</body>
