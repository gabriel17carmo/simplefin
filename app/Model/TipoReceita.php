<?php

class TipoReceita extends AppModel {
	public $name = 'TipoReceita';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'O nome não pode ser vazio.'
			)
	);

}