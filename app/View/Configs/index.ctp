<?php $aut = $this->Session->flash('auth'); ?>
<?php $fla = $this->Session->flash(); ?>

<?php if(!empty($aut)){ ?>
<div class="alert">
  <?php echo $aut; ?>
  <a href="javascript:void(0);" class="fecha">x</a>
</div>
<?php } ?>

<?php if(!empty($fla)){ ?>
<div class="alert">
  <?php echo $fla; ?>
  <a href="javascript:void(0);" class="fecha">x</a>
</div>
<?php } ?>

  <div class="config-page">

  <h1>Configurações</h1>



  <h2>Editar informações próprias</h2>

  <div class="config-editself">
    <?php 
    echo $this->Form->create('Usuario', array(
      'action' => 'edit',
      'class' => 'form-editself',
      'inputDefaults' => array(
        'div' => array('class' => 'bloco-form'),
        'label' => false,
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        )));
    echo $this->Form->input('nome', array('placeholder' => 'Nome'));
    echo $this->Form->input('login', array('placeholder' => 'Login'));
    echo $this->Form->input('email', array('placeholder' => 'E-mail'));
    echo $this->Form->input('grupo', array(
      'options' => array(1 => 'Administrador', 2 => 'Usuário'),
      'empty' => '',
      'default' => 'Usuário'
      ));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(array(
      'label' => 'Salvar',
      'div' => array(
        'class' => 'bloco-form',
        )));
        ?>
      </div>
    </div>