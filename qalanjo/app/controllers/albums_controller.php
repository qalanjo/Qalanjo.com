<?php
class AlbumsController extends AppController {

	var $name = 'Albums';

	function admin_index() {
		$this->Album->recursive = 0;
		$this->set('albums', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid album', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('album', $this->Album->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Album->create();
			if ($this->Album->save($this->data)) {
				$this->Session->setFlash(__('The album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album could not be saved. Please, try again.', true));
			}
		}
		$members = $this->Album->Member->find('list');
		$this->set(compact('members'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid album', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Album->save($this->data)) {
				$this->Session->setFlash(__('The album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Album->read(null, $id);
		}
		$members = $this->Album->Member->find('list');
		$this->set(compact('members'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for album', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Album->delete($id)) {
			$this->Session->setFlash(__('Album deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Album was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>