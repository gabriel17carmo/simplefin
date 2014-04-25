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
    <div class="card card-01">
      1
    </div>
    <div class="card card-02">
      2
    </div>
    <div class="card card-03">
      3
    </div>
    <div class="card card-04">
      4
    </div>
    <div class="card card-05">
      5
    </div>
    <div class="card card-06">
      6
    </div>
    <div class="card card-07">
      7
    </div>
    <div class="card card-08">
      8
    </div>
    <div class="card card-09">
      9
    </div>
    <div class="card card-10">
      10
    </div>
  </div>
  <div class="bloco-cards">
    
  </div>
  <div class="bloco-clone-cards">
    
  </div>
</div>