<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Cadastrar reuniao</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
</head>
<body>
  <ul id="user_dropdown" class="dropdown-content blue darken-4">
      <li><a href="" class="white-text drop-item">Editar perfil</a></li>
      <li><a href="<?php echo base_url("conta/logout"); ?>" class="white-text drop-item">Sair</a></li>
  </ul>

  <ul id="slide-out" class="side-nav fixed z-depth-2">
    <li><div class="userView">
      <img class="circle" src="<?php echo base_url("assets/default-avatar.png"); ?>">
      <span class="name"><?php echo $session['nome'] ?></span>
      <span class="email"><?php echo $session['email'] ?></span>
    </div></li>
    <?php
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
    ?>
  </ul>

  <?php
    echo '<div id="excluirGrupo" class="modal">
        <div class="modal-content">
            <h4 class="blue-text text-darken-4">Tem certeza?</h4><br>Desejar excluir esse grupo PERMANENTEMENTE?
        </div>
        <div class="modal-footer">
          <a id="delGrupo" class="modal-action modal-close blue-text text-darken-4 btn-flat">SIM</a>
        </div>
    </div>';
  ?>

  <?php
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
  ?>

  <div class="navbar-fixed">
    <nav class="row">
      <div class="nav-wrapper blue darken-4 white-text">
        <a href="" data-activates="slide-out" class="button-collapse hide-on-large-only menu-icon"><i class="material-icons">menu</i></a>
        <div class="brand-logo">
          <a href="<?php echo base_url("home"); ?>" class="breadcrumb" style="margin-left: 2vh"><i class="material-icons hide-on-med-and-down">home</i><b>Home</b></a>
          <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>" class="breadcrumb"><b>Grupo <?php echo ucfirst($grupo['nome']); ?></b></a>
          <a href="" class="breadcrumb"><b>Cadastrar reunião</b></a>
        </div>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>


  <div class="container row">
    <div class="section">
        <br><br><h3 class="center blue-text text-darken-4"><b>Cadastrar reunião</b></h3>

        <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="motivo" name="motivo" class="materialize-textarea"></textarea>
                  <label for="motivo">Motivo da reunião</label>
                </div>
              </div>
              <div class="row">
                <div class="col s6 m6 input-field">
                  <i class="material-icons prefix">today</i>
                  <input name="data" id="data" type="date" class="datepicker">
                  <label for="data">Data</label>
                </div>
                <div class="col s6 m6 input-field">
                  <i class="material-icons prefix">query_builder</i>
                  <input name="hora" id="hora" type="time" class="timepicker" value="<?php echo date('H:i'); ?>">
                </div>
              </div><br>
              <div class="row">
                <div class="left-align" style="margin-left: 2vh"><br>
                  <input type="checkbox" class="filled-in blue" id="checkbox" checked="checked" />
                  <label for="checkbox" class="black-text">Notificar usuários por e-mail</label>
                </div><br><br>
                <div class="right-align" style="margin-right: 2vh"><a class="btn blue darken-4 waves-effect waves-light" id="cadastrar">Cadastrar</a></div>
              </div>
        </div>

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
    $(document).ready(function(){
      $('.modal').modal();
    });

    $("#cadastrar").click(function(e){
      e.preventDefault();

      var data = $('#data').pickadate('picker').get('highlight', 'yyyy') + '-' + $('#data').pickadate('picker').get('highlight', 'mm') + '-' + $('#data').pickadate('picker').get('highlight', 'dd');
      data += ' ' + $('#hora').val() + ':00';
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('reuniao/cadastro'); ?>',
        data: {'idgrupo': <?php echo $grupo['id_grupo']; ?>, 'motivo': $('#motivo').val(), 'data': data, 'notificar': $("#checkbox").is(':checked')},
        success: function(response){
          console.log(response);
          if(response == ''){
            window.location.href = '<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>';
          } else {
            $("#texto-erro").html(response);
            $("#error").modal('open');
          }
        }
      });
    });


    $(document).ready(function() {
      $("#data").pickadate('picker').set('select', '<?php echo date('Y-m-d'); ?>', { format: 'yyyy-mm-dd' });
      setTimeout(function() {
        Materialize.updateTextFields();
      }, 1000);
    });

    $('.datepicker').pickadate({
    monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    today: false,
    clear: 'Limpar',
    close: 'Pronto',
    labelMonthNext: 'Próximo mês',
    labelMonthPrev: 'Mês anterior',
    labelMonthSelect: 'Selecione um mês',
    labelYearSelect: 'Selecione um ano',
    selectMonths: true,
    selectYears: 3
    });

    $('.timepicker').pickatime({
    default: '<?php echo date('H:i'); ?>', // Set default time
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Limpar', // text for clear-button
    canceltext: 'Cancelar', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: false // make AM PM clickable
    });
  </script>

</body>
</html>
