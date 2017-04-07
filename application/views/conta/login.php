<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo $title ?></title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>semantic/dist/semantic.min.css">
  <script
  src="<?php echo base_url(); ?>assets/js/jquery-3.2.0.min.js"></script>
  <script src="semantic/dist/semantic.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>

    
    <div class="ui middle aligned center aligned grid" style="height: 100%">
        <div class="six wide column">
            <div class="ui blue header" style="font-size: 5rem"><b>Plataforma</b></div><br><br>
            
            <?php echo form_open('contas/login', 'class="ui form"'); ?>
              <div class="field">
                <label>Nome</label>
                <input type="text" name="nome" id="nome" placeholder="">
              </div>
              <div class="field">
                <label>Senha</label>
                <input type="password" name="senha" id="senha" placeholder="">
              </div><br>
              <button class="ui button" type="submit">Submit</button>
            </form>
            
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
<!--
  <div class="container row">
    <div class="section">
        <h1 class="center blue-text text-darken-4"><b>Plataforma</b></h1><br>       
        
        <div class="row">
            <?php echo form_open('contas/login', array('class' => 'col s12 m6 offset-m3')); ?>
              <div class="row">
                <div class="input-field col s12">
                  <input name="email" id="email" type="email" class="validate">
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input name="senha" id="senha" type="password" class="validate">
                  <label for="password">Senha</label>
                </div>
              </div>
                <span class="col s12 m8 offset-m2"><?php echo validation_errors(); ?></span>  
              <br>
              <div class="center row">
                <button class="btn blue darken-4 waves-effect waves-light" type="submit" name="btnlogar">Entrar</button>
                <span class="col s12 m8 offset-m2" style="margin-top: 5vh">Ainda não possui uma conta? <a href="cadastro">Cadastrar</a></span>
              </div>
            </form>
        </div>
        
        
    </div>
  </div>
-->
    
</body>
</html>