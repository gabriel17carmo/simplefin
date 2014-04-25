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

<div class="add-page">

  <h1 class="titulo">Realizar Lançamentos</h1>
  
  <a id="show-form-tipo-receita" href="#">Criar receita</a>
  <a id="show-form-tipo-despesa" href="#">Criar despesa</a>


  <div class="add-tipo-receita">
    <div class="toggle-receita">
      <form method="post" action="tipo_receitas/add" class="form-tipo-receita" accept-charset="utf-8">
        <input type="hidden" name="_method" value="POST">
        <div class="bloco-form">
          <input type="text" class="form-input" id="nome" placeholder="Nome da receita" required="" name="data[TipoReceita][nome]">
        </div>
        <div class="bloco-form">
          <input type="submit" class="form-input" value="Salvar receita" id="" required>
        </div>
      </form>
    </div>
  </div>

  <div class="add-tipo-despesa">
    <div class="toggle-despesa">
      <form method="post" action="tipo_despesas/add" class="form-tipo-despesa" accept-charset="utf-8">
        <input type="hidden" name="_method" value="POST">
        <div class="bloco-form">
          <input type="text" class="form-input" id="nome" placeholder="Nome da despesa" required="" name="data[TipoDespesa][nome]" required>
        </div>
        <div class="bloco-form">
          <input type="submit" class="form-input" value="Salvar despesa" id="">
        </div>
      </form>
    </div>
  </div>

  <div class="add-despesa">
    <hr>
    <br>
    
    <div class="">
      <form method="post" action="receitas/add" class="form-fin form-receita" accept-charset="utf-8">
        <input type="hidden" name="_method" value="POST">
        <div class="form-receita-bloco">
          <h2>Lançamento de receita</h2>
          <div class="bloco-form">
            <select id="select-form-receita" name="data[Receita][tipo_receitas_id]" class="" size="5" required>
              <option value="" selected>Escolha um tipo de receita</option>
              <?php foreach ($tipoReceitas as $tipoReceita) { ?>
                <option value="<?php echo $tipoReceita['TipoReceita']['id'] ?>"><?php echo $tipoReceita['TipoReceita']['nome'] ?></option>

              <?php } ?>
            </select>
          </div>
          <div class="bloco-form">
            <input type="text" name="data[Receita][descricao]" id="receita-desc" placeholder="Descrição" required>
          </div>
          <div class="bloco-form receita-inline">
            <div class="number-cifra">
                <span class="addon-number">R$</span>
                <input type="number" min="0.00" step="1" size="4" name="data[Receita][valor]" id="receita-val" placeholder="Valor" required>
                <span class="addon-number">,00</span>
            </div>
          </div>
          <div class="bloco-form receita-inline input-data">
            <input type="text" id="receita-data" value="" name="data[Receita][data]" placeholder="Data" required>
          </div>
        <div class="bloco-form">
          <input type="submit" class="form-input" value="Lançar receita" id="">
        </div>
        </div>
      </form>
      <form method="post" action="despesas/add" accept-charset="utf-8" class="form-fin form-despesa">
        <h2>Lançamento de despesa</h2>
        <div class="form-despesa-bloco">
          
          <div class="bloco-form">
            <select id="select-form-despesa" name="data[Despesa][tipo_despesas_id]" class="" size="5" required>
              <option value="" selected>Escolha um tipo de despesa</option>
              <?php foreach ($tipoDespesas as $tipoDespesa) { ?>
                <option value="<?php echo $tipoDespesa['TipoDespesa']['id'] ?>"><?php echo $tipoDespesa['TipoDespesa']['nome'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="bloco-form">
            <input type="text" name="data[Despesa][descricao]" id="despesa-desc" placeholder="Descrição" required>
          </div>
          <div class="bloco-form despesa-inline">
            <div class="number-cifra">
                <span class="addon-number">R$</span>
                <input type="number" min="0.00" step="1" size="4" name="data[Despesa][valor]" id="despesa-val" placeholder="Valor" required>
                <span class="addon-number">,00</span>
            </div>
          </div>
          <div class="bloco-form despesa-inline input-data">
            <input type="text" id="despesa-data" name="data[Despesa][data]" placeholder="Data" required>
          </div>
        <div class="bloco-form">
          <input type="submit" class="form-input" value="Lançar despesa" id="">
        </div>  
        </div>
      </form>


    </div>

  </div>
</div>

<script>
window.onload = function(){
  new datepickr('despesa-data', {
    'dateFormat': 'd/m/y'
  });
  new datepickr('receita-data', {
    'dateFormat': 'd/m/y'
  });
}
</script>