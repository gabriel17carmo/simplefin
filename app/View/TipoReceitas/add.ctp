<!-- File: /app/View/Posts/add.ctp -->

<h2>Criar Tipo de Receita</h2>
<?php
    echo $this->Form->create('TipoReceita');
    echo $this->Form->input('nome');
    echo $this->Form->end('Salvar');