<?php

class TipoReceitasController extends AppController {
    public $name = 'TipoReceitas';
    public $components = array('Session');

    public function isAuthorized($user) {
	    return true;
	}

    public function add() {
        if ($this->request->is('post')) {
        	$this->request->data['TipoReceita']['usuario_id'] = $this->Auth->user('id');
            if ($this->TipoReceita->save($this->request->data)) {
                $this->Session->setFlash('O tipo de receita foi criado com sucesso !!');
                $this->redirect(array('controller' => 'adds','action' => 'index'));
            }
        }
    }

	// public function edit($id = null) {
	//     $this->TipoReceita->id = $id;
	//     if ($this->request->is('get')) {
	//         $this->request->data = $this->TipoReceita->read();
	//     } else {
	//         if ($this->TipoReceita->save($this->request->data)) {
	        	
	//             $this->Session->setFlash('O tipo de receita foi editado com sucesso !!');
	//             $this->redirect(array('action' => 'index'));
	//         }
	//     }
	// }

	// public function delete($id) {
	//     if (!$this->request->is('post')) {
	//         throw new MethodNotAllowedException();
	//     }
	//     if ($this->TipoReceita->delete($id)) {
	//         $this->Session->setFlash('O tipo de receita foi deletado com sucesso !!');
	//         $this->redirect(array('action' => 'index'));
	//     }
	// }
	
}

// SELECT *
// FROM usuarios AS u
// INNER JOIN tipo_receitas AS tr
// ON tr.usuario_id = u.id
// WHERE u.id = 36

// SELECT *
// FROM receitas AS r
// INNER JOIN tipo_receitas AS tr
// ON r.tipo_receitas_id = tr.id
// ORDER BY r.data DESC

// SELECT distinct tr.nome
// FROM receitas AS r
// INNER JOIN tipo_receitas AS tr
// ON r.tipo_receitas_id = tr.id
// ORDER BY r.data ASC