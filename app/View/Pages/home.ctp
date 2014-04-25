<div class="home">
  <?php $userName = $this->Session->read('Auth.User.nome'); ?>
  <h1 class="titulo">Dashboard</h1>

<div class="modo-edicao">
  <span>Modo de edição</span>
  <div class="borda">
    <div class="switch-edit">
      <span class="on">on</span>
      <span class="off">off</span>
    </div>
  </div>
</div>
<div class="clear"></div>


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

  <div class="alert">
    Olá, <?php echo $userName; ?> ! Seja bem vindo(a) !
    <a href="javascript:void(0);" class="fecha">x</a>
  </div>

  <div class="static-cards">
  <?php if (isset($cards) && !empty($cards)) { ?>

    <?php foreach ($cards as $key => $card) { ?>

      <div class="card card-<?php echo $key; ?>">
        <img src="img/<?php echo $card['img']; ?>.png" alt="">
        <br>
        <?php echo $card['texto']; ?>
      </div>

    <?php } ?>
    
  <?php } ?>





  </div>
  <div class="bloco-cards">
    
  </div>
  <div class="bloco-clone-cards">
    
  </div>
</div>