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

<?php if(!empty($ultimaReceita)){ ?>
<div class="alert">
  <?php echo 'Última atualização de receitas: ' . $ultimaReceita; ?>
  <a href="javascript:void(0);" class="fecha">x</a>
</div>
<?php } ?>

<h1 class="titulo">Receitas</h1>

<table class="tab-receitas tab-fin">
  <tr class="tab-cab">
    <th class="tab-cab-cell tab-tipo">Tipo</th>
    <th class="tab-cab-cell "><span class="th-header">Jan</span></th>
    <th class="tab-cab-cell "><span class="th-header">Fev</span></th>
    <th class="tab-cab-cell "><span class="th-header">Mar</span></th>
    <th class="tab-cab-cell "><span class="th-header">Abr</span></th>
    <th class="tab-cab-cell "><span class="th-header">Mai</span></th>
    <th class="tab-cab-cell "><span class="th-header">Jun</span></th>
    <th class="tab-cab-cell "><span class="th-header">Jul</span></th>
    <th class="tab-cab-cell "><span class="th-header">Ago</span></th>
    <th class="tab-cab-cell "><span class="th-header">Set</span></th>
    <th class="tab-cab-cell "><span class="th-header">Out</span></th>
    <th class="tab-cab-cell "><span class="th-header">Nov</span></th>
    <th class="tab-cab-cell "><span class="th-header">Dez</span></th>
    <th class="tab-cab-cell ">Total</th>
  </tr>

  <?php 
  if (isset($tabelaTipoReceitas) && empty($tabelaTipoReceitas)) {
    echo "<tr><td colspan=\"14\">Registro de receitas vazio.</td></tr>";
  } else {

    sort($tabelaTipoReceitas);

    foreach ($tabelaTipoReceitas as $tabelaTipoReceita) { ?>
      <tr class="tab-rec-linha">
        <td class="tab-rec-cell tab-font-preta">
          <?php echo $tabelaTipoReceita['nome']; ?>
        </td>
    <?php for ($i=1; $i <= 12 ; $i++) { ?>
      <td class="tab-rec-cell">
        R$ <?php echo $tabelaTipoReceita[$i]['total']; ?>
      </td>
    <?php } ?>
      <td class="tab-rec-cell tab-rec-total">
        R$ <?php echo $tabelaTipoReceita['total']; ?>
      </td>
  <?php } ?>

 <!--  RECEITAS TOTAIS DO MES -->
  <tr class="tab-rec-linha">
    <td class="tab-rec-cell tab-font-preta tab-rec-total">Total</td>
  <?php $total = 0;
  for ($i=1; $i <= 12 ; $i++) { 
    $total += $totalMesReceita[$i]; ?>
    <td class="tab-rec-cell tab-rec-total">
      R$ <?php echo $totalMesReceita[$i]; ?>
    </td>
  <?php } ?>
  <td class="tab-rec-cell tab-rec-total">
    R$ <?php echo $total; ?>
  </td>
<?php } ?>
</table>