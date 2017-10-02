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
  <?php if($admin){
    echo '<li style="text-align: center !important">
      <span><b>Opções do grupo</b></span>
      <div>
        <ul style="text-align: left !important">
          <li><a href="'.base_url("$id/grupo/".$grupo['id_grupo']).'/reuniao" class="blue-text text-darken-4">Nova reunião</a></li>
          <li><a href="'.base_url("$id/grupo/".$grupo['id_grupo']).'/edit" class="blue-text text-darken-4">Editar grupo</a></li>
          <li><a href="#excluirGrupo" class="blue-text text-darken-4">Excluir grupo</a></li>
        </ul>
      </div>
    </li>
    <li class="divider"></li>';
  } ?>
</ul>

<?php if($admin){
  echo '<div id="excluirGrupo" class="modal">
      <div class="modal-content">
          <h4 class="blue-text text-darken-4">Tem certeza?</h4><br>Desejar excluir esse grupo PERMANENTEMENTE?
      </div>
      <div class="modal-footer">
        <a id="delGrupo" class="modal-action modal-close blue-text text-darken-4 btn-flat">SIM</a>
      </div>
  </div>';
} ?>

<?php if($admin){
echo '<script>
    $("#delGrupo").click(function(e){
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "'.base_url("grupo/delete").'",
        data: {"idgrupo": '.$grupo["id_grupo"].'},
        success: function(response){
          console.log(response);
          window.location.href = "'.base_url($id).'";
        }
      });
    });
  </script>';
} ?>

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
<div class="container" style="display: table; height: 75%">
<div style="display: table-cell; vertical-align: middle;">
<h3><b>Projetos</b></h3><li class="divider"></li><br>
<?php
  if($projetos){
    foreach($projetos as $proj){
      $idg = $grupo['id_grupo'];
      $projnome = $proj['nome'];
      echo '<a class="itens" href="'.base_url("$id/grupo/$idg/projeto/$projnome").'"><b>'.ucfirst($proj['nome']).'</b><br>';
    }
  }
  echo '<a href="#proj-modal" style="margin-top: -2vh !important; margin-left: 5vh !important">Criar novo projeto</a><br><br>';
?>
<?php
  if(!empty($reunioes['pendentes'])){
    echo '<h3><b>Reuniões futuras</b></h3><li class="divider"></li><br>';
    foreach($reunioes['pendentes'] as $reuniao){
      $data = substr($reuniao['data'], 8, 2) . "/" . substr($reuniao['data'], 5, 2) . "/" . substr($reuniao['data'], 0, 4);
      $hora = substr($reuniao['data'], 11, 5);
      echo '<span style="margin-left: 5vh !important"><b>' . $data . '</b> - ' . $hora . '</span> <a href="#r'. $reuniao['id_reuniao'] .'">&nbsp;<span>Ver mais</span></a>
      <div id="r'. $reuniao['id_reuniao'] .'" class="modal">
        <div class="modal-content">
          <h3 style="width: 100% !important"><b>Reunião do dia '. $data .' às '. $hora .'</b>';
          if($admin){
            echo '<div style="float: right !important"><a href="'. base_url("$id/grupo/".$grupo['id_grupo']."/reuniao"."/".$reuniao['id_reuniao']) .'/edit" class="blue-text text-darken-4 edit"><i class="small material-icons">mode_edit</i></a>
            &nbsp;<a href="'. base_url("$id/grupo/".$grupo['id_grupo']."/reuniao"."/".$reuniao['id_reuniao']) .'/delete" class="grey-text text-darken-2 delete"><i class="small material-icons">delete</i></a></div>';
          }
          echo '</h3><li class="divider"></li><br>
          <h5>'. $reuniao['motivo'] .'</h5>
        </div><br><br>
      </div>
      <br>';
    }
    echo "<br><br>";
  }
  if(!empty($reunioes['realizadas'])){
    echo '<h3><b>Histórico de reuniões</b></h3><li class="divider"></li><br>';
    foreach($reunioes['realizadas'] as $reuniao){
      $data = substr($reuniao['data'], 8, 2) . "/" . substr($reuniao['data'], 5, 2) . "/" . substr($reuniao['data'], 0, 4);
      $hora = substr($reuniao['data'], 11, 5);
      echo '<span style="margin-left: 5vh !important"><b>' . $data . '</b> - ' . $hora . '</span><a href="#r'. $reuniao['id_reuniao'] .'">&nbsp; <span>Ver mais</span></a>
      <div id="r'. $reuniao['id_reuniao'] .'" class="modal">
        <div class="modal-content">
          <h3 style="width: 100% !important"><b>Reunião do dia '. $data .' às '. $hora . '</b>';
          if($admin){
            echo '<div style="float: right !important"><a href="'. base_url("$id/grupo/".$grupo['id_grupo']."/reuniao"."/".$reuniao['id_reuniao']) .'/delete" class="grey-text text-darken-2 delete"><i class="small material-icons">delete</i></a></div>';
          }
          echo '</h3><li class="divider"></li><br>
          <h5 style="text-align: justify">'. $reuniao['motivo'] .'</h5>
        </div><br><br>
      </div>
      <br>';
    }
    echo "<br>";
  }
?>
</div></div><br><br>

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
          window.location.href = "<?php echo base_url("$id/grupo/".$grupo['id_grupo']."/projeto"); ?>/"+$("#nome").val();
        } else {
          $("#erro").text(response);
          $("#error-modal").modal('open');
        }
      }
    });
  });
</script>

</body>
