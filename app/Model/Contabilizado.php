<?php

class Contabilizado extends AppModel {
	public $name = 'Contabilizado';

	public $validate = array(
		'valor' => array(
			'rule'    => 'numeric',
			'allowEmpty' => false,
			'message' => 'Insira o valor.'
			),
		'data' => array(
			'rule'       => 'date',
			'message'    => 'Entre com uma data válida.',
			'allowEmpty' => false
			)
	);
}