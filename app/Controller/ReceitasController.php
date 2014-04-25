<?php

class ReceitasController extends AppController {
  public $name = 'Receitas';
  public $components = array('Session');

  public function isAuthorized($user) {
    return true;
  }

  public function index() {
    $this->loadModel('TipoReceita');

    $totalMes = "";
    $tableReceita = $this->montaTabela('Receita', 'receitas', 'TipoReceita', 'tipo_receitas', $totalMes);
    $this->set('totalMesReceita', $totalMes);
    $this->set('tabelaTipoReceitas', $tableReceita);

    $this->loadModel('Usuario');
    $ultimaReceita = $this->Usuario->find('first', array(
      'conditions' => array(
        'Usuario.id' => $this->Auth->user('id')
        )
      )
    );
    $ultimaReceita = $ultimaReceita['Usuario']['ultima_receita'];
    $ultimaReceita = explode(" ", $ultimaReceita);
    list($data, $hora) = $ultimaReceita;
    $dia = $this->diaSemana($data);

    $data = strtotime($data);
    $data = date('d/m', $data);

    $hora = explode(':', $hora);
    list($h, $m, $s) = $hora;
    $hora = $h . ':' . $m;

    $ultimaReceita = $dia . ' (' . $data . ')' . ' ás ' . $hora . '.';

    $this->set('ultimaReceita', $ultimaReceita);

  }

  public function add() {

    if ($this->request->is('post')) {

      $data = $this->request->data['Receita']['data'];

      $data = explode("/", $data);

      list($day, $month, $year) = $data;

      $this->request->data['Receita']['data'] = $year . "-" . $month . "-" . $day;


      if ($this->Receita->save($this->request->data)) {
        $this->Session->setFlash('A receita foi criado com sucesso !!');

        $this->loadModel('TipoReceita');
        $this->TipoReceita->query("
        	UPDATE tipo_receitas
        	SET cont=cont+1
        	WHERE id = " . $this->request->data['Receita']['tipo_receitas_id']
          );

        $this->loadModel('Usuario');
        $dadosUsuario['Usuario']['ultima_receita'] = date('Y-m-d H:i:s');
        $this->Usuario->save($dadosUsuario);

        $this->loadModel('Usuario');
        $this->Usuario->query("
          UPDATE usuarios
          SET ultima_receita = (CURRENT_TIMESTAMP)
          WHERE id = " . $this->Auth->user('id')
        );

        $this->redirect(array('controller' => 'adds', 'action' => 'index'));
      }
    }
  }

	// public function edit($id = null) {
	//     $this->Receita->id = $id;
	//     if ($this->request->is('get')) {
	//         $this->request->data = $this->Receita->read();
	//     } else {
	//         if ($this->Receita->save($this->request->data)) {

	//             $this->Session->setFlash('A receita foi editado com sucesso !!');
	//             $this->redirect(array('action' => 'index'));
	//         }
	//     }
	// }

	// public function delete($id) {
	//     if (!$this->request->is('post')) {
	//         throw new MethodNotAllowedException();
	//     }
	//     if ($this->Receita->delete($id)) {
	//         $this->Session->setFlash('A receita foi deletado com sucesso !!');
	//         $this->redirect(array('action' => 'index'));
	//     }
	// }


}