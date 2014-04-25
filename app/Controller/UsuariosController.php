<?php

class UsuariosController extends AppController {
    public $name = 'Usuarios';
    public $components = array('Session');
	
	public function isAuthorized($user) {
	    if (!parent::isAuthorized($user)) {
	        if (in_array($this->action, array('edit', 'delete_logout'))) {
	            $userId = $this->request->params['pass'][0];
	            if ($user['id'] == $userId)
	            	return true;
	            else
	            	return false;
	        }
	    }else {
	    	return true;
	    }
	}

	public function beforeFilter() {
	    parent::beforeFilter();
	}

	public function login() {
		if($this->request->is('post')){
		    if ($this->Auth->login()) {
		        $this->redirect($this->Auth->redirect());
		    }else{
		    	$this->Session->setFlash(__('Login ou senha incorretos !'));
		    }
		}
	}

	public function logout() {
	    $this->redirect($this->Auth->logout());
	}
	
    public function index() {
        $this->set('usuarios', $this->Usuario->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
        	// $this->request->data['Usuario']['senha'] = $this->Auth->password($this->request->data['Usuario']['senha']);
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('O usuário foi criado com sucesso !!');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

	public function edit($id = null) {
	    $this->Usuario->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Usuario->read();
	    } else {

	    		// var_dump($this->request->data['Usuario']);
	    		// $this->Session->write('Auth', $this->Usuario->read(null, $user_id));
	        if ($this->Usuario->save($this->request->data)) {
						$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['Usuario']));
            $this->Session->setFlash('Edição realizada com sucesso !');
            $this->redirect(array('controller' => 'configs', 'action' => 'index'));
	        }
	    }
	}

	public function delete($id) {
	    if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Usuario->delete($id, true)) {
	        $this->Session->setFlash('O usuário foi deletado com sucesso !!');
	        $this->redirect(array('action' => 'index'));
	    }
	}

	public function delete_logout($id) {
	    if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Usuario->delete($id, true)) {
	        $this->Session->setFlash('O usuário foi deletado com sucesso !!');
	       	$this->redirect($this->Auth->logout());
	    }
	}
}