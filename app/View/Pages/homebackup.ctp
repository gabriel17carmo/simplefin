
<!-- CRIAR RECEITA -->
<h4>Criar Receita</h4>
<?php

    $options = "";
    foreach ($tipoReceitas as $tipoReceita) {
        $options[$tipoReceita['TipoReceita']['id']] = $tipoReceita['TipoReceita']['nome'];
    }


    echo $this->Html->link('Criar tipo de receita', '/tiporeceitas/add');
    echo $this->Form->create('Receita', array(
    'action' => 'add',
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    echo $this->Form->input('tipo_receitas_id', array(
        'options' => $options,
        'empty' => ''
    ));
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('valor', array('label' => 'Valor'));
    echo $this->Form->input('data', array('label' => 'Data', 'type' => 'date'));
    // echo $this->Form->submit('Salvar', array('class' => array('btn', 'btn-info')));
    echo $this->Form->end('Salvar');

?>

<!-- CRIAR DESPESA -->
<h4>Criar Despesa</h4>
<?php

    $options = "";
    foreach ($tipoDespesas as $tipoDespesa) {
        $options[$tipoDespesa['TipoDespesa']['id']] = $tipoDespesa['TipoDespesa']['nome'];
    }


    echo $this->Html->link('Criar tipo de despesa', '/tipodespesas/add', $confirmMessage = "false");

    echo $this->Form->create('Despesa', array(
    'action' => 'add',
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    echo $this->Form->input('tipo_despesas_id', array(
        'options' => $options,
        'empty' => ''
    ));

    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('valor', array('label' => 'Valor'));
    echo $this->Form->input('data', array('label' => 'Data', 'type' => 'date'));
    // echo $this->Form->submit('Salvar', array('class' => array('btn', 'btn-info')));
    echo $this->Form->end('Salvar');
?>


<!-- TABELA RECEITAS -->
<h4>Tabela</h4>
<table class="table table-hover">
    <tr>
      <th>Receitas</th>
      <th>Janeiro</th>
      <th>Fevereiro</th>
      <th>Março</th>
      <th>Abril</th>
      <th>Maio</th>
      <th>Junho</th>
      <th>Julho</th>
      <th>Agosto</th>
      <th>Setembro</th>
      <th>Outubro</th>
      <th>Novembro</th>
      <th>Dezembro</th>
      <th>Total</th>
  </tr>

<?php 
  if (isset($tabelaTipoReceitas) && empty($tabelaTipoReceitas)) {
    echo "<tr><td colspan=\"14\">Registro de receitas vazio.</td></tr>";
  } else {

    foreach ($tabelaTipoReceitas as $tabelaTipoReceita) {
        echo "<tr><td>" . $tabelaTipoReceita['nome'] . "</td>";
        for ($i=1; $i <= 12 ; $i++) { 
            echo "<td>R$ " . $tabelaTipoReceita[$i]['total'] . "</td>";
        }
        echo "<td>R$ " . $tabelaTipoReceita['total'] . "</td></tr>";
    }
    // RECEITAS TOTAIS DO MES
    echo "<tr><td>Total</td>";
    $total = 0;
    for ($i=1; $i <= 12 ; $i++) { 
      $total += $totalMesReceita[$i];
      echo "<td>R$ " . $totalMesReceita[$i] . "</td>";
    }
    echo "<td>R$ " . $total . "</td></tr>";
  }
?>


<!-- TABELA DESPESAS -->
<tr><th colspan="14">Despesas</th></tr>

<?php 
  if (isset($tabelaTipoDespesas) && empty($tabelaTipoDespesas)) {
    echo "<tr><td colspan=\"14\">Registro de despesas vazio.</td></tr>";
  } else {

    foreach ($tabelaTipoDespesas as $tabelaTipoDespesa) {
        echo "<tr><td>" . $tabelaTipoDespesa['nome'] . "</td>";
        for ($i=1; $i <= 12 ; $i++) { 
            echo "<td>R$ " . $tabelaTipoDespesa[$i]['total'] . "</td>";
        }
        echo "<td>R$ " . $tabelaTipoDespesa['total'] . "</td></tr>";
    }
    // DESPESAS TOTAIS DO MES
    echo "<tr><td>Total</td>";
    $total = 0;
    for ($i=1; $i <= 12 ; $i++) { 
      $total += $totalMesDespesa[$i];
      echo "<td>R$ " . $totalMesDespesa[$i] . "</td>";
    }
    echo "<td>R$ " . $total . "</td></tr>";
  }
?>

<!-- CONTAS TOTAIS -->
<tr><th colspan="14">Contabilizações</th></tr>
<?php
    echo "<tr><td>Total</td>";
    $total = 0;
    for ($i=1; $i <= 12 ; $i++) { 
      $valor = $totalMesReceita[$i] - $totalMesDespesa[$i];
      $total += $valor;
      echo "<td>R$ " . $valor . "</td>";
    }
    echo "<td>R$ " . $total . "</td></tr>";
?>

<!-- BANCOS -->
<tr><th colspan="14">Bancos</th></tr>
<?php
  if(!(isset($tabelaBancos) && empty($tabelaBancos))){
    foreach ($tabelaBancos as $tabelaBanco) {
      echo "<tr><td>" . $tabelaBanco['nome'] . "</td>";
      for ($i=1; $i <= 12 ; $i++) { 
        echo "<td>R$ " . $tabelaBanco[$i] . "</td>";
      }
      echo "<td>R$ " . $tabelaBanco['total'] . "</td></tr>";
    }
    // TOTAL CONTABILIZADO POR MES
    echo "<tr><td>Total</td>";
    $total = 0;
    for ($i=1; $i <= 12 ; $i++) { 
      $total += $totalMesContabilizado[$i];
      echo "<td>R$ " . $totalMesContabilizado[$i] . "</td>";
    }
    echo "<td>R$ " . $total . "</td></tr>";
  }

?>

</table>


<!-- CONTABILIZAR UM MÊS -->
<h4>Contabilização mensal</h4>
<?php

    $options = "";
    foreach ($bancos as $banco) {
        $options[$banco['Banco']['id']] = $banco['Banco']['nome'];
    }


    echo $this->Html->link('Criar Banco', '/bancos/add');
    echo $this->Form->create('Contabilizado', array(
    'action' => 'add',
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    echo $this->Form->input('bancos_id', array(
        'options' => $options,
        'empty' => ''
    ));

    echo $this->Form->input('valor', array('label' => 'Valor'));
    echo $this->Form->input('data', array(
    'label' => 'Mês',
    'type' => 'date',
    'dateFormat' => 'M'
));
    // echo $this->Form->submit('Salvar', array('class' => array('btn', 'btn-info')));
    echo $this->Form->end('Salvar');
?>