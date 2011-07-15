<?php
class GiftsController extends AppController {

	var $name = 'Gifts';
	
	var $helpers = array('Javascript','Js','Ajax');
	
	var $components = array('RequestHandler');
	
	/**
	 * 
	 * Index action ...
	 * @param $query
	 */
	function index($query=""){
		$this->layout = 'gift-page';
		
		// finding the type is all that's needed because the GiftType model itself limits the number of
		// Gifts it retreives, see the GiftType model
		$types = $this->Gift->GiftType->find('all');
		$this->set('types',$types);
		
	}
	
	
	/**
	 * 
	 * Performs autocomplete for searching ...
	 */
	function autoComplete(){
		 Configure::write('debug', 0);
		 $this->layout = 'ajax';
		 $gifts = $this->Gift->find('all', array(
		   'conditions'=>array('Gift.name LIKE'=>$this->params['url']['q'].'%'),
		   'fields'=>array('name', 'id')));

 		 $this->set("gifts", $gifts); 		 
	}
	

	/**
	 * 
	 * View current items...
	 * @param $item_id
	 */
	function view($gift_id = -1){
		$this->layout = 'ajax';
		if($gift_id != -1){
			$currently_viewed_gift = $this->Gift->find('first',
				array(
					'conditions'=>array('Gift.id'=>$gift_id),
				)
			);
			$related_gifts = $this->Gift->get_related_gifts($currently_viewed_gift);
		}
		$this->set('currently_viewed_gift',$currently_viewed_gift);
		$this->set('related_gifts',$related_gifts);
	}
	
	
	function admin_index() {
		$this->Gift->recursive = 0;
		$this->set('gifts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Gift', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gift', $this->Gift->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Gift->create();
			if ($this->Gift->save($this->data)) {
				$this->Session->setFlash(__('The Gift has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gift could not be saved. Please, try again.', true));
			}
		}
		$giftTypes = $this->Gift->GiftType->find('list');
		$this->set(compact('giftTypes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Gift', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gift->save($this->data)) {
				$this->Session->setFlash(__('The Gift has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gift could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gift->read(null, $id);
		}
		$giftTypes = $this->Gift->GiftType->find('list');
		$this->set(compact('giftTypes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Gift', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Gift->delete($id)) {
			$this->Session->setFlash(__('Gift deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gift was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>