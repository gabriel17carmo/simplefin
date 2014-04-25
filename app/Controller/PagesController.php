<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
  public $name = 'Pages';
  public $components = array('Session');

  public function isAuthorized($user) {
      return true;
  }

  public function index() {
    $this->loadModel('Contabilizado');
    $this->loadModel('Receita');
    $this->loadModel('Despesa');

    $cards = "";

    $ultimaConta = $this->Contabilizado->query("
      SELECT * 
      FROM contabilizados AS Contabilizado
      INNER JOIN banco_contas AS BancoConta
      ON Contabilizado.id = BancoConta.contabilizados_id
      WHERE BancoConta.bancos_usuario_id = " . $this->Auth->user('id') . "
      ORDER BY Contabilizado.data DESC
      LIMIT 1
    ");
    if(empty($ultimaConta)){
      $this->render('home');
      return;
    }

    $ultimaConta = $ultimaConta[0];

    $receitas = $this->Receita->query("
      SELECT * 
      FROM receitas AS Receita
      INNER JOIN tipo_receitas AS TipoReceita
      ON Receita.tipo_receitas_id = TipoReceita.id
      WHERE TipoReceita.usuario_id = " . $this->Auth->user('id') . "
      AND Receita.data > '" . $ultimaConta['Contabilizado']['data'] . "'"
    );

    $despesas = $this->Despesa->query("
      SELECT * 
      FROM despesas AS Despesa
      INNER JOIN tipo_despesas AS TipoDespesa
      ON Despesa.tipo_despesas_id = TipoDespesa.id
      WHERE TipoDespesa.usuario_id = " . $this->Auth->user('id') . "
      AND Despesa.data > '" . $ultimaConta['Contabilizado']['data'] . "'"
    );

    $valorTotal = $ultimaConta['Contabilizado']['valor'];
    foreach ($receitas as $receita) {
      $valorTotal += $receita['Receita']['valor'];
    }
    foreach ($despesas as $despesa) {
      $valorTotal -= $despesa['Despesa']['valor'];
    }


    $cards[0]['texto'] = "Patrimônio<br>R$ " . $valorTotal . ",00";
    $cards[0]['img'] = 'i1';


    $this->set('cards', $cards);

    $this->render('home');

  }

}