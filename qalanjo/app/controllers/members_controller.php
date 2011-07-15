<?php
App::import ( "Sanitize" );
App::import ( 'Core', 'HttpSocket' );
class MembersController extends AppController {
	var $name = 'Members';
	function __construct() {
		parent::__construct ();
		$this->components [] = "Email";
		$this->components [] = "MatchMaker";
		$this->components [] = "Recaptcha";
		$this->components [] = "Progress";
		$this->helpers [] = "ProfileCompletor";
		$this->helpers [] = "Recaptcha";
	
	}
	
	/**
	 * Action for 3 step rules ...
	 * @param int $number Specifies the number
	 */
	function step($number = 1) {
		if (! empty ( $this->data )) {
			if ($number == 1) {
				$fields [] = "country_id";
				$fields [] = "state";
				$fields [] = "zipcode";
				if (isset ( $this->data ["Member"] ["state"] ) && $this->data ["Member"] ["state"] != "") {
					$this->loadModel ( "State" );
					$state = $this->State->find ( "first", array ("conditions" => array ("State.id" => $this->data ["Member"] ["state"] ) ) );
					$this->data ["Member"] ["state"] = $state ["State"] ["name"];
				}
			} else if ($number == 2) {
				$fields [] = "passionate_about";
				$fields [] = "looking_for_details";
			}
			if ($this->Member->edit ( $this->data, $fields )) {
				if ($this->Member->MemberProfile->save ( $this->data, $fields )) {
					$this->redirect ( "/members/step/" . ($number + 1) );
				}
			}
		}
		$this->loadModel ( "Country" );
		$temp = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name" ) );
		$countries ["-1"] = "Please select...";
		foreach ( $temp as $key => $country ) {
			$countries [$key] = $country;
		}
		$this->set ( "countries", $countries );
		$this->loadModel ( "State" );
		$temp = $this->State->find ( "list", array ("fields" => array ("name" ) ) );
		$states [] = "Please select...";
		foreach ( $temp as $state ) {
			$states [] = $state;
		}
		$this->load_index ();
		$this->data = $this->Member->read ( null, $this->Session->read ( "Member.id" ) );
		$this->set ( "states", $states );
		$this->render ( "/elements/blue/members/index/step_" . $number, "blue_full_block" );
	}
	function beforeFilter() {
		parent::beforeFilter ();
		$this->Recaptcha->publickey = "6Lfd7sISAAAAAIiAynM871fy2Qxejpt3_srDY_IB";
		$this->Recaptcha->privatekey = "6Lfd7sISAAAAAImtgP0ywAko7RX3tvbD7JwoN-rw";
	
	}
	
	/**
	 * 
	 * Action for signup ...
	 */
	function signup() {
		$this->layout = "home_page";
		if (!empty($this->data)) {
			$password = $this->data["Member"]["password"];
			$validates = $this->Member->signup($this->data);
			$id = $this->Member->getLastInsertId ();
			$album ["Album"] ["name"] = "default";
			$album ["Album"] ["member_id"] = $id;
			if ($this->Member->Album->createDefault ( $album )) {
				$this->Session->write ( "Member.id", $id );
				$this->Session->write("Member.logged", 1);
				$this->Session->write ( "process", "signup" );
				$this->email_activation ( $password );
				$this->redirect (array("action"=>"step"));
				/*
				$this->Member->save_progress($id, "profile_completion");
				$this->redirect ( array ('action' => "profile_completion" ) );
				*/
			}
		}
		$this->loadHomeContent ();
	}
	
	function loadHomeContent() {
		$option = array ("fields" => array ("id", "value" ) );
		$this->loadModel ( "Gender" );
		$this->loadModel ( "Country" );
		$this->loadModel ( "Idea" );
		$this->loadModel ( "State" );
		
		$temp = $this->Idea->find ( "list", $option );
		$ideas ["-1"] = "Please select...";
		foreach ( $temp as $key => $idea ) {
			$ideas [$key] = $idea;
		}
		$temp = $this->Gender->find ( "list", $option );
		foreach ( $temp as $key => $gender ) {
			$genders [$key] = $gender;
		}
		$this->set ( "genders", $genders );
		$genders = $this->Gender->find ( "list", array ("fields" => array ("id", "value" ), "order" => "Gender.id desc" ) );
		foreach ( $genders as $key => $gender ) {
			$genders [$key] = Inflector::pluralize ( $gender );
		}
		$this->set ( "seeking", $genders );
		$this->set ( "ideas", $ideas );
		$this->set ( "home", true );
	}
	/**
	 * 
	 * Controller action for logging in ...
	 */
	function login() {
		$this->layout = "home_page";
		if (! empty ( $this->data )) {
			debug($this->data);
			$this->Member->set ( $this->data );
			if ($this->Member->validates ( array ('fieldList' => array ('username', 'password' ) ) )) {
				$member = $this->Member->login ();
				if ($member) {
					//if ($member ["Member"] ["progress"] == "complete") {
						$this->plugValues($member);
						$this->redirect ("/");
					
				
		//					$this->redirect(array('action'=>'activation',$member['Member']['id']));
				} else {
					$this->Session->setFlash ( "The username you entered does not belong to any account." );
				}
			}
		}
		$this->loadHomeContent ();
		$this->set ( "function", "login" );
	}
	
	function plugValues($member){
		$this->Session->write ( 'Member.id', $member ['Member'] ['id'] );
		$this->Session->write ( "Member.logged", true );
		$this->Cookie->write("Member.id", $member["Member"]["id"], true, "1 hour");
		$this->Session->write ( "userid", $member ['Member'] ['id'] );
		$this->Member->updateOnline ( $member ['Member'] ['id'], true );
	}
	
	/**
	 * Ajax version of login ...
	 */
	function ajax_login(){
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->data)){
				$this->data = Sanitize::clean($this->data);
				$this->Member->set($this->data);
				$member = $this->Member->login();
				if (!empty($member)){
					$this->plugValues($member);
					$this->set("response", "true");
				}else{
					$temp["errors"] = "The user does not exist";
					$this->set("response", json_encode($temp));
				}
				
				$this->render("/elements/responses", "ajax");
			}
			
		}
	}
	
	
	
	function ajax_signup(){
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->data)){
				$password = $this->data ["Member"] ["password"];
				$validates = $this->Member->signup ( $this->data );
				
				if ($validates) {
					$id = $this->Member->getLastInsertId ();
					$album ["Album"] ["name"] = "default";
					$album ["Album"] ["member_id"] = $id;
					if ($this->Member->Album->createDefault ( $album )) {
						$this->Session->write ( "Member.id", $id );
						$this->Session->write ( "process", "signup" );
						$this->email_activation ( $password );
						$this->set("response", "true");
						/*
						$this->Member->save_progress($id, "profile_completion");
						$this->redirect ( array ('action' => "profile_completion" ) );
						*/
					}
					$this->set("response", "true");
					$this->render("/elements/responses", "ajax");
				}else{
					$temp["result"] = $validates;
					$temp["data"] = $this->data;
					$temp["errors"] = $this->Member->MemberProfileAttributeWeight->invalidFields();
					$this->set("response", json_encode($temp));
				}
				$this->render("/elements/responses", "ajax");	
			}
			return;
		}
	}
	function logout() {
		$member_id = $this->Session->read ( "Member.id" );
		$this->Member->updateOnline ( $member_id, false );
		$this->Session->destroy ();
		$this->redirect ( "http://" . $_SERVER ['SERVER_NAME'] . $this->base . "/" );
	}
	
	/**
	 * 
	 * activate members, either via link-click if $id and $code are not empty, or via manual insertion in the activation page
	 * @param int $id
	 * @param string $code
	 */
	function activation($id = null, $code = null) {
		if (! empty ( $id ) && ! empty ( $code )) {
			$this->link_activation ( $id, $code );
		}
		if (! empty ( $this->data )) {
			$this->Member->set ( $this->data );
			if ($this->Member->activateCode ()) {
				$this->Session->setFlash ( __ ( 'Your account is now activated, Have fun finding a match', true ) );
				$this->redirect ( '/' );
			}
			$this->Session->setFlash ( __ ( 'The Activation code is invalid', true ) );
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 * @param unknown_type $code
	 */
	function link_activation($id = null, $code = null) {
		if (! empty ( $id ) && ! empty ( $code )) {
			if ($this->Member->activateCode ( $id, $code )) {
				$this->Session->setFlash ( __ ( 'Your account is now activated, Have fun finding a match', true ) );
				$this->redirect ( '/' );
			}
			$this->Session->setFlash ( __ ( 'Either the activation code is invalid, or the member does not exist.', true ) );
			$this->redirect ( array ('action' => 'login' ) );
		}
	}
	
	function reset($code){
		if ($this->Member->reset($code)){
			$this->redirect("/members/changepassword");
		}else{
			$this->redirect("/");
		}
	}
	
	function changepassword(){
		
	}
	
	/**
	 * 
	 * Reads for member ...
	 * @param $name
	 */
	function read_member($name = array()) {
		if (! empty ( $name )) {
			$temp = $this->Member->find ( 'first', array ('conditions' => array ('OR' => array ('Member.email LIKE' => $name . '%', 'Member.name' => $name, 'Member.id' => $name ) ), 'recursive' => 0 ) );
			return $temp;
		}
		return false;
	}
	
	/**
	 * 
	 * checks the $page variable to know what page to render
	 * @param int $page
	 */
	
	function profile_completion($page = 1) {
		$this->set ( "profile_completion", false );
		$this->layout = "personal_assessment";
		if (! $this->Session->check ( 'Member.id' )) {
			$this->Session->setFlash ( __ ( 'Please login to visit this page', true ) );
			$this->redirect ( array ('action' => 'login' ) );
		} else {
			$id = $this->Session->read ( "Member.id" );
		}
		if (! empty ( $this->data )) {

			if (isset ( $this->data ["MemberProfileAttributeWeight"] ["educational_level_id"] ) && ($this->data ["MemberProfileAttributeWeight"] ["educational_level_id"] == "")) {
				$this->set ( "error", true );
			} else {
				$this->Member->set ( $this->data );
				$this->Member->MemberProfile->set ( $this->data );
				$this->Member->MemberProfileAttributeWeight->set ( $this->data );
				$this->continue_or_exit ( $page );
			}
		}
		if (empty ( $this->data )) {
			$this->data = $this->Member->read ( null, $id );
		}
		if ($page == 5) {
			$this->redirect ( "/questionnaire" );
		}
		$this->loadProfileQuestion($page);
		if ($page==3){
			$educationalLevel = $this->Member->MemberProfileAttributeWeight->EducationalLevel->find ( 'all', array ("recursive" => - 1 ) );
			$this->set ( 'educationalLevels', $educationalLevel );
			$income = $this->Member->MemberProfileAttributeWeight->PersonalIncome->find ( 'all', array ("recursive" => - 1 ) );
			$this->set ( 'income', $income );
			$statuses = $this->Member->MemberProfile->MaritalStatus->find ( 'all', array ("recursive" => - 1 ) );
			$this->set ( 'statuses', $statuses );
		}
		if ($page==1){
			$pageSet = "My Appearance";
			$perc = 0;	
		}else if ($page==2){
			$pageSet = "My Lifestyle";
			$perc = 8;	
		}else if ($page==3){
			$pageSet = "My Personal Background";
			$perc = 15;	
		}else if ($page==4){
			$pageSet = "Express Yourself";	
			$perc = 23;
		}
		$this->set("pageSet", $pageSet);
		$this->set("perc", $perc);
		$this->set("progressSet", "Profile Building ".$page." out of 4");
		$this->set ( 'member_id', $id );
		$this->set ( "set", "Profile Building" );
		$this->set ( 'page', $page );
		$this->render("/elements/blue/profile_building/page".$page);		
	}
	
	
	/**
	 * load profile question for a specific page ...
	 */
	private function loadProfileQuestion($page) {
		$this->loadModel ( "ProfileQuestion" );
		$questions = $this->ProfileQuestion->find ( "all", array ("conditions" => array ("ProfileQuestion.page" => $page ) ) );
		$this->set ( "questions", $questions );
	}
	
	
	/**
	 * 
	 * checks $this->params['form']'s set submit button to know whether to continue or to exit
	 * @params int $page
	 */
	function continue_or_exit($page) {
		$action = "save_" . $page . "_completion";
		
		if (($this->selected_valid ()) && ($this->Member->$action ())) {
			$this->save_answers ();
			$id = $this->Session->read ( "Member.id" );
			if ($page <= 15) {
				$this->Member->save_progress ( $id, "profile_completion/" . ($page + 1) );
				$this->redirect ( array ('action' => 'profile_completion', $page + 1 ) );
			} else {
				$this->Member->save_progress ( $id, "questionnaire" );
				$this->redirect ( array ("controller" => "attributes", 'action' => 'questionnaire' ) );
			}
		}
	}
	
	function selected_valid() {
		if (isset ( $this->data ["MemberProfileAnswer"] )) {
			foreach ( $this->data ["MemberProfileAnswer"] as $answer ) {
				if (! isset ( $answer ["item_id"] )) {
					$this->set ( "error", true );
					return false;
				}
			}
			return true;
		} else {
			return true;
		}
	}
	
	/**
	 * 
	 * Save answers ...
	 */
	function save_answers() {
		$i = 0;
		if (isset ( $this->data ["MemberProfileAnswer"] )) {
			
			foreach ( $this->data ["MemberProfileAnswer"] as $answer ) {
				$this->loadModel ( "ProfileQuestion" );
				$question_id = $answer ["question_id"];
				$question = $this->ProfileQuestion->find ( "first", array ("conditions" => array ("ProfileQuestion.id" => $question_id ) ) );
				foreach ( $question ["ProfileAnswer"] as $item ) {
					$this->Member->MemberProfileAnswer->deleteAll ( array ("MemberProfileAnswer.member_id" => $this->data ["Member"] ["id"], "MemberProfileAnswer.profile_answer_id" => $item ["id"] ) );
				}
				
				if (is_array ( $answer ["item_id"] )) {
					foreach ( $answer ["item_id"] as $item ) {
						$data ["MemberProfileAnswer"] ["member_id"] = $this->data ["Member"] ["id"];
						$data ["MemberProfileAnswer"] ["profile_answer_id"] = $item;
						$this->Member->MemberProfileAnswer->save_answer ( $data );
					}
				} else {
					$data ["MemberProfileAnswer"] ["profile_answer_id"] = $answer ["item_id"];
					$data ["MemberProfileAnswer"] ["member_id"] = $this->data ["Member"] ["id"];
					$this->Member->MemberProfileAnswer->save_answer ( $data );
				}
				$i ++;
			}
		}
	}
	
	/**
	 * 
	 * The members home page controller action ...
	 */
	function index($ajaxed = false) {
		if ($this->Session->check ( "Member.id" )) {
			$this->loadModel ( "Match" );
			$this->loadModel ( "Country" );
			if (! $ajaxed) {
				$this->layout = "blue_full_block";
			} else {
				$this->layout = "ajax";
				$this->set ( "ajaxed", true );
			}
			$this->load_index ( "all" );
			$this->set ( "process", "home" );
			
			$this->loadMatches ();
			$matches = $this->Match->getRandomMatch ( $this->Session->read ( "Member.id" ), "all" );
			$loadMatches = array ();
			$count = 0;
			if (! empty ( $matches )) {
				foreach ( $matches as $match ) {
					$profile = $this->Member->MemberProfile->find ( "first", array ("conditions" => array ("MemberProfile.member_id" => $match ["Matched"] ["id"] ), "fields" => array ("status", "picture_path", "id" ), "recursive" => - 1 ) );
					if ($profile ["MemberProfile"] ["status"] == "") {
						continue;
					}
					if ($count == 3) {
						break;
					}
					$country = $this->Country->find ( "first", array ("conditions" => array ("Country.id" => $match ["Matched"] ["country_id"] ), "recursive" => - 1 ) );
					$match ["Matched"] ["MemberProfile"] = $profile ["MemberProfile"];
					$match ["Matched"] ["Country"] = $country ["Country"];
					$match ["Matched"] ["age"] = $this->Member->MemberProfile->getAgeV2 ( $match ["Matched"] ["id"] );
					$loadMatches [] = $match;
					$count ++;
				}
				$this->set ( "loadMatches", $loadMatches );
			}
		} else {
			$this->redirect ( array ("action" => "login" ) );
		}
	}
	
	function load_notification() {
		$this->layout = "ajax";
		$member_id = $this->Session->read ( "Member.id" );
		$this->process_load_notification ( $member_id );
	}
	
	function notification_delete($id) {
		if ($this->Member->Notification->delete ( $id )) {
			$this->load_notification ();
			$this->render ( "load_notification", "ajax" );
		}
	
	}
	
	/**
	 * 
	 * Load your matches ...
	 */
	private function loadMatches() {
		$member_id = $this->Session->read ( "Member.id" );
		$member = $this->Member->read ( null, $member_id );
		$this->MatchMaker->getCompatibleCandidates ( $member, array ("registered_date" => date ( "Y-m-d" ), "action" => "all" ) );
	
	}
	
	/**
	 *
	 * Controller for viewing the profile ...
	 * @param $key it could be the username or the userid.
	 */
	
	function profile($key = "") {
		if ($key == "") {
			$this->redirect ( array ("action" => "index" ) );
		}
		$this->layout = "blue_full_block";
		$member = $this->Member->get_by_key ( $key );
		$member_id = $this->Session->read ( "Member.id" );
		if (! empty ( $member )) {
			$this->loadModel ( "ProfileQuestion" );
			$this->loadModel ( "Interest" );
			$this->loadModel ( "InterestType" );
			$this->loadModel ( "Match" );
			$this->Session->write ( "ViewMember.id", $member ["Member"] ["id"] );
			$member ["Member"] ["age"] = $this->Member->MemberProfile->getAgeV2 ( $member ["Member"] ["id"] );
			$this->loadProfileAnswers ( $member ["Member"] ["id"] );
			$this->loadProfileInterests ( $member ["Member"] ["id"] );
			$profile = $this->Member->MemberProfile->find ( "first", array ("conditions" => array ("MemberProfile.member_id" => $member ["Member"] ["id"] ), "recursive" => 2 ) );
			$weightable_profile = $this->Member->MemberProfileAttributeWeight->find ( "first", array ("conditions" => array ("MemberProfileAttributeWeight.member_id" => $member ["Member"] ["id"] ), "recursive" => 1 ) );
			$lookingFor = $this->Member->Gender->find ( "first", array ("conditions" => array ("Gender.id" => $member ["Member"] ["looking_for_id"] ) ) );
			$own_words = $this->Member->InMyOwnWordsAnswer->find ( "all", array ("conditions" => array ("InMyOwnWordsAnswer.member_id" => $member ["Member"] ["id"], "InMyOwnWordsAnswer.in_my_own_words_question_id" => 1 ), "order" => "RAND()", "limit" => 5 ) );
			$match = $this->Match->getMatch ( $member ["Member"] ["id"], $member_id );
			$this->set ( compact ( "match", "profile", "lookingFor", "own_words" ) );
			$this->set ( "member_weights", $this->Weightable->getTopicOpeners ( $member ["Member"] ["id"], 3 ) );
			$this->set ( "weightable_profile", $weightable_profile );
			$this->set ( "view_member", $member );
			$this->set ( "process", "profile" );
			$sameInterests = $this->Interest->getSameInterestTypes ( $member_id, $member ["Member"] ["id"] );
			$this->set ( compact ( "sameInterests" ) );
			$this->load_index ();
			$this->loadModel ( "ViewActivity" );
			$view_activity_id = $this->Notifier->recordViewActivity ( $member ["Member"] ["id"] );
			$firstViewed = $this->ViewActivity->firstViewed ( $member_id, $member ["Member"] ["id"] );
			if ($view_activity_id != "") {
				$this->loadModel ( "Update" );
				$this->Update->createUpdate ( $member ["Member"] ["id"], $view_activity_id, 2 );
			}
			$this->set ( "firstViewed", $firstViewed );
		} else {
			$this->Session->setFlash ( "User does not exist" );
			$this->redirect ( "/" );
		}
	
	}
	
	private function loadProfileAnswers($member_id) {
		$smoke = $this->ProfileQuestion->findAttribute ( 8, $member_id );
		$drink = $this->ProfileQuestion->findAttribute ( 9, $member_id );
		$diet = $this->ProfileQuestion->findAttribute ( 11, $member_id );
		$gym = $this->ProfileQuestion->findAttribute ( 10, $member_id );
		$appearance = $this->ProfileQuestion->findAttribute ( 7, $member_id );
		$haveKids = $this->ProfileQuestion->findAttribute ( 12, $member_id );
		$eyes = $this->ProfileQuestion->findAttribute ( 2, $member_id );
		$hairLength = $this->ProfileQuestion->findAttribute ( 3, $member_id );
		$hairColor = $this->ProfileQuestion->findAttribute ( 4, $member_id );
		$this->set ( compact ( "eyes", "hairColor", "hairLength", "smoke", "drink", "appearance", "haveKids", "diet", "gym" ) );
	}
	
	private function loadProfileInterests($member_id) {
		$types = $this->InterestType->find ( "all", array ("recursive" => - 1 ) );
		$i = 0;
		foreach ( $types as $type ) {
			$interests = $this->Interest->find ( "all", array ("conditions" => array ("Interest.interest_type_id" => $type ["InterestType"] ["id"] ), "recursive" => - 1 ) );
			$j = 0;
			foreach ( $interests as $interest ) {
				$has = $this->Member->MembersInterest->find ( "first", array ("conditions" => array ("MembersInterest.member_id" => $member_id, "MembersInterest.interest_id" => $interest ["Interest"] ["id"] ), "recursive" => - 1 ) );
				if (! empty ( $has )) {
					$interests [$j] ["MembersInterest"] = true;
				}
				
				$j ++;
			}
			$types [$i] ["MembersInterest"] = $interests;
			$i ++;
		}
		$this->set ( "types", $types );
	}
	
	/**
	 *
	 * Controller for viewing the profile ...
	 * @param $key it could be the username or the userid.
	 */
	
	function profile_ajax($key = "") {
		$this->layout = "ajax";
		$member = $this->Member->get_by_key ( $key );
		if ($member) {
			$this->set ( "member", $member );
			$this->Notifier->recordViewActivity ( $member ["Member"] ["id"] );
		} else {
			$this->Session->setFlash ( "User does not exist" );
		}
	}
	
	/**
	 * 
	 * Ajax home action ...
	 */
	function home() {
		$this->index ( true );
		$this->render ( "index", "ajax" );
	}
	
	/**
	 * 
	function autoComplete() {
		Configure::write ( 'debug', 0 );
		$this->layout = 'ajax';
		$query = $_GET["term"];
		$query = Sanitize::escape($query);
		$members = $this->Member->autocomplete($query);
		$this->set ( "members", $members );
	}
	 * Auto complete ...
	 */
	function autocomplete() {
		if ($this->RequestHandler->isAjax ()) {
			Configure::write ( 'debug', 0 );
			$this->layout = 'ajax';
			$query = $_GET ["term"];
			//$query = "Tapion Allanaire";
			$query = Sanitize::escape ( $query );
			$members = $this->Member->autocomplete ( $query );
			$this->set ( "member_id", $this->Session->read ( "Member.id" ) );
			$this->set ( "members", $members );
		}
	}
	
	function autocomplete_member() {
		if ($this->RequestHandler->isAjax ()) {
			Configure::write ( 'debug', 0 );
			$this->layout = 'ajax';
			$query = $_GET ["term"];
			$id = $this->Session->read ( "Member.id" );
			//$query = "Tapion Allanaire";
			$query = Sanitize::escape ( $query );
			$members = $this->Member->autocomplete_message ( $query, $id );
			$this->set ( "member_id", $this->Session->read ( "Member.id" ) );
			$this->set ( "members", $members );
		}
	}
	
	/**
	 * 
	 * Edit ...
	 */
	function edit($layout = "blue_full_block") {
		$this->layout = $layout;
		$this->loadModel ( "Interest" );
		$member_id = $this->Session->read ( "Member.id" );
		if (isset ( $this->passedArgs ["sk"] )) {
			$sk = $this->passedArgs ["sk"];
		} else {
			$sk = "basic";
		}
		if (! empty ( $this->data )) {
			$special = false;
			$fields = array ();
			if ($sk == "philosophy") {
				$fields [] = "";
				$fields [] = "";
			} else if ($sk == "location") {
				$fields [] = "address1";
				$fields [] = "city";
				$fields [] = "state";
			} else if ($sk == "leisure") {
				$this->processEditLeisure ();
			} else if ($sk == "words") {
				$this->processEditWords ();
			} else if ($sk == "basic") {
				$this->processEditBasic ();
			} else {
				$this->processEditInterest ();
			
			}
			$this->redirect ( "/members/edit" );
		
		}
		$this->set ( "member_id", $member_id );
		if ($sk == "basic") {
			$this->loadProfileBasic ();
		} else if ($sk == "words") {
			$this->loadProfileWords ();
		} else if ($sk == "values") {
			$page = $this->passedArgs ["page"];
			$statements = $this->Member->ValueStatement->find ( "list", array ("conditions" => array ("ValueStatement.value_statement_type_id" => $page ), "fields" => array ("id", "statement" ) ) );
			$this->set ( compact ( "statements" ) );
		} else if ($sk == "leisure") {
			$leisures = $this->Member->Leisure->find ( "list", array ("fields" => array ("id", "value" ), "recursive" => - 1 ) );
			$this->set ( "leisures", $leisures );
		} else {
			$this->loadProfileInterest ( $sk );
		}
		
		$this->data = $this->Member->read ( null, $member_id );
		$age = $this->Member->MemberProfile->getAge ( $member_id );
		$this->data ["Member"] ["age"] = $age [0] [0] ["age"];
		$this->set ( "sk", $sk );
		$this->set ( "member", $this->data );
		$this->set ( "process", "account" );
		if (isset ( $this->passedArgs ["sk"] )) {
			if (isset ( $this->passedArgs ["page"] )) {
				$this->set ( "page", $this->passedArgs ["page"] );
				$this->render ( "/elements/blue/members/edit/" . $sk . "_" . $this->passedArgs ["page"], "ajax" );
			
			} else {
				$this->render ( "/elements/blue/members/edit/" . $sk, "ajax" );
			}
		
		}
	}
	
	/**
	 * 
	 * Load Interests based on passed key ...
	 * @param $sk The key
	 */
	private function loadProfileInterest($sk) {
		$this->loadModel ( "InterestType" );
		$interests = $this->InterestType->find ( "first", array ("contains" => array ("Interest.id", "Interest.description" ), "conditions" => array ("InterestType.description" => strtolower ( $sk ) ) ) );
		$this->set ( "interests", $interests );
		if ($sk == "music") {
			$this->loadModel ( "InMyOwnWordsQuestion" );
			$this->loadModel ( "ExpressQuestion" );
			$expressMusic = $this->ExpressQuestion->find ( "first", array ("conditions" => array ("ExpressQuestion.id" => 1 ), "recursive" => 1 ) );
			$musicQuestion = $this->InMyOwnWordsQuestion->find ( "first", array ("fields" => array ("id", "question" ), "conditions" => array ("id" => 6 ), "recursive" => - 1 ) );
			$this->set ( compact ( "musicQuestion", "expressMusic" ) );
		}
	}
	
	/**
	 * 
	 * Load Profile Words ...
	 */
	private function loadProfileWords() {
		if (isset ( $this->passedArgs ["page"] )) {
			$page = $this->passedArgs ["page"];
			$this->loadModel ( "InMyOwnWordsQuestion" );
			$questions = $this->InMyOwnWordsQuestion->find ( "all", array ("conditions" => array ("InMyOwnWordsQuestion.page" => $page ), "recursive" => 0 ) );
			$this->set ( "questions", $questions );
			if ($page == 2) {
				$friendSays = $this->Member->FriendSayTrait->find ( "list", array ("field" => array ("id", "name" ), "recursive" => - 1 ) );
				$this->set ( "friendSays", $friendSays );
			}
		}
	}
	
	/**
	 * Load Profile Basic required variables ...
	 */
	private function loadProfileBasic() {
		$member_id = $this->Session->read ( "Member.id" );
		$this->loadModel ( "EducationalLevel" );
		$levels = $this->EducationalLevel->find ( "list", array ("fields" => array ("id", "value" ), "recursive" => - 1 ) );
		$this->set ( "educationalLevels", $levels );
		$this->loadModel ( "Country" );
		$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name", "recursive" => - 1 ) );
		$this->set ( "countries", $countries );
		$this->loadModel ( "ProfileQuestion" );
		$this->loadModel ( "ProfileAnswer" );
		$smokeList = $this->ProfileAnswer->listAnswers ( 8 );
		$drinkList = $this->ProfileAnswer->listAnswers ( 9 );
		$dietList = $this->ProfileAnswer->listAnswers ( 11 );
		$gymList = $this->ProfileAnswer->listAnswers ( 10 );
		$kidList = $this->ProfileAnswer->listAnswers ( 23 );
		$smoke = $this->ProfileQuestion->findAttribute ( 8, $member_id );
		$drink = $this->ProfileQuestion->findAttribute ( 9, $member_id );
		$diet = $this->ProfileQuestion->findAttribute ( 11, $member_id );
		$gym = $this->ProfileQuestion->findAttribute ( 10, $member_id );
		$kid = $this->ProfileQuestion->findAttribute ( 23, $member_id );
		$this->set ( compact ( "smokeList", "kidList", "drinkList", "dietList", "gymList", "smoke", "drink", "diet", "gym", "kid" ) );
	}
	
	/**
	 * 
	 * Process edit interests ...
	 */
	private function processEditInterest() {
		$special = true;
		$this->loadModel ( "MembersInterest" );
		$this->MembersInterest->save_selected ( $this->data );
		$this->Session->setFlash ( "Profile has been saved!", "default", array ("class" => "success" ) );
		$this->redirect ( "/members/edit" );
	}
	
	/**
	 * Process Edit Words ...
	 */
	private function processEditWords() {
		$fields = array ();
		if (isset ( $this->passedArgs ["page"] )) {
			$page = $this->passedArgs ["page"];
			if ($page == 1) {
				$this->loadModel ( "InMyOwnWordsAnswer" );
				$this->InMyOwnWordsAnswer->saveAnswers ( $this->data );
			} else {
				$this->loadModel ( "MemberProfileAttributeWeight" );
				$this->loadModel ( "MemberProfile" );
				$fields [] = "FriendSayTrait";
				if ($this->Member->edit ( $this->data, $fields )) {
					$fields = array ();
					$this->MemberProfile->edit ( $this->data, $fields );
				}
			}
		}
	}
	
	/**
	 * Process Edit Basic Information ...
	 */
	private function processEditBasic() {
		$special = true;
		$member_id = $this->Session->read ( "Member.id" );
		$this->loadModel ( "MemberProfileAttributeWeight" );
		$this->loadModel ( "MemberProfile" );
		$fields [] = "MemberProfile.occupation";
		$fields [] = "MemberProfile.height_inch";
		$fields [] = "MemberProfile.height_ft";
		$fields [] = "MemberProfile.education_institution";
		if ($this->MemberProfile->edit ( $this->data, $fields )) {
			if ($this->MemberProfileAttributeWeight->edit ( $this->data, $fields )) {
				foreach ( $this->data ["MemberProfileAnswer"] as $answer ) {
					$this->deleteSelectedAnswer ( $answer ["profile_answer_id"], $member_id );
				}
				foreach ( $this->data ["MemberProfileAnswer"] as $answer ) {
					$data ["MemberProfileAnswer"] ["profile_answer_id"] = $answer ["profile_answer_id"];
					$data ["MemberProfileAnswer"] ["member_id"] = $this->data ["Member"] ["id"];
					$this->Member->MemberProfileAnswer->save_answer ( $data );
				}
				$this->Session->setFlash ( "Profile has been saved!", "default", array ("class" => "success" ) );
			
			} else {
				$this->Session->setFlash ( "Information had failed to save!", "default", array ("class" => "success" ) );
			
			}
		} else {
			$this->Session->setFlash ( "Information had failed to save!", "default", array ("class" => "success" ) );
		}
	}
	
	/**
	 * Process Edit Leisure ...
	 */
	private function processEditLeisure() {
		$fields [] = "Leisure";
		if ($this->Member->edit ( $this->data, $fields )) {
			$this->Session->setFlash ( "Profile has been saved!", "default", array ("class" => "success" ) );
		} else {
			$this->Session->setFlash ( "Information had failed to save!", "default", array ("class" => "success" ) );
		}
	}
	
	function email_activation($password = "") {
		if (($password != "") && ($this->Session->check ( "Member.id" ))) {
			$member_id = $this->Session->read ( "Member.id" );
			$member = $this->Member->read ( array ("email", "activation_code", "lastname", "firstname" ), $member_id );
			$this->Email->from = "Qalanjo Mailer<noreply@qalanjo.com>";
			$this->Email->to = $member ["Member"] ["email"];
			$this->Email->subject = "Welcome to Qalanjo.com";
			$this->Email->replyTo = "support@qalanjo.com";
			$this->Email->template = "simple_email";
			$this->Email->sendAs = "html";
			$this->set ( 'smtp_errors', $this->Email->smtpError );
			$this->set ( "member", $member );
			$this->set ( "password", $password );
			$this->Email->send ();
		} else {
			$this->redirect ( "/login" );
		}
	}
	function signup_congrats() {
		$member_id = $this->Session->read ( "Member.id" );
		$role_id = $this->Member->getRole ( $member_id );
		if ($role_id == 1) {
			$this->Member->updateRole ( 3, $member_id );
		}
		$this->Session->write ( "userid", $member_id );
		$this->layout = "personal_assessment";
		$this->set ( "step", "Congratulations" );
		$this->set ( "set", "Congratulations" );
		$this->set ( "progress", 100 );
	}
	
	function viewer() {
		$member_id = $this->Session->read ( "Member.id" );
		$this->layout = "ajax";
		$viewers = $this->Notifier->listViewers ( $member_id );
		$this->set ( "viewers", $viewers );
	}
	
	function find_by_criteria($option = 1) {
		$this->layout = "ajax";
		$member_id = $this->Session->read ( "Member.id" );
		if (! empty ( $this->data )) {
			$this->Session->write ( "find_by_criteria", $this->data );
		} else if (isset ( $this->passedArgs ["page"] ) && (isset ( $this->passedArgs ["page_count"] ))) {
			if ($this->Session->check ( "find_by_criteria" )) {
				$this->data = $this->Session->read ( "find_by_criteria" );
			} else {
				$this->data = array ();
			}
		}
		if (! empty ( $this->data )) {
			if ($option == 1) {
				$members = $this->Member->findByCriteria ( $this->data, $member_id );
			} else if ($option == 2) {
				$members = $this->Member->findByKeyword ( $this->data, $member_id );
			}
			if ($members) {
				$result = array ();
				if (isset ( $this->passedArgs ["page"] ) && (isset ( $this->passedArgs ["page_count"] ))) {
					$page = $this->passedArgs ["page"];
					$page_count = $this->passedArgs ["page_count"];
				} else {
					$page = 1;
					$page_count = 10;
				}
				$this->paginate_members ( $members, $page, $page_count );
			} else {
				$this->Session->setFlash ( "Nothing is found." );
			}
		}
		$this->set ( "option", $option );
	}
	
	function paginate_members($members, $page = 1, $page_count = 10) {
		if (! empty ( $members )) {
			$result = array ();
			if (count ( $members ) > $page_count) {
				$upper_bound = $page * $page_count;
				$lower_bound = ($upper_bound - ($page_count));
				for($i = $lower_bound; $i < $upper_bound; $i ++) {
					$result [] = $members [$i];
				}
				$this->set ( "members", $result );
			} else {
				$this->set ( "members", $members );
			}
			$this->set ( "page", $page );
			$this->set ( "page_count", $page_count );
			$this->set ( "record_total", count ( $members ) );
		} else {
			$this->set ( "members", $members );
		}
	
	}
	
	function search() {
		$this->layout = "blue_full_block";
		$this->loadModel ( "Country" );
		$this->loadModel ( "Distance" );
		$this->loadModel ( "State" );
		$member_id = $this->Session->read ( "Member.id" );
		$this->data = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), "recursive" => 1 ) );
		$genders = $this->Member->Gender->find ( "list", array ("fields" => array ("id", "value" ), "order" => "id desc" ) );
		$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name", "recursive" => - 1 ) );
		$distances = $this->Distance->find ( "list", array ("fields" => array ("id", "label" ), "recursive" => - 1 ) );
		$states = $this->State->find ( "list", array ("fields" => array ("id", "name" ), "recursive" => - 1 ) );
		$new_members = $this->Member->find ( "all", array ("conditions" => array ("Member.id <>" => $member_id, "Member.gender_id" => $this->data ["Member"] ["looking_for_id"] ), "recursive" => 1, "limit" => 4, "order" => "Member.firstname" ) );
		$this->set ( "countries", $countries );
		$this->set ( "genders", $genders );
		$this->set ( "states", $states );
		$this->set ( "distances", $distances );
		$this->set ( "new_members", $new_members );
	}
	
	function search_result() {
		$this->layout = "blue_full_block";
		$member_id = $this->Session->read ( "Member.id" );
		$this->loadModel ( "Country" );
		$this->loadModel ( "State" );
		$this->loadModel ( "Distance" );
		if (! empty ( $this->data )) {
			$user = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ) ) );
			if ($this->data ["Member"] ["online_now"] == 1) {
				$members = $this->Member->find ( "all", array ("conditions" => array ("Member.id <>" => $member_id, "Member.online" => 1, "Member.gender_id" => $user ["Member"] ["looking_for_id"] ), "recursive" => 1 ) );
			} else {
				$members = $this->Member->find ( "all", array ("conditions" => array ("Member.id <>" => $member_id, "Member.gender_id" => $user ["Member"] ["looking_for_id"] ), "recursive" => 1 ) );
			}
			$final_members = array ();
			$country = $this->Country->find ( "first", array ("conditions" => array ("Country.id" => $this->data ["Member"] ["country_id"] ) ) );
			$preferedDistance = $this->Distance->find ( "first", array ("conditions" => array ("Distance.id" => $this->data ["Member"] ["distance_id"] ) ) );
			if ($country ["Country"] ["country_code"] == "US") {
				$state = $this->State->find ( "first", array ("conditions" => array ("State.id" => $this->data ["Member"] ["state"] ), "recursive" => - 1 ) );
				$startAddress = $state ["State"] ["name"] . "," . $country ["Country"] ["name"];
			} else {
				$startAddress = $country ["Country"] ["name"];
			}
			foreach ( $members as $member ) {
				$address = $this->MatchMaker->getFullAddress ( $member );
				$HttpSocket = new HttpSocket ();
				$HttpSocket->get ( "http://maps.googleapis.com/maps/api/geocode/json", array ("address" => $startAddress, "sensor" => "false" ) );
				$result1 = $HttpSocket->response;
				$HttpSocket->get ( "http://maps.googleapis.com/maps/api/geocode/json", array ("address" => $address, "sensor" => "false" ) );
				$result2 = $HttpSocket->response;
				$result1 = json_decode ( $result1 ["raw"] ["body"] );
				$result2 = json_decode ( $result2 ["raw"] ["body"] );
				if (($result1->status == "OK") && ($result2->status == "OK")) {
					if ($country ["Country"] ["country_code"] == "US") {
						$HttpSocket->get ( "http://maps.googleapis.com/maps/api/directions/json", array ("origin" => $startAddress, "destination" => $address, "sensor" => "false" ) );
						$result3 = json_decode ( $HttpSocket->response ["raw"] ["body"] );
						$lowest = 0;
						$i = 0;
						foreach ( $result3->routes as $route ) {
							foreach ( $route->legs as $leg ) {
								if ($i == 0) {
									$lowest = $leg->distance->value;
								} else if ($lowest > $leg->distance->value) {
									$lowest = $leg->distance->value;
								}
								$i ++;
							}
						}
						
						$distance = ($lowest / 1000) * 0.621371192;
						if ($distance <= $preferedDistance ["Distance"] ["distance"]) {
							$final_members [] = $member;
						}
					} else {
						$distance = $this->DistanceCalculate->getDistance ( $result1->results [0]->geometry->location->lat, $result2->results [0]->geometry->location->lat, $result1->results [0]->geometry->location->lng, $result2->results [0]->geometry->location->lng );
						if ($distance <= $preferedDistance ["Distance"] ["distance"]) {
							$final_members [] = $member;
						}
					}
				}
			}
			
			$this->set ( "members", $final_members );
			$this->set ( "search_data", $this->data );
		}
		$genders = $this->Member->Gender->find ( "list", array ("fields" => array ("id", "value" ), "order" => "id desc" ) );
		$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name", "recursive" => - 1 ) );
		$distances = $this->Distance->find ( "list", array ("fields" => array ("id", "label" ), "recursive" => - 1 ) );
		$states = $this->State->find ( "list", array ("fields" => array ("id", "name" ), "recursive" => - 1 ) );
		$member_id = $this->Session->read ( "Member.id" );
		$user = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), array ("recursive" => 1 ) ) );
		$this->set ( compact ( "countries", "genders", "states", "distances", "user" ) );
	}
	
	function update() {
		$this->layout = "ajax";
		if (! empty ( $this->data )) {
			$field [] = "status";
			if ($this->Member->MemberProfile->edit ( $this->data, $field )) {
				$member_id = $this->Session->read ( "Member.id" );
				$member = $this->Member->find ( "first", array ("Member.id" => $member_id ) );
				$this->set ( "member", $member );
				$this->render ( "update_success", "ajax" );
				return;
			} else {
				$this->Session->setFlash ( "Request processing error", "default", array ("class" => "error" ) );
				$this->render ( "update_failed", "ajax" );
			}
		}
		$field = $this->passedArgs ["field"];
		$member_id = $this->Session->read ( "Member.id" );
		$this->data = $this->Member->read ( array ("MemberProfile.id", "MemberProfile.status" ), $member_id );
		$this->set ( "field", $field );
	}
	
	function deactivate() {
		$this->layout = "full_block";
	}
	function process_deactivate() {
	
	}
	
	function account($type = "general") {
		if (! empty ( $this->data )) {
			if ($type == "general") {
				$fields [] = "lastname";
				$fields [] = "firstname";
				if (($this->data ["Member"] ["email"] != "") && ($this->data ["Member"] ["confirm_email"] != "")) {
					$fields [] = "email";
					$fields [] = "confirm_email";
				} else {
					unset ( $this->data ["Member"] ["email"] );
					unset ( $this->data ["Member"] ["confirm_email"] );
				}
				if ((trim ( $this->data ["Member"] ["oldpassword"] ) != "") && (trim ( $this->data ["Member"] ["confirm_password"] ) != "") && (trim ( $this->data ["Member"] ["password"] ) != "")) {
					$fields [] = "oldpassword";
					$fields [] = "confirm_password";
					$fields [] = "password";
				} else {
					unset ( $this->data ["Member"] ["oldpassword"] );
					unset ( $this->data ["Member"] ["confirm_password"] );
					unset ( $this->data ["Member"] ["password"] );
				}
				$this->data = Sanitize::clean ( $this->data );
				if ($this->data ["Member"] ["gender_id"] == 1) {
					$this->data ["Member"] ["looking_for_id"] = 2;
				} else {
					$this->data ["Member"] ["looking_for_id"] = 1;
				}
			} else if ($type == "billing") {
				$fields [] = "city";
				$fields [] = "state";
			}
			$this->loadModel ( "Match" );
			if ($this->Member->edit ( $this->data, $fields )) {
				$this->Match->deleteAll ( array ("Match.member_id" => $this->data ["Member"] ["id"] ) );
				$this->Session->setFlash ( "Account has been successfully updated", "default", array ("class" => "success left clear flash-setting" ) );
			} else {
				$this->Session->setFlash ( "One of the field/s has errors", "default", array ("class" => "error left clear flash-setting" ) );
			}
		}
		$member_id = $this->Session->read ( "Member.id" );
		$this->load_index ();
		$this->set ( "role", $this->Member->getRole ( $member_id ) );
		$this->Member->removeHasMany ();
		$this->data = $this->Member->read ( null, $member_id );
		$this->set ( "member", $this->data );
		if ($type == "general") {
			$this->loadModel ( "Gender" );
			$genders = $this->Gender->find ( "list", array ("fields" => array ("id", "value" ), "recursive" => - 1 ) );
			$this->set ( "genders", $genders );
		} else if ($type == "billing") {
			$this->loadModel ( "Country" );
			$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name" ) );
			$this->set ( "countries", $countries );
		}
		$this->set ( "settings", "account" );
		$this->set ( "type", $type );
		if ($this->RequestHandler->isAjax ()) {
			$this->render ( "/elements/blue/members/account/" . $type, "ajax" );
		} else {
			$this->layout = "blue_full_block";
		}
	
	}
	
	function payment() {
		$this->account ();
	}
	
	function settings() {
		$this->layout = "settings";
		$member_id = $this->Session->read ( "Member.id" );
		$this->load_index ();
		if (empty ( $this->data )) {
			$this->data = $this->Member->read ( null, $member_id );
		}
		$this->set ( "settings", "match" );
	}
	
	function match_tribe_save() {
		if (! empty ( $this->data )) {
			$fields = array ();
			$fields [] = "age_from";
			$fields [] = "age_to";
			$member_id = $this->Session->read ( "Member.id" );
			if ($this->Member->MemberSetting->edit ( $this->data, $fields )) {
				$this->deleteSelectedAnswer ( $this->data ["Member"] ["tribe_belong"], $member_id );
				$data ["MemberProfileAnswer"] ["profile_answer_id"] = $this->data ["Member"] ["tribe_belong"];
				$data ["MemberProfileAnswer"] ["member_id"] = $member_id;
				$this->MemberProfileAnswer->save_answer ( $data );
				$this->set ( "path", "match" );
				$this->Session->setFlash ( "Settings has been saved!", "default", array ("class" => "success" ) );
				$this->render ( "settings_update", "ajax" );
				return;
			} else {
				$this->Session->setFlash ( "Settings failed to save!", "default", array ("class" => "error" ) );
				$this->set ( "path", "match" );
				$this->render ( "settings_update", "ajax" );
				return;
			}
		}
	}
	
	function match_settings($type = "basic") {
		$this->layout = "blue_full_block";
		$this->set ( "process", "account" );
		$member_id = $this->Session->read ( "Member.id" );
		if (! empty ( $this->data )) {
			$this->loadModel ( "MemberProfileAnswer" );
			$fields [] = "zipcode";
			$fields [] = "country_id";
			$fields [] = "city";
			$fields [] = "state";
			if ($this->Member->edit ( $this->data, $fields )) {
				$fields = array ();
				$fields [] = "age_from";
				$fields [] = "age_to";
				if ($this->Member->MemberSetting->edit ( $this->data, $fields )) {
					if (isset ( $this->data ["Member"] ["smoking"] )) {
						$this->deleteSelectedAnswer ( $this->data ["Member"] ["smoking"], $member_id );
						$data ["MemberProfileAnswer"] ["profile_answer_id"] = $this->data ["Member"] ["smoking"];
						$data ["MemberProfileAnswer"] ["member_id"] = $member_id;
						$this->MemberProfileAnswer->save_answer ( $data );
					}
					if (isset ( $this->data ["Member"] ["drinking"] )) {
						$this->deleteSelectedAnswer ( $this->data ["Member"] ["drinking"], $member_id );
						$data ["MemberProfileAnswer"] ["profile_answer_id"] = $this->data ["Member"] ["drinking"];
						$data ["MemberProfileAnswer"] ["member_id"] = $member_id;
						$this->MemberProfileAnswer->save_answer ( $data );
					}
					
					/*
					$this->deleteSelectedAnswer($this->data["Member"]["tribe_belong"], $member_id);					
					$data["MemberProfileAnswer"]["profile_answer_id"] = $this->data["Member"]["tribe_belong"];
					$data["MemberProfileAnswer"]["member_id"] = $member_id;
					$this->MemberProfileAnswer->save_answer($data);
					*/
					$this->set ( "path", "match" );
					$this->loadModel ( "Match" );
					$this->Match->deleteMatches ( $member_id );
					$this->Session->setFlash ( "Settings has been saved!", "default", array ("class" => "success" ) );
					$this->redirect ( "/members/match_settings/" . $type );
				} else {
					$this->Session->setFlash ( "Settings failed to save!", "default", array ("class" => "error" ) );
					$this->set ( "path", "match" );
					$this->redirect ( "/members/match_settings/" . $type );
				}
			} else {
				$this->Session->setFlash ( "Settings failed to save!", "default", array ("class" => "error" ) );
				$this->set ( "path", "match" );
				$this->redirect ( "/members/match_settings/" . $type );
			}
		}
		$this->set ( "settings", "match" );
		$this->load_index ();
		if (empty ( $this->data )) {
			$this->data = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), "recursive" => 1 ) );
		}
		/**
		 * Match Settings ...
		 */
		$auto_archive = array (1 => "Yes please automatically archive matches closes to me", 0 => "No, please do not automatically archive matches closes to me" );
		$this->set ( "auto_archive", $auto_archive );
		
		/**
		 * Distance Settings
		 */
		
		$this->loadModel ( "Country" );
		$this->loadModel ( "Distance" );
		$countries = $this->Country->find ( "list" );
		$distances = $this->Distance->find ( "list", array ("order" => "id desc" ) );
		$this->set ( compact ( "countries", "distances" ) );
		
		/**
		 * Personal Preference
		 */
		$this->loadQuestion ( 8, "smoking" );
		$this->loadQuestion ( 9, "drinking" );
		$age = $this->Member->MemberProfile->getAgeV2 ( $member_id );
		$smoke = $this->ProfileQuestion->findAttribute ( 8, $member_id );
		$drink = $this->ProfileQuestion->findAttribute ( 9, $member_id );
		$this->set ( "selectedSmoke", $smoke );
		$this->set ( "selectedDrink", $drink );
		/**
		 * Background
		 */
		$this->loadQuestion ( 6, "tribe" );
		$this->set ( "age", $age );
		
		$this->set ( "role", $this->Member->getRole ( $member_id ) );
		
		$this->set ( "member_id", $member_id );
		/*
		$this->loadModel("Tribe");
		$tribes =	$this->Tribe->find("list");
		$setting = $this->Member->MemberSetting->find("first", array("conditions"=>array("MemberSetting.id"=>$this->data["MemberSetting"]["id"])));
		$option = array();
		if (isset($setting["Tribe"])){
			foreach($setting["Tribe"] as $tribe){
				$option[]=$tribe["id"];
			}
		}
		$this->set("tribe_selected", $option);
		$this->set("tribes", $tribes);
		*/
		$this->set ( "type", $type );
		$this->render ( "/elements/blue/members/match_settings/" . $type, "blue_full_block" );
	
	}
	private function deleteSelectedAnswer($id, $member_id) {
		$this->loadModel ( "ProfileQuestion" );
		$this->loadModel ( "MemberProfileAnswer" );
		$answer = $this->ProfileQuestion->ProfileAnswer->find ( "first", array ("conditions" => array ("ProfileAnswer.id" => $id ) ) );
		$question = $this->ProfileQuestion->find ( "first", array ("conditions" => array ("ProfileQuestion.id" => $answer ["ProfileAnswer"] ["profile_question_id"] ) ) );
		foreach ( $question ["ProfileAnswer"] as $answer ) {
			$this->MemberProfileAnswer->deleteAll ( array ("MemberProfileAnswer.member_id" => $member_id, "MemberProfileAnswer.profile_answer_id" => $answer ["id"] ) );
		}
	}
	
	/**
	 * Load Question based and saved a accessible variable ...
	 */
	private function loadQuestion($id, $variable) {
		
		$this->loadModel ( "ProfileQuestion" );
		$smoking = $this->ProfileQuestion->find ( "first", array ("conditions" => array ("ProfileQuestion.id" => $id ) ) );
		$options = array ();
		if (isset ( $smoking ["ProfileAnswer"] )) {
			foreach ( $smoking ["ProfileAnswer"] as $answer ) {
				$options [$answer ["id"]] = $answer ["answer"];
			}
		}
		$this->set ( $variable, $options );
	}
	
	function cancel_save_settings() {
		$this->redirect ( "" );
	}
	
	function update_account() {
		if (! empty ( $this->data )) {
			$this->data = Sanitize::clean ( $this->data );
			if (isset ( $this->data ["Member"] ["sk"] )) {
				$sk = $this->data ["Member"] ["sk"];
			} else {
				$sk = $this->data ["CreditCard"] ["sk"];
			}
			if ($sk == "name") {
				$fields [] = "lastname";
				$fields [] = "firstname";
				$fields [] = "middlename";
			} else if ($sk == "password") {
				$fields [] = "oldpassword";
				$fields [] = "password";
				$fields [] = "confirm_password";
			} else if ($sk == "username") {
				$fields [] = "username";
			} else if ($sk == "billing") {
				$fields [] = "address1";
				$fields [] = "address2";
				$fields [] = "city";
				$fields [] = "state";
			} else if ($sk == "credit_card") {
				$fields [] = "card_number";
				$fields [] = "cv_code";
				$fields [] = "expiration_year";
				$fields [] = "expiration_month";
			}
			$this->data = Sanitize::clean ( $this->data );
			$this->loadModel ( "Country" );
			$this->loadModel ( "CreditCard" );
			$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name" ) );
			$this->set ( "countries", $countries );
			if ($sk != "credit_card") {
				$model = "Member";
			} else {
				$model = "CreditCard";
				$this->data ["CreditCard"] ["expiration_year"] = $this->data ["CreditCard"] ["expiration_year"] ["year"];
				$this->data ["CreditCard"] ["expiration_month"] = $this->data ["CreditCard"] ["expiration_month"] ["month"];
			}
			
			if ($this->$model->edit ( $this->data, $fields )) {
				$this->Session->setFlash ( "Account has been successfully updated", "default", array ("class" => "success" ) );
				$this->render ( $sk . "_update_success", "ajax" );
			
			} else {
				$this->Session->setFlash ( "Request processing error", "default", array ("class" => "error" ) );
				$this->render ( $sk . "_update_failed", "ajax" );
			
			}
		}
	}
	
	function wink($id = null) {
		if ($id != null) {
			$this->layout = "ajax";
			$this->loadModel ( "Wink" );
			
			$member_id = $this->Session->read ( "Member.id" );
			$this->Wink->wink_at ( $member_id, $id );
			$member = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ) ) );
			$winked = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $id ) ) );
			$message = " winked at you";
			$wink_id = $this->Wink->getLastInsertId ();
			$this->loadModel ( "Update" );
			$this->Update->createUpdate ( $id, $wink_id, 1 );
			$this->set ( "winked", $winked );
			$this->render ( "/elements/wink-success", "ajax" );
		}
	}
	
	function connect($id = null) {
		if (! id) {
			$member_id = $this->Session->read ( "member_id" );
			$this->loadModel ( "Connection" );
			$this->data ["Connection"] ["member_id"] = $member_id;
			$this->data ["Connection"] ["partner_id"] = $id;
			if ($this->Connection->connect ( $this->data )) {
				$partner = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), "recursive" => - 1 ) );
				$this->Session->setFlash ( "You have successfully connected with " . $partner ["Member"] ["firstname"] . ".", "default", array ("class" => "success" ) );
				$this->render ( "/responses", "ajax" );
			} else {
				$this->Session->setFlash ( "Request error", "default", array ("class" => "error" ) );
				$this->render ( "/responses", "ajax" );
			}
		}
	}
	
	function getMember($member_id, $recursive = 1) {
		return $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), "recursive" => $recursive ) );
	}
	
	function getMemberJSON($member_id, $recursive = -1) {
		if ($this->RequestHandler->isAjax ()) {
			$this->set ( "response", json_encode ( $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $member_id ), "recursive" => $recursive ) ) ) );
			$this->render ( "/elements/response", "ajax" );
		}
	}
	
	function email_settings() {
		$this->layout = "settings_new";
		$this->set ( "process", "account" );
		$member_id = $this->Session->read ( "Member.id" );
	
	}
	
	/**
	 * 
	 * Credit card information ...
	 */
	function credit() {
		$this->layout = "full_block_new";
		$id = $this->Session->read ( "Member.id" );
		$points = $this->Member->get_q_points ( $id );
		$this->set ( "points", $points );
	}
	
	function forgot_password() {
		$this->layout = "blue_full_block_no_tab";
		if (! empty ( $this->data )) {
			if ($this->RequestHandler->isAjax ()) {
				if ($this->data ["Member"] ["state"] == 0) {
					$this->emailReset ();
				} else {
					$this->set ( "response", "false" );
					$this->render ( "/elements/responses", "ajax" );
				}
			
			}
		}
	
	}
	
	function forgot_password_success() {
		$this->layout = "blue_full_block_no_tab";
	}
	
	private function emailReset() {
		$member = $this->Member->find ( "first", array ("conditions" => array ("Member.email" => $this->data ["Member"] ["forgot_email"] ) ) );
		if ($member) {
			$reset = Security::generateAuthKey ();
			$member ["Member"] ["reset_code"] = $reset;
			$this->Member->save ( $member, false );
			$this->Email->from = "Qalanjo Mailer<noreply@qalanjo.com>";
			$this->Email->to = $member ["Member"] ["email"];
			$this->Email->subject = "Forgot Password";
			$this->Email->replyTo = "support@qalanjo.com";
			$this->Email->template = "simple_reset";
			$this->Email->sendAs = "html";
			$this->set ( 'smtp_errors', $this->Email->smtpError );
			$this->set ( "member", $member );
			$this->Email->send ();
			$this->set ( "response", "true" );
			$this->render ( "/elements/responses", "ajax" );
		} else {
			$result ["error"] = "Email <span class=\"account\">{$this->data["Member"]["forgot_email"]}</span> Was Not Found in Our System";
			$this->set ( "response", json_encode ( $result ) );
			$this->render ( "/elements/responses", "ajax" );
		}
	
	}
	
	/**
	 * 
	 * Find member for message rendering use ...
	 * @param $id
	 */
	function find_for_message($id) {
		Configure::write ( "debug", 0 );
		if ($this->RequestHandler->isAjax ()) {
			$this->layout = "ajax";
			$this->Member->id = $id;
			$member = $this->Member->find ( "first", array ("conditions" => array ("Member.id" => $id ), "fields" => array ("Member.lastname", "Member.firstname", "Member.id", "Gender.id", "Gender.value", "MemberProfile.picture_path" ) ) );
			$this->set ( compact ( "member" ) );
		}
	}
	
	/**
	 * 
	 * Find for rendering for wink...
	 * @param $id
	 */
	function find_for_wink($id) {
		
		$this->find_for_message ( $id );
	}
	
	/**
	 * 
	 * Collectively calls for winks, icebreakers and receive messages in formatted HTML format. To be feed
	 * in the accordion item ...
	 * @version 0.0.1
	 * @date 5/21/2011
	 * 
	 */
	function loadCommunications($limit = 3) {
		if ($this->RequestHandler->isAjax ()) {
			
			$member_id = $this->Session->read ( "Member.id" );
			$this->loadModel ( "Wink" );
			$this->loadModel ( "SentIceBreaker" );
			$this->loadModel ( "PrivateMessage" );
			$this->loadModel ( "Country" );
			$messages = $this->PrivateMessage->ReceiveMessage->loadMessages ( $member_id );
			$loadedMessages = array ();
			foreach ( $messages as $message ) {
				$pm = $this->PrivateMessage->loadMessageForCommunication ( $message ["PrivateMessage"] ["id"] );
				$profile = $this->Member->MemberProfile->find ( "first", array ("conditions" => array ("MemberProfile.member_id" => $message ["PrivateMessage"] ["member_id"] ), "recursive" => - 1 ) );
				$country = $this->Country->find ( "first", array ("conditions" => array ("Country.id" => $pm ["Member"] ["country_id"] ), "recursive" => - 1 ) );
				$pm ["MemberProfile"] = $profile ["MemberProfile"];
				$pm ["Country"] = $country ["Country"];
				$pm ["ReceiveMessage"] ["id"] = $message ["ReceiveMessage"] ["id"];
				$pm ["ReceiveMessage"] ["created"] = $message ["ReceiveMessage"] ["created"];
				$loadedMessages [] = $pm;
			}
			$winklist = $this->Wink->getWinkListForCommunication ( $member_id );
			$winks = array ();
			foreach ( $winklist as $wink ) {
				$profile = $this->Member->MemberProfile->find ( "first", array ("conditions" => array ("MemberProfile.member_id" => $wink ["Winker"] ["id"] ), "recursive" => - 1 ) );
				$country = $this->Country->find ( "first", array ("conditions" => array ("Country.id" => $wink ["Winker"] ["country_id"] ), "recursive" => - 1 ) );
				$wink ["MemberProfile"] = $profile ["MemberProfile"];
				$wink ["Country"] = $country ["Country"];
				$winks [] = $wink;
			}
			$icebreakers = $this->SentIceBreaker->getSentIceBreakerForCommunications ( $member_id );
			$sentIceBreakers = array ();
			foreach ( $icebreakers as $breaker ) {
				$profile = $this->Member->MemberProfile->find ( "first", array ("conditions" => array ("MemberProfile.member_id" => $breaker ["Member"] ["id"] ), "recursive" => - 1 ) );
				$country = $this->Country->find ( "first", array ("conditions" => array ("Country.id" => $breaker ["Member"] ["country_id"] ), "recursive" => - 1 ) );
				$breaker ["MemberProfile"] = $profile ["MemberProfile"];
				$breaker ["Country"] = $country ["Country"];
				$sentIceBreakers [] = $breaker;
			}
			$this->set ( compact ( "loadedMessages", "winks", "sentIceBreakers" ) );
			$this->set ( "limit", $limit );
			$this->render ( "/elements/blue/members/index/communication_content", "ajax" );
		}
	
	}
	
	/**
	 * 
	 * Count Communication ...
	 */
	function countCommunications() {
		if ($this->RequestHandler->isAjax ()) {
			$this->loadModel ( "Wink" );
			$this->loadModel ( "SentIceBreaker" );
			$this->loadModel ( "PrivateMessage" );
			$this->loadModel ( "Country" );
			$member_id = $this->Session->read ( "Member.id" );
			$messages = $this->PrivateMessage->ReceiveMessage->loadMessages ( $member_id );
			$icebreakers = $this->SentIceBreaker->getSentIceBreakerForCommunications ( $member_id );
			$winklist = $this->Wink->getWinkListForCommunication ( $member_id );
			$this->set ( "response", count ( $messages ) + count ( $icebreakers ) + count ( $winklist ) );
			$this->render ( "/elements/responses", "ajax" );
		}
	}
	
	function send_connection($view_member_id) {
		if ($this->RequestHandler->isAjax ()) {
			$view_member_id = Sanitize::escape ( $view_member_id );
			$member_id = $this->Session->read ( "Member.id" );
			$this->Member->requestFriends ( $member_id, $view_member_id );
		}
	}
	
	function check_session($id = -1) {
		//if ($this->RequestHandler->isAjax()){
		if ($this->RequestHandler->isAjax ()) {
			if ($this->Session->check ( "Member.id" )) {
				$this->set ( "response", "true" );
			} else {
				if ($id != - 1) {
					if ($this->Member->isOnline ( $id ) == 1) {
						$this->Session->write ( "Member.id", $id );
						$this->set ( "response", "true" );
					}
				} else {
					$this->set ( "response", "false" );
				}
			}
		
		//}
		} else {
			$this->set ( "response", "true" );
		}
	}
	
	function update_online() {
		if ($this->RequestHandler->isAjax ()) {
			if ($this->Session->check ( "Member.id" )) {
				$member_id = $this->Session->read ( "Member.id" );
				$this->Member->updateOnline ( $member_id, true );
				$this->set ( "response", "true" );
			} else {
				$this->set ( "response", "false" );
			}
			$this->render ( "/elements/response", "ajax" );
		}
	}
	
	
	function questionnaire_success(){
		$this->layout = "personal_assessment";
		$this->set("progressSet", "");
		$this->set("pageSet", "Success");
		$this->set("perc", 100);
		$this->loadModel("Match");
		$this->loadMatches ();
		$count = count($this->Match->getMatches($this->Session->read("Member.id")));
		$this->set("count", $count);
	}

}
?>