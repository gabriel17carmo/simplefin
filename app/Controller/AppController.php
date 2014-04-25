<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array('Html','Form', 'Js');

	public $components = array(
		'Session',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Usuario',
					'fields' => array('username' => 'login', 'password' => 'senha')
					)
				),
			'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
      'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login'),
      'loginAction' => array('controller' => 'usuarios', 'action' => 'login'),
      'authorize' => array('Controller')
      )
		);

	public function beforeFilter() {
		$this->Auth->allow('login', 'logout');

		$this->Auth->loginError = __('Usuário e/ou senha incorreto(s)', true);
        $this->Auth->authError = false;
        // $this->Auth->authError = __('Você precisa fazer login para acessar esta página', true);
 

	}

	public function isAuthorized($user) {
	    if (isset($user['grupo']) && $user['grupo'] == 1) {
	        return true; // Admin pode acessar todas actions
	    }
	    return false; // Os outros usuários não podem
	}

  public function montaTabela($modelName, $entityName, $tipoModelName, $tipoEntityName, &$somatorioColunaMes) {

    $this->loadModel($tipoModelName);

    $table = "";

    if($tipoModelName == 'TipoReceita'){
      $vetorTipoModel = $this->TipoReceita->query("
        SELECT *
        FROM " . $tipoEntityName . " AS " . $tipoModelName . "
        WHERE cont > 0
        AND usuario_id = " . $this->Auth->user('id')); 
    }elseif ($tipoModelName == 'TipoDespesa') {
      $vetorTipoModel = $this->TipoDespesa->query("
        SELECT *
        FROM " . $tipoEntityName . " AS " . $tipoModelName . "
        WHERE cont > 0
        AND usuario_id = " . $this->Auth->user('id')); 
    }else {
      die();
    }

      // INICIA OS VALORES COM 0
    for ($i=1; $i <= 12; $i++) {
      $somatorioColunaMes[$i] = 0;
    }

    foreach ($vetorTipoModel as $cadaTipoModel) {

      $table[$cadaTipoModel[$tipoModelName]['nome']]['nome'] = $cadaTipoModel[$tipoModelName]['nome'];
      $table[$cadaTipoModel[$tipoModelName]['nome']]['total'] = 0;

      for ($i=1; $i <= 12; $i++) {
        $query = "
        SELECT " . $modelName . ".*
        FROM " . $entityName . " AS " . $modelName . "
        INNER JOIN " . $tipoEntityName . " AS " . $tipoModelName . "
        ON " . $tipoModelName . ".id = " . $modelName . "." . $tipoEntityName . "_id
        WHERE month(" . $modelName . ".data) = " . $i . "
        AND year(" . $modelName . ".data) = 2014
        AND " . $tipoModelName . ".id = " . $cadaTipoModel[$tipoModelName]['id'] . "
        ORDER BY " . $modelName . ".data ASC";

        if($tipoModelName == 'TipoReceita'){
          $vetorModel = $this->TipoReceita->query($query);
        }elseif ($tipoModelName == 'TipoDespesa') {
          $vetorModel = $this->TipoDespesa->query($query);
        }else {
          die();
        }

        $somatorio = 0;

        foreach ($vetorModel as $mod) {
          $somatorio += $mod[$modelName]['valor'];
        }

        $vetorModel['total'] = $somatorio; // total da celula
        $table[$cadaTipoModel[$tipoModelName]['nome']]['total'] += $somatorio; // total da linha
        $somatorioColunaMes[$i] += $somatorio; // total da coluna

        $table[$cadaTipoModel[$tipoModelName]['nome']][$i] = $vetorModel;

      }
    }
    return $table;
  }

  public function diaSemana($data) {
    $ano =  substr($data, 0, 4);
    $mes =  substr($data, 5, -3);
    $dia =  substr($data, 8, 9);

    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

    switch($diasemana) {
      case"0": $diasemana = "Domingo";       break;
      case"1": $diasemana = "Segunda-Feira"; break;
      case"2": $diasemana = "Terça-Feira";   break;
      case"3": $diasemana = "Quarta-Feira";  break;
      case"4": $diasemana = "Quinta-Feira";  break;
      case"5": $diasemana = "Sexta-Feira";   break;
      case"6": $diasemana = "Sábado";        break;
    }

    return $diasemana;
  }

}
