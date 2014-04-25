<!-- File: /app/View/Posts/add.ctp -->

<h4>Criar Usuário</h4>
<?php
    echo $this->Form->create('Usuario', array(
    'action' => 'add',
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    echo $this->Form->input('nome');
    echo $this->Form->input('login');
    echo $this->Form->input('senha', array('type' => 'password'));
    echo $this->Form->input('email');
    echo $this->Form->input('grupo', array(
	    'options' => array(1 => 'Administrador', 2 => 'Usuário'),
	    'empty' => '',
	    'default' => 'Usuário'
	));
    echo $this->Form->submit('Salvar', array('class' => array('btn', 'btn-info')));