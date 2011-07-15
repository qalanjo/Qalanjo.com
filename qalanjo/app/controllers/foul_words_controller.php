<?php
class FoulWordsController extends AppController {

	var $name = 'FoulWords';

	function admin_index() {
		$this->FoulWord->recursive = 0;
		$this->set('foulWords', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid foul word', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foulWord', $this->FoulWord->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FoulWord->create();
			if ($this->FoulWord->save($this->data)) {
				$this->Session->setFlash(__('The foul word has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foul word could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid foul word', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FoulWord->save($this->data)) {
				$this->Session->setFlash(__('The foul word has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foul word could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FoulWord->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for foul word', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FoulWord->delete($id)) {
			$this->Session->setFlash(__('Foul word deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foul word was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>