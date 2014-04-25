<?php

class Receita extends AppModel {
	public $name = 'Receita';

	public $validate = array(
		'tipo_receitas_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Insira o tipo de receita relacionado.'
			),
		'valor' => array(
			'rule'    => 'numeric',
			'allowEmpty' => false,
			'message' => 'Insira o valor da receita.'
			),
		'data' => array(
			'rule'       => 'date',
			'message'    => 'Entre com uma data válida.',
			'allowEmpty' => true
			)
	);

}