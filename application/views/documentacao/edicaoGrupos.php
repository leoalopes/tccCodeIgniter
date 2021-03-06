<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo ucfirst($documento['titulo']) . ' - Editar'; ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/submit.js"></script>
  <link href="<?php echo base_url(); ?>assets/highlight/styles/default.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/highlight/highlight.pack.js"></script>
  <script src="<?php echo base_url(); ?>assets/quill/quill.js"></script>
  <script src="<?php echo base_url(); ?>assets/quill/quill.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/quill/quill.snow.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/quill/quill.bubble.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.6.0/katex.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
</head>
<body>

<ul id="user_dropdown" class="dropdown-content blue darken-4">
    <li><a href="" class="white-text drop-item">Editar perfil</a></li>
    <li><a href="<?php echo base_url('conta/logout'); ?>" class="white-text drop-item">Sair</a></li>
</ul>

<div class="navbar-fixed">
  <nav class="row">
    <div class="nav-wrapper blue darken-4 white-text">
      <div class="brand-logo">
        <a href="<?php echo base_url("home"); ?>" class="breadcrumb" style="margin-left: 2vh"><i class="material-icons hide-on-med-and-down">home</i><b>Home</b></a>
        <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']); ?>" class="breadcrumb"><b>Grupo <?php echo ucfirst($grupo['nome']); ?></b></a>
        <a href="<?php echo base_url("$id/grupo/".$grupo['id_grupo']."/projeto"."/".$projeto['nome']); ?>" class="breadcrumb"><b><?php echo ucfirst($projeto['nome']); ?></b></a>
        <a href="" class="breadcrumb"><b><?php echo ucfirst($documento['titulo']); ?> - Edição</b></a>
      </div>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="" data-activates="user_dropdown" data-belowOrigin="true"><?php echo $session['nome'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>

<div class="row" style="margin-top: 1vh">
  <div class="col s10 m10 offset-m1 offset-s1">
    <form>
      <div class="row">
        <div class="input-field">
          <input name="titulo" id="titulo" type="text">
          <label for="titulo">Titulo</label>
          <div class="row" id="quill-container">
            <div id="editor" style="height: 55vh; display: none"><?php echo $documento['conteudo']; ?></div>
            <div style="height: 55vh" id="loader">
              <div class="preloader-wrapper big active" style="margin-left: 50%; margin-top: 27vh">
                <div class="spinner-layer spinner-blue-only">
                  <div class="circle-clipper left">
                    <div class="circle"></div>
                  </div><div class="gap-patch">
                    <div class="circle"></div>
                  </div><div class="circle-clipper right">
                    <div class="circle"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="right row">
        <a class="btn blue darken-4 waves-effect waves-light" id="doc-update">Salvar</a>
      </div>
    </form>
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

<script>
var quill;
$(document).ready(function(e){
  var toolbarOptions = [
    [{ 'font': [] }],
    [{ 'align': [] }],
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['code-block'],
    ['image', 'link'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction
    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    ['clean']                                         // remove formatting button
  ];

  quill = new Quill('#editor', {
    modules: {
      syntax: true,
      toolbar: toolbarOptions
    },
    theme: 'snow'
  });

  $("#titulo").val("<?php echo $documento['titulo']; ?>");
  $("#loader").remove();
  $("#editor").css("display", "block");
});

$("#doc-update").click(function(e){
  e.preventDefault();
  //alert(quill.container.firstChild.innerHTML);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url('documento/form_edicao') ?>',
    data: {'titulo': $("#titulo").val(), 'conteudo': quill.container.firstChild.innerHTML, 'iddoc': '<?php echo $documento['id_documentacao']; ?>'},
    success: function(response){
      console.log(response);
      if(response == ""){
        window.location.href = '<?php echo base_url("$id/grupo/".$grupo['id_grupo']."/projeto"."/".$projeto['nome']); ?>';
      } else {
        $("#texto-erro").html(response);
        $("#error").modal('open');
      }
    }
  });
});
</script>

</body>
