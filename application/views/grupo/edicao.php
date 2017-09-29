<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Editar grupo</title>

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
          <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>" class="breadcrumb"><b>Grupo <?php echo ucfirst($grupo['nome']); ?></b></a>
          <a href="" class="breadcrumb"><b>Edição</b></a>
        </div>
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div><br><br>
  <div class="container row">
    <div class="section">
        <h3 class="center blue-text text-darken-4"><b>Editar grupo</b></h3><br>

        <div class="row">
            <div class="input-field col s12">
              <input name="nome" id="nome" type="text" value="<?php echo $grupo['nome']; ?>">
              <label for="nome">Nome do grupo</label>
            </div>
        </div><br><br>

        <?php
        echo '<table id="userTable" class="highlight">
        <thead>
          <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Administrador</th>
          </tr>
        </thead>
        <tbody>';
        if($usuarios && !empty($usuarios)){
          foreach($usuarios as $usuario){
            echo '<tr>
              <td>'. $usuario['nome'] .'</td>
              <td>'. $usuario['email'] .'</td>
              <td><input type="checkbox" class="filled-in blue valign-wrapper" id="checkbox'. $usuario['id_usuario'] .'" style="position: relative !important; top: 50% !important;" ';
              if($usuario['admin']){
                echo 'checked="checked"';
              }
              echo ' /><label for="checkbox'. $usuario['id_usuario'] .'"></label></td>
            </tr>';
          }
          echo '</tbody>
          </table><br>
          <a id="addBtn" style="cursor: pointer;" class="blue-text text-darken-4">Adicionar usuários</a>';
        } else {
          echo '</tbody></table><br><div style="width: 100% !important" class="center row"><b>Você ainda não possui nenhum usuário adicionado ao grupo.</b> <a id="addBtn" style="cursor: pointer;" class="blue-text text-darken-4">Adicionar usuários</a></div>';
        } ?>
        <br><br><div class="right row">
          <a class="btn blue darken-4 waves-effect waves-light" id="doc-update">Salvar</a>
        </div>
    </div>
  </div>

  <div id="adduser" class="modal" style="width: 80% !important; height: 85% !important">
    <div class="modal-content">
      <h5 class="blue-text text-darken-4" style="font-size: 20px !important"><b>Adicionar usuários</b></h5>
      <div class="row">
        <div class="input-field col s10 m11">
          <input id="search" value="E-mail" type="text">
        </div>
        <a id="search-btn" class="black-text" style="cursor: pointer"><i class="material-icons" style="margin-top: 3%">search</i></a>
      </div>
      <div class="row">
        <div id="notfound" class="col s12 m12 center-align red-text text-lighten-1"></div>
        <div id="results" class="col s10 m10" style="margin-left: 2vh; margin-top: -5vh"></div>
      </div>
    </div>
    <div class="modal-footer" style="width: 95%; position: absolute !important; top:85%; left: 5%; text-align: left !important">
      <div id="selecteds" class="chips col s12 m12" style="display: none;"></div>
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
  <script src="<?php echo base_url(); ?>/assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/init.js"></script>

  <script>
    var chips = [];

    <?php
    if($usuarios && !empty($usuarios)){
      foreach ($usuarios as $usuario) {
        echo 'var chip = {
          tag: "'. $usuario['email'] .'",
          id: '. $usuario['id_usuario'] .'
        };
        chips.push(chip);
        console.log(chips);';
      }
    }
    ?>

    if(chips.length == 0){
      $("#userTable").css('display', 'none');
    }

    $('.chips').material_chip();

    $("#addBtn").click(function(){
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
            if(resultado.length > 3){
              $("#results").empty();
              $("#notfound").empty();
              $("#notfound").append('<span>Não foi possível buscar usuários. Tente ser mais específico.</span><br><br>');
            } else {
              $("#notfound").empty();
              $("#results").empty();
              $("#selecteds").css('display', 'inline');
              $("#results").append('<br><table><tbody>');
              resultado.forEach(function(user){
                var alreadyadded = false;
                chips.forEach(function(c, index){
                  if(c.tag == user.email)
                    alreadyadded = true;
                });
                if(!alreadyadded)
                  $("#results").append('<tr><td><a class="black-text found-user" style="cursor: pointer" data-email="'+ user.email +'" data-id="'+ user.id_usuario +'"><i class="material-icons" style="vertical-align: middle !important">add</i></a> '+ user.email +'</td></tr><div class="divider">');
                else
                  $("#results").append('<tr><td><a class="black-text found-user" style="cursor: pointer" data-email="'+ user.email +'" data-id="'+ user.id_usuario +'"><i class="material-icons" style="vertical-align: middle !important">done</i></a> '+ user.email +'</td></tr><div class="divider">');
              });
              $("#results").append('</tbody></table><br><br>');
            }
          } else {
            $("#results").empty();
            $("#notfound").empty();
            $("#notfound").append('<span>Nada encontrado.</span><br><br>');
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
      $(this).children().text('done');
    });

    $('.chips').on('chip.delete', function(e, chip){
      var index = chips.indexOf(chip);
      if(index != -1)
        chips.splice(index, 1);
      $('td').filter(':contains("'+ chip.tag +'")').parent().children().children().children().text('add');
    });

    $('#btn-salvar').click(function(e){
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('grupo/alteracoes') ?>',
        data: {'nome': $("#nome").val(), 'usuarios': chips},
        success: function(response){
          console.log(typeof response);
          if(response == ""){
            window.location.href = '<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>';
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
