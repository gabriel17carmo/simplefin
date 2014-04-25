<div class="centraliza page-login">
  <h1 class="titulo">Sistema simples de gerenciamento financeiro</h1>

  <?php echo $this->Session->flash('auth') ?>
  <?php echo $this->Session->flash() ?>


      
  <?php echo $this->Form->create('Usuario', array(
      'action' => 'login',
      'class' => 'form-login',
      'inputDefaults' => array(
          'div' => array('class' => 'bloco-form'),
          'label' => false,
          'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
      ))); ?>
  <?php echo $this->Form->input('login', array('placeholder' => 'Digite seu login')) ?>
  <?php echo $this->Form->input('senha', array('type' => 'password', 'placeholder' => 'Digite sua senha')) ?>
  <?php echo $this->Form->submit('Entrar');
  ?>
</div>