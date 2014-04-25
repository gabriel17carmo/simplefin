<!-- File: /app/View/Posts/add.ctp -->

<h2>Criar Banco</h2>
<?php
    echo $this->Form->create('Banco');
    echo $this->Form->input('nome');
    echo $this->Form->end('Salvar');