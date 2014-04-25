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

<div class="contabilizado-page">
  <h1 class="titulo">Contabilizar Mês</h1>

  <a id="show-form-banco" href="#">Criar banco ou tipo de poupança</a>

  <div class="add-banco">
    <div class="toggle-banco">
      <form action="bancos/add" class="form-banco" method="post" accept-charset="utf-8">
        <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
        <div class="bloco-form">
          <input type="text" class="form-input" id="nome" placeholder="Nome do banco ou tipo de poupança" required="" name="data[Banco][nome]">
        </div>
        <div class="bloco-form">
          <input type="submit" class="form-input" value="Salvar banco" id="">
        </div>
      </form>
    </div>
  </div>
<?php if (!empty($bancos)) { ?>
  <hr>
  <br>

  <div class="">
    <form  action="contabilizados/add" method="post" accept-charset="utf-8" class="form-conta" >
      <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>




      <h2>Contabilização Mensal</h2>

      <div class="bloco-form conta-inline">
        <input type="text" id="conta-data" value="" name="data[Contabilizado][data]" placeholder="Data" required>
      </div>


      
      <div class="bloco-conta">
        <?php foreach ($bancos as $banco) { ?>
          <div class="bloco-form conta-inline">
            <label for="">
            <?php echo $banco['Bancos']['nome']; ?>
            <?php $id = $banco['Bancos']['id']; ?>
            </label>
            <div class="number-cifra">
                <span class="addon-number">R$</span>
                <input type="number" min="0.00" max="9999.99" step="1" size="4" name="data[BancoConta][<?php echo $id; ?>][valor]" id="valor-<?php echo $id; ?>" placeholder="Valor" required>
                <span class="addon-number">,00</span>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="bloco-form">
        <input type="submit" class="form-input" value="Contabilizar" id="">
      </div>
    </form>
  </div>

<?php } ?>
</div>
<script>
window.onload = function(){
  new datepickr('conta-data', {
    'dateFormat': 'd/m/y'
  });
}
</script>