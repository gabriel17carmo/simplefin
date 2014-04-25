  <div class="nav">
    <ul class="ul-nav">



      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='pages') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Dashboard',
            array(
              'controller' => 'pages',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-home',
              'class' => 'menu-item-link',
              'escape' => false
            )
        );?>
      </li>


      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='receitas') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Receitas',
            array(
              'controller' => 'receitas',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-receitas',
              'class' => array('menu-item-link', 'fundo-escuro'),
              'escape' => false
            )
        );?>
      </li>


      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='despesas') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Despesas',
            array(
              'controller' => 'despesas',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-despesas',
              'class' => 'menu-item-link',
              'escape' => false
            )
        );?>
      </li>


      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='adds') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Realizar<br>Lançamentos',
            array(
              'controller' => 'adds',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-add-receita',
              'class' => array('menu-item-link', 'fundo-escuro'),
              'escape' => false
            )
        );?>
      </li>


      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='contabilizados') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Contabilização<br>Patrimonial',
            array(
              'controller' => 'contabilizados',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-conta',
              'class' => 'menu-item-link',
              'escape' => false
            )
        );?>
      </li>


      <li class="menu-item <?php echo (!empty($this->params['controller']) && ($this->params['controller']=='configs') )?'is-active' :'' ?>">
        <?php echo $this->Html->link(
            '<div class="menu-icone"></div><br>Configurações',
            array(
              'controller' => 'configs',
              'action' => 'index'
            ),
            array(
              'id' => 'icone-config',
              'class' => array('menu-item-link', 'fundo-escuro'),
              'escape' => false
            )
        );?>
      </li>


    </ul>
  </div>