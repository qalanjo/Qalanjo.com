<?php
class InterestTypesController extends AppController {

	var $name = 'InterestTypes';

	function admin_index() {
		$this->InterestType->recursive = 0;
		$this->set('interestTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid interest type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('interestType', $this->InterestType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->InterestType->create();
			if ($this->InterestType->save($this->data)) {
				$this->Session->setFlash(__('The interest type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid interest type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InterestType->save($this->data)) {
				$this->Session->setFlash(__('The interest type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InterestType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for interest type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InterestType->delete($id)) {
			$this->Session->setFlash(__('Interest type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Interest type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>