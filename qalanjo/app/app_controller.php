<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', "Paginator", "Ajax", "Website", "Js", "NotificationCompletor", "AgoTime", "Time");
	var $components =array("Session", "Cookie", "Notifier", "RequestHandler", "Weightable", "DistanceCalculate");
	
	function beforeFilter(){
		$this->boot();
		$this->load_index();
	}
	
	
	private function boot(){

		//$this->Session->write("Member.id", 1);
		//$this->Session->write("Member.logged", 1);
		Configure::write("debug",2);
		$action = $this->action;
		$name = $this->name;
		if ($action=="not_allowed"){
			return;
		}
		if (($action=="forgot_password")||($action=="forgot_password_success")){
			return;
		}
		
		if ($this->name=="Pages"){
			if ($this->RequestHandler->isAjax()){
				$this->layout = "ajax";
			}else{
				$this->layout = "about";	
			}
			$this->set("page", $this->params["pass"][0]);
			return;
		}
		if (!$this->Session->check("Member.id")){
			if ($this->Cookie->read("Member.id")!=""){
				$this->Session->write("Member.id", $this->Cookie->read("Member.id"));
			}
		}
		
		/*
		if (($action!="not_allowed")||($action!="not_allowed_ajax")){
			if (substr($action, 0, 5)=="admin"){
				return;	
			}
			
			
		 	if (($action == "signup")||($action=="signup_process")){
				if ($this->Session->check("Member.logged")){
					$this->redirect(array("controller"=>"Members",
										   "action"=>"index"));
				}
				if ($this->Session->check("Member.id")){
					if ($this->Session->check("process")){
						if ($this->Session->read("process")=="signup"){
							return;
						}
						$this->redirect(array("controller"=>"Members",
										   "action"=>"index"));
					}
	
				}
			}else if (($action != "signup")&&($action!="login")&&($action!="getcode")){
				if (($action=="profile_completion")||($action=="questionnaire")){
					if ($this->Session->check("Member.logged")){
						$this->redirect(array("controller"=>"Members",
											   "action"=>"index"));
					}
				}
				if (!$this->Session->check("Member.id")){
					if (!$this->RequestHandler->isAjax()){
						$this->Session->setFlash("To continue access pages, you needed to login.");
						$this->redirect(array("controller"=>"Members",
											   "action"=>"login"));
					}
				}
			}
			if ($this->Session->check("Member.id")){
				if ($this->checkACL($this->Session->read("Member.id"))){
					$this->checkAndUpdateSubscription();
				}else{
					if ($this->RequestHandler->isAjax()){
						//$this->redirect(array("action"=>"not_allowed_ajax"));
					}else if ($this->RequestHandler->isGet()){
						
						if (!(($this->action=="process_signup_upload")||($this->action=="signup_upload_crop"))){
							$this->redirect(array("action"=>"not_allowed"));
						}
						
					}
					
				}
			}
		}
		*/
	}
	
	function forceSSL(){
		$this->redirect('https://' . $_SERVER['SERVER_NAME'] . $this->here);
	}
	

	/**
	 * Load the index. It is used for refreshing as well as for full reloads ...
	 */
	protected function load_index($option="quick") {
		if ($this->name!="members"){
			$this->loadModel("Member");
		}
		$member_id = $this->Session->read ( "Member.id" );
		$member = $this->Member->read ( null, $member_id );
		$this->loadModel("SubscriptionType");
		$this->loadModel("SubscriptionTransaction");
		$subscription = $this->SubscriptionTransaction->find("first", array("conditions"=>array("SubscriptionTransaction.member_id"=>$member_id, "SubscriptionTransaction.expired"=>0)));
		if ($option=="all"){
			$answers = $this->Member->InMyOwnWordsAnswer->shuffle($member_id);
			$age = $this->Member->MemberProfile->getAge($member_id);
			$member["Member"]["age"] = $age[0][0]["age"];
			$this->process_load_notification($member_id);
			$this->set("answers", $answers);
			//$this->set("weights", $this->Weightable->getTopicOpeners($member_id, 3));
		}
		if (($this->name=="Gifts")||($this->action=="buy")){
			$this->set ( "user", $member );	
		}else{
			$this->set ( "member", $member );
		}
		
		$role = $this->Member->getRole($member_id);
		$this->set("role", $role);
		if (!empty($subscription)){
			$this->set("subscription", $subscription);
		}
	}

	/**
	 * 
	 * load list of notifications ...
	 * @param $member_id
	 */
	protected function process_load_notification($member_id){
		$this->loadModel("Notification");
		$notifications = $this->Notification->find("all",array("conditions"=>array("Member.id"=>$member_id), "order"=>"Notification.created desc", "limit"=>10));
		$this->set ("notifications", $notifications);
	}
	
	private function checkACL($member_id){
		$action = $this->action;
		$controller = $this->name;
		if ($controller!="Members"){
			$this->loadModel("Member");
		}
		$this->loadModel("Action");
		$this->loadModel("Role");
		$this->loadModel("Location");
		$role_id = $this->Member->getRole($member_id);	
		$location_id = $this->Location->getLocationId($controller);
		return $this->Role->isAllowed($role_id, $action, $location_id);

	}

	private function checkAndUpdateSubscription(){
		if ($this->name!="Members"){
			$this->loadModel("Member");
			
		}
		$this->loadModel("SubscriptionTransaction");
		$member_id = $this->Session->read("Member.id");
		
		$role_id = $this->Member->getRole($member_id);
		
		if (!(($role_id==1)||($role_id==4))){
			$result = $this->SubscriptionTransaction->checkIfSubscribeOrExpired($member_id);
			if (!$result){
				$this->SubscriptionTransaction->expireSubscription($member_id);
				$this->Member->updateRole(2, $member_id);
			}
		}
	}
	
	function not_allowed_ajax(){
		$this->render("/elements/not_allowed", "ajax");
	}
	
	
	function not_allowed(){
		$this->load_index();
		$this->set("process", "wa");
		$this->render("/elements/not_allowed", "full_block_new");
	}
	

	function beforeRender() {
		$gift_path = Configure::read('gift_path');
		$qpath = Configure::read('upload_path');
		$uploadsPath = Configure::read('uploadsPath');
		$fullImagePath = Configure::read('fullImagePath');
		
		$this->set(compact('gift_path', 'qpath', 'uploadsPath', 'fullImagePath'));
	}
	
}