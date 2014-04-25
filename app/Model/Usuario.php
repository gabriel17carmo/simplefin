<?php
App::uses('AuthComponent', 'Controller/Component');
class Usuario extends AppModel {
	public $name = 'Usuario';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'O nome não pode ser vazio.'
			),
		'login' => array(
			'alphaNumeric' => array(
				'rule'     => 'alphaNumeric',
				'required' => true,
				'message'  => 'Digite somente letras ou números.'
				),
			'between' => array(
				'rule'    => array('between', 2, 15),
				'message' => 'Seu login deve de 2 a 15 caracteres.'
				)
			),
		'senha' => array(
			'rule'    => array('minLength', '4'),
			'allowEmpty' => false,
			'message' => 'Sua senha deve ter no mínimo 4 dígitos.'
			),
		'email' => array(
			'rule' => 'email',
			'required' => true
			),
		'data' => array(
			'rule'       => 'date',
			'message'    => 'Entre com uma data válida.',
			'allowEmpty' => true
			),
		'grupo' => array(
			'rule' => array('custom', '/[1-2]{1}$/'), 
			'allowEmpty' => false,
			'message' => 'Escolha um grupo válido.'
			)
	);

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['senha'])) {
	        $this->data[$this->alias]['senha'] = AuthComponent::password($this->data[$this->alias]['senha']);
	    }
	    return true;
	}
}