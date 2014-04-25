<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$title = "Simplefin - Sistema simples de gerenciamento financeiro";
?>
<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title><?php echo $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
  <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('style'); 
    echo $this->Html->css('datepickr');

  ?>
</head>
<body onLoad="setTimeout(function() {window.scrollTo(0, 1)}, 100);">
<div>
  <div class="header">

    <?php echo $this->Html->link(
        '
        <div class="logo">Simplefin</div>
        ',
        array(
          'controller' => 'pages',
          'action' => 'index'
        ),
        array(
          'escape' => false
        )
    );?>
    

    <?php 
    if ( ($this->params['controller'] == 'receitas' && $this->params['action'] == 'index') 
      || ($this->params['controller'] == 'despesas' && $this->params['action'] == 'index') ) { ?>
      <div class="meses-header">
        <table class="tab-header">
          <tr class="tab-header-cab">
            <th class="tab-header-cell tab-tipo"></th>
            <th class="tab-header-cell">Jan</th>
            <th class="tab-header-cell">Fev</th>
            <th class="tab-header-cell">Mar</th>
            <th class="tab-header-cell">Abr</th>
            <th class="tab-header-cell">Mai</th>
            <th class="tab-header-cell">Jun</th>
            <th class="tab-header-cell">Jul</th>
            <th class="tab-header-cell">Ago</th>
            <th class="tab-header-cell">Set</th>
            <th class="tab-header-cell">Out</th>
            <th class="tab-header-cell">Nov</th>
            <th class="tab-header-cell">Dez</th>
            <th class="tab-header-cell"></th>
          </tr>
        </table>
      </div>
    <?php } ?>

    <?php
    if($this->params['controller'] != 'usuarios' || $this->params['action'] != 'login'){
      echo $this->Html->link(
        '
        <div class="logout">
          <div class="img-logout" title="Sair"></div>
        </div>
        ',
        array(
          'controller' => 'usuarios',
          'action' => 'logout'
        ),
        array(
          'class' => 'link-logout',
          'escape' => false
        )
      );
    }
    ?>

  </div> <!-- FIM DO HEADER -->

<?php
  if($this->params['action'] != 'login') {
    echo $this->element('menu');
  }
?>

  <div class="container">

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>

  </div>
  <footer class="footer"></footer>
</div>

<!-- <?php echo $this->element('sql_dump');?> -->
<?php
    echo $this->Html->script(array('jquery-1.11.0.min', 'datepickr', 'header', 'add', 'scripts', 'jquery-ui.min', 'banco'));
    echo $this->Js->writeBuffer();
?>
</body>
</html>