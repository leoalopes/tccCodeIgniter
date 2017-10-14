<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Editar projeto</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="<?php echo base_url(); ?>/assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/init.js"></script>
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
      <?php
        echo '<li class="divider"></li><li style="text-align: center !important"><span><b>Opções do projeto</b></span>
        <div>
          <ul style="text-align: left !important">
            <li><a href="'.base_url("$id/grupo/".$grupo['id_grupo']."/projeto"."/".$projeto['nome']).'/edit" class="blue-text text-darken-4">Editar projeto</a></li>
            <li><a href="#excluirProjeto" class="blue-text text-darken-4">Excluir projeto</a></li>
          </ul>
        </div></li>';
        if($admin){
          echo '<li class="divider"></li><li style="text-align: center !important">
            <span><b>Opções do grupo</b></span>
            <div>
              <ul style="text-align: left !important">
                <li><a href="'.base_url("$id/grupo/".$grupo['id_grupo']).'/reuniao" class="blue-text text-darken-4">Nova reunião</a></li>
                <li><a href="'.base_url("$id/grupo/".$grupo['id_grupo']).'/edit" class="blue-text text-darken-4">Editar grupo</a></li>
                <li><a href="#excluirGrupo" class="blue-text text-darken-4">Excluir grupo</a></li>
              </ul>
            </div>
          </li>';
        } ?>
  </ul>
  <?php
  echo '<div id="excluirProjeto" class="modal">
      <div class="modal-content">
          <h4 class="blue-text text-darken-4">Tem certeza?</h4><br>Desejar excluir esse projeto PERMANENTEMENTE?
      </div>
      <div class="modal-footer">
        <a id="delProj" class="modal-action modal-close blue-text text-darken-4 btn-flat">SIM</a>
      </div>
  </div>
  <script>
  $("#delProj").click(function(e){
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "'.base_url("projeto/delete").'",
      data: {"idprojeto": '.$projeto["id_projeto"].'},
      success: function(response){
        //console.log(response);
        window.location.href = "'.base_url("$id/grupo/".$grupo["id_grupo"]).'";
      }
    });
  });
  </script>'; ?>

  <div class="navbar-fixed">
    <nav class="row">
      <div class="nav-wrapper blue darken-4 white-text">
        <a href="" data-activates="slide-out" class="button-collapse hide-on-large-only menu-icon"><i class="material-icons">menu</i></a>
        <div class="brand-logo">
          <a href="<?php echo base_url("home"); ?>" class="breadcrumb" style="margin-left: 2vh"><i class="material-icons hide-on-med-and-down">home</i><b>Home</b></a>
          <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>" class="breadcrumb"><b>Grupo <?php echo ucfirst($grupo['nome']); ?></b></a>
          <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']."/projeto"."/".$projeto['nome']); ?>" class="breadcrumb"><b><?php echo ucfirst($projeto['nome']); ?></b></a>
          <a href="" class="breadcrumb"><b>Edição</b></a>
        </div>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div><br>
  <div class="container row">
    <div class="section">
        <h3 class="center blue-text text-darken-4"><b>Editar projeto</b></h3><br>

        <div class="row">
            <div class="input-field col s12">
              <input name="nome" id="nome" type="text" value="<?php echo $projeto['nome']; ?>">
              <label for="nome">Nome do projeto</label>
            </div>
        </div><br>

        <?php
        echo '<table id="userTable" class="striped">
        <thead>
          <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Leitura</th>
              <th>Escrita</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($usuarios as $i => $u) {
          if($u['id_usuario'] == $session['id_usuario']){
            echo '<tr style="color: grey !important">
              <td>'. $u['nome'] .'</td>
              <td class="email">'. $u['email'] .'</td>
              <td><input type="checkbox" disabled class="filled-in blue valign-wrapper checkboxAdmin" style="position: relative !important; top: 50% !important" checked="checked" /><label for="checkboxAdmin"></label></td>
              <td><input type="checkbox" disabled class="filled-in blue valign-wrapper checkboxAdmin" style="position: relative !important; top: 50% !important" checked="checked" /><label for="checkboxAdmin"></label></td>
            </tr>';
            if($i != 0){
              echo '<tr style="color: grey !important">
                <td>'. $usuarios[0]['nome'] .'</td>
                <td class="email">'. $usuarios[0]['email'] .'</td>
                <td><input type="checkbox" disabled class="filled-in blue valign-wrapper checkboxAdmin" style="position: relative !important; top: 50% !important" checked="checked" /><label for="checkboxAdmin"></label></td>
                <td><input type="checkbox" disabled class="filled-in blue valign-wrapper checkboxAdmin" style="position: relative !important; top: 50% !important" checked="checked" /><label for="checkboxAdmin"></label></td>
              </tr>';
              unset($usuarios[0]);
            }
            unset($usuarios[$i]);
          }
        }
        if($usuarios && !empty($usuarios)){
          foreach($usuarios as $usuario){
            echo '<tr>
              <td>'. $usuario['nome'] .'</td>
              <td class="email">'. $usuario['email'] .'</td>
              <td><input type="checkbox" class="filled-in blue valign-wrapper" id="leitura'. $usuario['id_usuario'] .'" style="position: relative !important; top: 50% !important;" ';
              if($usuario['leitura'] || $usuario['escrita'] || $usuario['admin']){
                echo 'checked="checked"';
              }
              echo ' /><label for="leitura'. $usuario['id_usuario'] .'"></label></td>
              <td><input type="checkbox" class="filled-in blue valign-wrapper" id="escrita'. $usuario['id_usuario'] .'" style="position: relative !important; top: 50% !important;" ';
              if($usuario['escrita'] || $usuario['admin']){
                echo 'checked="checked"';
              }
              echo ' /><label for="escrita'. $usuario['id_usuario'] .'"></label></td>
            </tr>';
          }
        }
        echo '</tbody>
        </table><br>';
        ?>
        <br><br><div class="right row">
          <a class="btn blue darken-4 waves-effect waves-light" id="btn-update">Salvar</a>
        </div><br><br>
    </div>
  </div>

  <div id="error" class="modal">
      <div class="modal-content">
          <h4 class="red-text text-lighten-2">Erro</h4>
          <span id="texto-erro"></span>
      </div>
      <div class="modal-footer">
        <a class="modal-action modal-close blue-text text-darken-4 btn-flat cancel">Ok</a>
      </div>
  </div>


  <!--  Scripts-->
  <script src="<?php echo base_url(); ?>assets/js/containerResize.js"></script>

  <script>
    <?php
      if($usuarios && !empty($usuarios)){
        foreach($usuarios as $usuario){
          echo '$("#escrita'.$usuario['id_usuario'].'").click(function(){
            if($(this).is(":checked"))
              $("#leitura'.$usuario['id_usuario'].'").prop("checked", true);
          });';

          echo '$("#leitura'.$usuario['id_usuario'].'").click(function(){
            if(!$(this).is(":checked"))
              $("#escrita'.$usuario['id_usuario'].'").prop("checked", false);
          });';
        }
      }
    ?>

    $("#btn-update").click(function(){
      var chips = [];
      var chip;
      <?php
      if($usuarios && !empty($usuarios)){
        foreach ($usuarios as $usuario) {
          echo 'chip = {
            id: '. $usuario['id_usuario'] .',
            leitura: $("#leitura'. $usuario['id_usuario'] . '").is(":checked"),
            escrita: $("#escrita'. $usuario['id_usuario'] . '").is(":checked")
          }
          chips.push(chip);';
        }
      } ?>
      console.log(chips);

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('grupo/updateProjeto') ?>',
        data: {'idgrupo': <?php echo $grupo['id_grupo']; ?>, 'idprojeto': <?php echo $projeto['id_projeto']; ?>, 'nome': $("#nome").val(), 'usuarios': chips},
        success: function(response){
          console.log(response);
          if(response == ""){
            window.location.reload();
          } else {
            $("#texto-erro").html(response);
            $("#error").modal('open');
          }
        }
      });
    });
  </script>

</body>
</html>
