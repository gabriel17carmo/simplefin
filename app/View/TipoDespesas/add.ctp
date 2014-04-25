<!-- File: /app/View/Posts/add.ctp -->

<h2>Criar Tipo de Despesa</h2>
<?php
    echo $this->Form->create('TipoDespesa');
    echo $this->Form->input('nome');
    echo $this->Form->end('Salvar');