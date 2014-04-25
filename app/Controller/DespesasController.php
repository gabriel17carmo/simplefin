<?php

class DespesasController extends AppController {
  public $name = 'Despesas';
  public $components = array('Session');

  public function isAuthorized($user) {
    return true;
  }

  public function index() {
    $this->loadModel('TipoDespesa');

    $totalMes = "";
    $tableDespesa = $this->montaTabela('Despesa', 'despesas', 'TipoDespesa', 'tipo_despesas', $totalMes);
    $this->set('totalMesDespesa', $totalMes);
    $this->set('tabelaTipoDespesas', $tableDespesa);

    $this->loadModel('Usuario');
    $ultimaDespesa = $this->Usuario->find('first', array(
      'conditions' => array(
        'Usuario.id' => $this->Auth->user('id')
        )
      )
    );
    $ultimaDespesa = $ultimaDespesa['Usuario']['ultima_despesa'];
    $ultimaDespesa = explode(" ", $ultimaDespesa);
    list($data, $hora) = $ultimaDespesa;
    $dia = $this->diaSemana($data);

    $data = strtotime($data);
    $data = date('d/m', $data);

    $hora = explode(':', $hora);
    list($h, $m, $s) = $hora;
    $hora = $h . ':' . $m;

    $ultimaDespesa = $dia . ' (' . $data . ')' . ' ás ' . $hora . '.';

    $this->set('ultimaDespesa', $ultimaDespesa);
  }

  public function add() {

    if ($this->request->is('post')) {

     $data = $this->request->data['Despesa']['data'];

     $data = explode("/", $data);

     list($day, $month, $year) = $data;

     $this->request->data['Despesa']['data'] = $year . "-" . $month . "-" . $day;
     
     if ($this->Despesa->save($this->request->data)) {
      $this->Session->setFlash('A despesa foi criado com sucesso !!');

      $this->loadModel('TipoDespesa');
      $this->TipoDespesa->query("
       UPDATE tipo_despesas
       SET cont=cont+1
       WHERE id = " . $this->request->data['Despesa']['tipo_despesas_id']
       );

      $this->loadModel('Usuario');
      $this->Usuario->query("
        UPDATE usuarios
        SET ultima_despesa = (CURRENT_TIMESTAMP)
        WHERE id = " . $this->Auth->user('id')
      );

      $this->redirect(array('controller' => 'adds', 'action' => 'index'));
    }
  }
}

}