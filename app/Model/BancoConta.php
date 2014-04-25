<?php

class BancoConta extends AppModel {
	public $name = 'BancoConta';

	public $validate = array(
		'valor' => array(
			'rule'    => 'numeric',
			'allowEmpty' => false,
			'message' => 'Insira o valor.'
			)
	);
}