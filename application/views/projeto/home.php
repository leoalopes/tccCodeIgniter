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
        <a href="" class="breadcrumb"><b><?php echo ucfirst($projeto); ?></b></a>
      </div>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>
<br><br>
<div class="container">
<h3 class="blue-text text-darken-4"><b>Documentações</b></h3>
<?php
  if(empty($documentacoes)){
    echo '<div class="container" style="margin-top: 2vh; margin-bottom: 2vh; margin-left: 2vh !important"><i class="material-icons" style="vertical-align: middle">sentiment_dissatisfied</i> Você não possui nenhuma documentação cadastrada.</div>';
  } else {
    echo '<ul class="collapsible z-depth-0" data-collapsible="accordion" style="border: 1px solid white">';
    foreach($documentacoes as $documento){
      echo '<li>
      <div class="collapsible-header z-depth-0 doc-titulo" style="border: 1px solid white; border-bottom: 1px solid #E0E0E0"><b>'.ucfirst($documento['titulo']).'</b><span data-id="'.$documento['id_documentacao'].'" class="blue-text text-darken-4 edit" style="float: right !important"><i class="material-icons">mode_edit</i></span></div>
      <div class="collapsible-body z-depth-0 left-margin" style="border: 1px solid white">
      <ul class="collapsible z-depth-0" data-collapsible="expandable" style="margin-top: -3vh; margin-left: -3vh; border: none">';
      $array = explode('<b>', $documento['conteudo']);
      unset($array[0]);
      foreach($array as $string){
        $subtitulo = ucfirst(substr($string, 0, strpos($string, '</b>')+4));
        $conteudo = substr($string, strpos($string, '</b>')+4, strlen($string));
        if(substr($conteudo, 0, 4) == '<br>'){
           $conteudo = substr($conteudo, 4, strlen($conteudo));
        }

        if(substr($conteudo, 0, 11) == '</span><br>'){
           $conteudo = substr($conteudo, 11, strlen($conteudo));
        }

        if(substr($conteudo, strlen($conteudo)-4, strlen($conteudo)) == '<br>'){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-4);
        }

        if(substr($conteudo, strlen($conteudo)-10, strlen($conteudo)) == '<br><span>'){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-10);
        }

        if(substr($conteudo, strlen($conteudo)-16, strlen($conteudo)) == '<span><br></span>'){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-16);
        }

        if(substr($conteudo, strlen($conteudo)-18, strlen($conteudo)) == "<span>\t<br>\t</span>"){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-18);
        }

        if(substr($conteudo, strlen($conteudo)-18, strlen($conteudo)) == "<span>\n<br>\n</span>"){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-18);
        }

        if(substr($conteudo, strlen($conteudo)-18, strlen($conteudo)) == "<span>".PHP_EOL."<br>".PHP_EOL."</span>"){
           $conteudo = substr($conteudo, 0, strlen($conteudo)-18);
        }

        echo '<li>
          <div class="collapsible-header blue-text text-darken-4" style="border-bottom: 1px solid white !important">'.$subtitulo.'</b></div>
          <div class="collapsible-body" style="border: 1px solid white !important; margin-top: -3vh; margin-left: 2vh"><span>'.$conteudo.'</span></div>
        </li>';
      }
      echo '</div></li>';
    }
    echo '</ul>';
  }
?>
<br><a href="<?php echo $projeto; ?>/documentacao">Adicionar uma documentação</a>
</div>
<script>
$(document).ready(function(){
    $('.modal').modal();
    $('#error').modal('open');
    history.pushState('', 'Home', '<?php echo base_url("$id/projeto/$projeto"); ?>');
});

$(".edit").click(function(e){
  e.stopPropagation();
  window.location.href = '<?php echo "$projeto/documentacao/"; ?>' + $(this).data('id') + '/edit';
});
</script>

</body>
