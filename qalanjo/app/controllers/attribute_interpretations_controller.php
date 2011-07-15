<?php
class AttributeInterpretationsController extends AppController {

	var $name = 'AttributeInterpretations';

	function admin_index() {
		$this->AttributeInterpretation->recursive = 0;
		$this->set('attributeInterpretations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attribute interpretation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attributeInterpretation', $this->AttributeInterpretation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AttributeInterpretation->create();
			if ($this->AttributeInterpretation->save($this->data)) {
				$this->Session->setFlash(__('The attribute interpretation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute interpretation could not be saved. Please, try again.', true));
			}
		}
		$attributes = $this->AttributeInterpretation->Attribute->find('list', array("fields"=>array("id", "question")));
		$this->set(compact('attributes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attribute interpretation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttributeInterpretation->save($this->data)) {
				$this->Session->setFlash(__('The attribute interpretation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute interpretation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttributeInterpretation->read(null, $id);
		}
		$attributes = $this->AttributeInterpretation->Attribute->find('list', array("fields"=>array("id", "question")));
		$this->set(compact('attributes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attribute interpretation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttributeInterpretation->delete($id)) {
			$this->Session->setFlash(__('Attribute interpretation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attribute interpretation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>