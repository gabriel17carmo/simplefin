<?php

class Despesa extends AppModel {
	public $name = 'Despesa';

	public $validate = array(
		'tipo_despesas_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Insira o tipo de despesa relacionado.'
			),
		'valor' => array(
			'rule'    => 'numeric',
			'allowEmpty' => false,
			'message' => 'Insira o valor da despesa.'
			),
		'data' => array(
			'rule'       => 'date',
			'message'    => 'Entre com uma data válida.',
			'allowEmpty' => true
			)
	);

}