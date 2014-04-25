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
class AddsController extends AppController {
  public $name = 'Adds';
  public $components = array('Session');

  public function isAuthorized($user) {
      return true;
  }

  public function index() {
  	$this->loadModel('Usuario');
  	$this->loadModel('TipoReceita');
    $this->loadModel('TipoDespesa');
    $this->loadModel('Banco');

    $query = "
      SELECT *
      FROM tipo_despesas AS TipoDespesa
      WHERE usuario_id = " . $this->Auth->user('id') . "
      ORDER BY nome ASC
     ";

    $this->set('tipoDespesas', $this->TipoDespesa->query($query));

    $query = "
      SELECT *
      FROM tipo_receitas AS TipoReceita
      WHERE usuario_id = " . $this->Auth->user('id') . "
      ORDER BY nome ASC
     ";

    $this->set('tipoReceitas', $this->TipoReceita->query($query));



  }
}
