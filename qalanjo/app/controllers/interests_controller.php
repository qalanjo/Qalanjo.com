<?php
class InterestsController extends AppController {

	var $name = 'Interests';

	function admin_index() {
		$this->Interest->recursive = 0;
		$this->set('interests', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid interest', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('interest', $this->Interest->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Interest->create();
			if ($this->Interest->save($this->data)) {
				$this->Session->setFlash(__('The interest has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.', true));
			}
		}
		$interestTypes = $this->Interest->InterestType->find('list');
		$this->set(compact('interestTypes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid interest', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Interest->save($this->data)) {
				$this->Session->setFlash(__('The interest has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Interest->read(null, $id);
		}
		$interestTypes = $this->Interest->InterestType->find('list');
		$this->set(compact('interestTypes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for interest', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Interest->delete($id)) {
			$this->Session->setFlash(__('Interest deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Interest was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>