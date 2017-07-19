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
      <li><a href="<?php echo base_url('conta/logout'); ?>" class="white-text drop-item">Sair</a></li>
  </ul>

  <div class="navbar-fixed">
    <nav class="row">
      <div class="nav-wrapper blue darken-4 white-text">

        <a href="<?php echo base_url() . explode('@', $session['email'])[0]; ?>" class="brand-logo"><i style="margin-left: 2vh; font-size: 5vh !important;" class="material-icons">keyboard_backspace</i><b>Voltar</b></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container row">
    <div class="section">
        <h3 class="center blue-text text-darken-4"><b>Criar grupo</b></h3><br>

        <div class="row">
            <form>
              <div class="row">
                <div class="input-field col s12">
                  <input name="nome" id="nome" type="text">
                  <label for="nome">Nome do grupo</label>
                </div>
              </div>
              <div class="row">
                  <div class="col s12 input-field">
                    <input name="usuarios" id="usuarios" type="text" readonly>
                    <label for="usuarios">Adicionar usuários</label>
                  </div>
                </div>
              </div>
              <br>
              <div class="right-align row">
                <button class="btn blue darken-4 waves-effect waves-light" type="submit" name="">Criar</button>
              </div>
            </form>
        </div>


    </div>
  </div>

  <div id="adduser" class="modal" style="width: 80% !important; height: 80% !important">
    <div class="modal-content">
      <h5 class="blue-text text-darken-4" style="font-size: 20px !important"><b>Adicionar usuários</b></h5>
      <div class="row">
        <div class="input-field col s10 m11">
          <input id="search" value="E-mail" type="text">
        </div>
        <a id="search-btn" class="black-text" style="cursor: pointer"><i class="material-icons" style="margin-top: 4%">search</i></a>
      </div>
      <div class="row">
        <div id="notfound" class="col s12 m12 center-align red-text text-lighten-1"></div>
        <div id="results" class="col s10 m10" style="margin-left: 2vh; margin-top: -5vh"></div>
        <div id="selecteds" class="chips col s12 m12" style="display: none;"></div>
      </div>
    </div>
  </div>

  <!--  Scripts-->
  <script src="<?php echo base_url(); ?>/assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/init.js"></script>

  <script>
    var chips = [];

    $('.chips').material_chip();

    $("#usuarios").focus(function(){
      $("#adduser").modal('open', {
        complete: function(){
          var string = "";
          chips.forEach(function(chip, index){
            if(index == 0)
              string += chip.tag;
            else
              string += ', ' + chip.tag;
          });
          $("#usuarios").val(string);
          if(string == "")
            $("label[for=usuarios]").css('display', 'inline');
          else
            $("label[for=usuarios]").css('display', 'none');
          Materialize.updateTextFields();
        }
      });
    });

    $("#search-btn").click(function(e){
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('usuarios/search') ?>',
        data: {'email': $("#search").val()},
        success: function(results){
          var resultado = $.parseJSON(results);
          if(resultado.length != 0){
            $("#notfound").empty();
            $("#results").empty();
            $("#selecteds").css('display', 'inline');
            $("#results").append('<br><table><tbody>');
            resultado.forEach(function(user){
              $("#results").append('<tr><td style="border-bottom: 1px solid #E0E0E0 !important"><a class="black-text found-user" style="cursor: pointer" data-email="'+ user.email +'" data-id="'+ user.id_usuario +'"><i class="material-icons" style="vertical-align: middle !important">add_circle</i></a> '+ user.email +'</td></tr><div class="divider">');
            });
            $("#results").append('</tbody></table><br><br>');
          } else {
            $("#results").empty();
            $("#notfound").empty();
            $("#notfound").append('<span>Nada encontrado</span><br><br>');
          }
        }
      });
    });

    $("#results").on('click', '.found-user', function(){
      var chip = {
        tag: $(this).data("email"),
        id: $(this).data("id")
      };
      var alreadyadded = false;
      chips.forEach(function(c, index){
        if(c.tag == chip.tag)
          alreadyadded = true;
      });
      if(!alreadyadded){
        chips.push(chip);
        $('.chips').material_chip({
          data: chips,
        });
      }
      $(this).parent().remove();
    });

    $('.chips').on('chip.delete', function(e, chip){
      var index = chips.indexOf(chip);
      if(index != -1)
        chips.splice(index, 1);
    });
  </script>

</body>
</html>
