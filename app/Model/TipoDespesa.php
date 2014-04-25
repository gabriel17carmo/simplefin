<?php

class TipoDespesa extends AppModel {
	public $name = 'TipoDespesa';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'O nome não pode ser vazio.'
			)
	);

}