<?php

class Bancos extends AppModel {
	public $name = 'Bancos';

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'O nome não pode ser vazio.'
			)
	);

}