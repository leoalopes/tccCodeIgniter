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

        <a href="" class="brand-logo"><i style="margin-left: 2vh; font-size: 5vh !important; transform: rotate(45deg);" class="material-icons">call_received</i><b>Voltar</b></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container row">
    <div class="section">
        <h3 class="center blue-text text-darken-4"><b>Cadastrar reunião</b></h3>

        <div class="row">
            <form>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nome" id="nome" type="text">
                  <label for="nome">Motivo da reunião</label>
                </div>
              </div>
              <div class="row">
                  <div class="col s12 input-field">
                    <input name="usuarios" id="usuarios" type="text" readonly>
                    <label for="usuarios">Usuários envolvidos</label>
                  </div>
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
                  <input name="hora" id="hora" type="time" class="timepicker">
                </div>
              </div>
              <div class="row">
                <div class="left-align"><br>
                  <input type="checkbox" class="filled-in blue" id="filled-in-box" checked="checked" />
                  <label for="filled-in-box">Notificar usuários por e-mail</label>
                </div>
                <div class="right-align"><button class="btn blue darken-4 waves-effect waves-light" type="submit" name="">Cadastrar</button></div>
              </div>
            </form>
        </div>


    </div>
  </div>

  <!--  Scripts-->
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/init.js"></script>

  <script>
    $(document).ready(function() {
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
    default: 'now', // Set default time
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Limpar', // text for clear-button
    canceltext: 'Cancelar', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: false, // make AM PM clickable
    aftershow: function(){ alert('pau no cu do materialize'); } //Function for after opening timepicker
    });
  </script>

</body>
</html>
