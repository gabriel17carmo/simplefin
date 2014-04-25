<?php

class ContabilizadosController extends AppController {
    public $name = 'Contabilizados';
    public $components = array('Session');

	public function isAuthorized($user) {
	 	return true;
	}

  public function index() {
    $this->loadModel('Bancos');
    
    $this->set('bancos', $this->Bancos->find('all', array(
      'conditions' => array(
        'Bancos.usuario_id' => $this->Auth->user('id')
      )
    )));

    
  }

  //adiciona o contabilizado e também os relacionamentos bancoconta
  public function add() {

    if ($this->request->is('post')) {
      $this->loadModel('BancoConta');


      $data = $this->request->data['Contabilizado']['data'];

      $data = explode("/", $data);

      list($day, $month, $year) = $data;

      $this->request->data['Contabilizado']['data'] = $year . "-" . $month . "-" . $day;

      // Contabilizado
      $valorTotal = 0;
      foreach ($this->request->data['BancoConta'] as $bancoConta) {
        $valorTotal += $bancoConta['valor'];
      }
      $this->request->data['Contabilizado']['valor'] = $valorTotal;
      $dadosContabilizado['Contabilizado'] = $this->request->data['Contabilizado'];

      if(!$this->Contabilizado->save($dadosContabilizado)){
        $this->Session->setFlash("Erro na contabilização ! Não foi possível salvar 'Contabilizado'.");
        $this->redirect(array('controller' => 'contabilizados', 'action' => 'index'));
      }

      // BancoConta
      foreach ($this->request->data['BancoConta'] as $id => $bancoConta) {

        $dadosBancoConta['BancoConta']['valor'] = $bancoConta['valor'];
        $dadosBancoConta['BancoConta']['bancos_id'] = $id;
        $dadosBancoConta['BancoConta']['bancos_usuario_id'] = $this->Auth->user('id');
        $dadosBancoConta['BancoConta']['contabilizados_id'] = $this->Contabilizado->id;

        if(!$this->BancoConta->save($dadosBancoConta)){
          $this->Session->setFlash("Erro na contabilização ! Não foi possível salvar 'BancoConta'.");
          $this->redirect(array('controller' => 'contabilizados', 'action' => 'index'));
        }
      }

      $this->Session->setFlash('Contabilização criada com sucesso !');
      $this->redirect(array('controller' => 'contabilizados', 'action' => 'index'));


    }


      



  }

    // public function add() {

    //     if ($this->request->is('post')) {

    //     	$month = $this->request->data['Contabilizado']['data']['month'];

    //     	$this->request->data['Contabilizado']['data'] = "2014-" . $month . "-01";
    //     	$this->request->data['Contabilizado']['bancos_usuario_id'] = $this->Auth->user('id');
   
    //         if ($this->Contabilizado->save($this->request->data)) {
    //             $this->Session->setFlash('A contabilização foi realizada com sucesso !!');
    //             $this->redirect(array('controller' => 'pages', 'action' => 'index'));
    //         } else {
    //         	// $this->Session->setFlash($this->request->data['Contabilizado']['data']);
    //         	$this->redirect(array('controller' => 'pages', 'action' => 'index'));
    //         }
    //     }
    // }

	// public function edit($id = null) {
	//     $this->ContabilizadoMensal->id = $id;
	//     if ($this->request->is('get')) {
	//         $this->request->data = $this->ContabilizadoMensal->read();
	//     } else {
	//         if ($this->ContabilizadoMensal->save($this->request->data)) {
	        	
	//             // $this->Session->setFlash('A despesa foi editado com sucesso !!');
	//             $this->redirect(array('action' => 'index'));
	//         }
	//     }
	// }

	// public function delete($id) {
	//     if (!$this->request->is('post')) {
	//         throw new MethodNotAllowedException();
	//     }
	//     if ($this->ContabilizadoMensal->delete($id)) {
	//         // $this->Session->setFlash('A despesa foi deletado com sucesso !!');
	//         $this->redirect(array('action' => 'index'));
	//     }
	// }
}