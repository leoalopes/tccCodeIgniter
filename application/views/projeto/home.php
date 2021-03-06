<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo ucfirst($projeto['nome']); ?></title>
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

<ul id="slide-out" class="side-nav white fixed z-depth-2">
  <li><div class="userView">
    <img class="circle" src="<?php echo base_url("assets/default-avatar.png"); ?>">
    <span class="name"><?php echo $session['nome'] ?></span>
    <span class="email"><?php echo $session['email'] ?></span>
  </div></li>
  <li class="divider"></li>
  <li style="text-align: center !important">
    <span><b>Opções do projeto</b></span>
    <div>
      <ul style="text-align: left !important">
        <li><a href="#editarProjeto" class="blue-text text-darken-4">Alterar nome</a></li>
        <li><a href="#excluirProjeto" class="blue-text text-darken-4">Excluir projeto</a></li>
      </ul>
    </div>
  </li>
</ul>

<div id="editarProjeto" class="modal">
    <div class="modal-content">
        <div class="input-field">
          <input name="nome" id="nomeProj" type="text" value="<?php echo $projeto['nome']; ?>">
          <label for="nome">Nome do projeto</label>
        </div>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Cancelar</a>
      <a id="editarProj" class="blue darken-4 white-text btn-flat">Atualizar</a>
    </div>
</div>

<div id="excluirProjeto" class="modal">
    <div class="modal-content">
        <h4 class="blue-text text-darken-4">Tem certeza?</h4><br>Desejar excluir esse projeto PERMANENTEMENTE?
    </div>
    <div class="modal-footer">
      <a id="delProj" class="modal-action modal-close blue-text text-darken-4 btn-flat">SIM</a>
    </div>
</div>

<div class="navbar-fixed">
  <nav class="row z-depth-2">
    <div class="nav-wrapper blue darken-4 white-text">
      <a href="" data-activates="slide-out" class="button-collapse hide-on-large-only menu-icon"><i class="material-icons">menu</i></a>
      <div class="brand-logo">
        <a href="<?php echo base_url("home"); ?>" class="breadcrumb" style="margin-left: 2vh"><i class="material-icons hide-on-med-and-down">home</i><b>Home</b></a>
        <a href="" class="breadcrumb"><b><?php echo ucfirst($projeto['nome']); ?></b></a>
      </div>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>
<br><br>
<div class="container" style="display: table; height: 75%">
<div style="display: table-cell; vertical-align: middle;">
<h3 class="blue-text text-darken-4"><b>Documentações</b></h3>
<?php
  if(empty($documentacoes)){
    echo '<div style="margin-top: 2vh; margin-bottom: 2vh; margin-left: 4vh !important">Você não possui nenhuma documentação cadastrada.</div>';
  } else {
    echo '<ul class="collapsible z-depth-0" data-collapsible="accordion" style="border: 1px solid white;">';
    foreach($documentacoes as $documento){
      echo '<li>
      <div class="collapsible-header z-depth-0 doc-titulo" style="border: 1px solid white; border-bottom: 1px solid #E0E0E0"><b>'.ucfirst($documento['titulo']).'</b><a class="grey-text text-darken-2 delete" style="float: right !important" data-modal="d'.$documento['id_documentacao'].'"><i class="material-icons">delete</i></a><a href="'.base_url("$id/projeto/".$projeto['nome']."/documentacao"."/").$documento['id_documentacao'].'/edit" class="blue-text text-darken-4 edit" style="float: right !important"><i class="material-icons">mode_edit</i></a></div>
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
    foreach ($documentacoes as $documento) {
      echo '<div id="d'.$documento['id_documentacao'].'" class="modal">
          <div class="modal-content">
              <h4 class="blue-text text-darken-4">Tem certeza?</h4><br>Desejar excluir essa documentação PERMANENTEMENTE?
          </div>
          <div class="modal-footer">
            <a class="modal-action modal-close blue-text text-darken-4 btn-flat" href="'.base_url("$id/projeto/".$projeto['nome']."/documentacao"."/").$documento['id_documentacao'].'/delete">SIM</a>
          </div>
      </div>';
    }
  }
?>
<a href="<?php echo $projeto['nome']; ?>/documentacao">Adicionar uma documentação</a><br><br>
</div></div>

<div id="error-modal" class="modal">
    <div class="modal-content">
        <h4 class="red-text text-lighten-2">Erro</h4><div id="erro"></div>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Ok</a>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/containerResize.js"></script>
<script>
$(document).ready(function(){
    $('.modal').modal();
    history.pushState('', 'Home', '<?php echo base_url("$id/projeto/".$projeto['nome']); ?>');
});

$(".edit").click(function(e){
  e.stopPropagation();
});

$(".delete").click(function(e){
  e.stopPropagation();
  $("#"+$(this).data('modal')).modal('open');
});

$("#delProj").click(function(e){
  e.preventDefault();

  $.ajax({
    type: 'POST',
    url: '<?php echo base_url('projeto/delete'); ?>',
    data: {'idprojeto': <?php echo $projeto['id_projeto']; ?>},
    success: function(response){
      //console.log(response);
      window.location.href = '<?php echo base_url($id); ?>';
    }
  });
});

$("#editarProj").click(function(e){
  e.preventDefault();

  $.ajax({
    type: 'POST',
    url: '<?php echo base_url('projeto/edit'); ?>',
    data: {'idprojeto': <?php echo $projeto['id_projeto']; ?>, 'nome': $("#nomeProj").val()},
    success: function(response){
      console.log(response);
      if(response == ''){
        window.location.href = "<?php echo base_url("$id/projeto/"); ?>" + $("#nomeProj").val();
      } else {
        $("#editarProjeto").modal('close');
        $("#erro").text(response);
        $("#error-modal").modal('open');
      }
    }
  });
});

</script>

</body>
