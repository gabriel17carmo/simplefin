<?php

class BancosController extends AppController {
    public $name = 'Bancos';
    public $components = array('Session');

	public function isAuthorized($user) {
	    return true;
	}

    public function add() {
        if ($this->request->is('post')) {
        	$this->request->data['Banco']['usuario_id'] = $this->Auth->user('id');
            if ($this->Banco->save($this->request->data)) {
                $this->Session->setFlash('O banco ou tipo de poupança foi criado com sucesso !!');
                $this->redirect(array('controller' => 'contabilizados','action' => 'index'));
            }
        }
    }

	// public function edit($id = null) {
	//     $this->Banco->id = $id;
	//     if ($this->request->is('get')) {
	//         $this->request->data = $this->Banco->read();
	//     } else {
	//         if ($this->Banco->save($this->request->data)) {
	        	
	//             $this->Session->setFlash('O banco foi editado com sucesso !!');
	//             $this->redirect(array('action' => 'index'));
	//         }
	//     }
	// }

	// public function delete($id) {
	//     if (!$this->request->is('post')) {
	//         throw new MethodNotAllowedException();
	//     }
	//     if ($this->Banco->delete($id)) {
	//         $this->Session->setFlash('O banco foi deletado com sucesso !!');
	//         $this->redirect(array('action' => 'index'));
	//     }
	// }
}