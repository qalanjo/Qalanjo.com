<?php
class AttributeCategoriesController extends AppController {

	var $name = 'AttributeCategories';

	function admin_index() {
		$this->AttributeCategory->recursive = 0;
		$this->set('attributeCategories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attribute category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attributeCategory', $this->AttributeCategory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AttributeCategory->create();
			if ($this->AttributeCategory->save($this->data)) {
				$this->Session->setFlash(__('The attribute category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute category could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attribute category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttributeCategory->save($this->data)) {
				$this->Session->setFlash(__('The attribute category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttributeCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attribute category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttributeCategory->delete($id)) {
			$this->Session->setFlash(__('Attribute category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attribute category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>