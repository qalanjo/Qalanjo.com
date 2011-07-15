<?php
class AttributeTypesController extends AppController {

	var $name = 'AttributeTypes';

	function admin_index() {
		$this->AttributeType->recursive = 0;
		$this->set('attributeTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attribute type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attributeType', $this->AttributeType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AttributeType->create();
			if ($this->AttributeType->save($this->data)) {
				$this->Session->setFlash(__('The attribute type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute type could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attribute type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttributeType->save($this->data)) {
				$this->Session->setFlash(__('The attribute type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttributeType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attribute type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttributeType->delete($id)) {
			$this->Session->setFlash(__('Attribute type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attribute type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>