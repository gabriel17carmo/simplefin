<?php

class TipoDespesasController extends AppController {
    public $name = 'TipoDespesas';
    public $components = array('Session');

    public function isAuthorized($user) {
	    return true;
	}

    public function add() {
        if ($this->request->is('post')) {
        	$this->request->data['TipoDespesa']['usuario_id'] = $this->Auth->user('id');
            if ($this->TipoDespesa->save($this->request->data)) {
                $this->Session->setFlash('O tipo de despesa foi criado com sucesso !!');
                $this->redirect(array('controller' => 'adds','action' => 'index'));
            }
        }
    }

	// public function edit($id = null) {
	//     $this->TipoDespesa->id = $id;
	//     if ($this->request->is('get')) {
	//         $this->request->data = $this->TipoDespesa->read();
	//     } else {
	//         if ($this->TipoDespesa->save($this->request->data)) {
	        	
	//             $this->Session->setFlash('O tipo de despesa foi editado com sucesso !!');
	//             $this->redirect(array('action' => 'index'));
	//         }
	//     }
	// }

	// public function delete($id) {
	//     if (!$this->request->is('post')) {
	//         throw new MethodNotAllowedException();
	//     }
	//     if ($this->TipoDespesa->delete($id)) {
	//         $this->Session->setFlash('O tipo de despesa foi deletado com sucesso !!');
	//         $this->redirect(array('action' => 'index'));
	//     }
	// }
}