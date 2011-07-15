<?php
/**
 * 
 * Creation of profile completion ...
 * @author Josef Balisalisa and Allanaire Tapion
 *
 */
class ProfileCompletorHelper extends AppHelper{
	var $helpers = array('Html','Ajax','Session','Form');

	function page1($statuses, $questions = array()){
		$out = "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.=$this->Form->label("MemberProfile.birthdate", "What is your birth date");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear clear\">";
				$out.="<div class='date'>";
				$out .= $this->Form->input('MemberProfile.birthdate',array("type"=>"date","label"=>false, "div"=>false, "class"=>"dates", "minYear"=>date("Y")-60, "maxYear"=>date("Y")-18));
				$out.="</div>";
			$out.="</div>";
		$out.="</div>";
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
				$out.=$this->Form->label("MemberProfileAttributeWeight.birthdate_weight", "How important is your match's age?");	
			$out.="</div>";
			$out.="<div class=\"span-8 last clear clear\">";
				$out.=$this->Form->input("MemberProfileAttributeWeight.birthdate_weight", array("type"=>"hidden"));
				$out .="<div class='slider' id='birthdate_weight'>";		
				$out .= "</div>";
				$out .="<div id='output_birthdate_weight'></div>";	
			$out.="</div>";
		$out.="</div>";
		
		$options = array();
		foreach($statuses as $status){
			$options[$status["MaritalStatus"]["id"]] = $status["MaritalStatus"]["value"];
		}
		
		$out .= "<div class=\"span-18 last row bc-wrap3\">";
			$out.="<div class=\"span-10\">";
				$out.=$this->Form->label("MemberProfile.marital_status_id", "What is your current marital status?");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<div class='radio_list'>";
				$out.=$this->Form->radio("MemberProfile.marital_status_id", $options, array("legend"=>false, "separator"=>"<br/>", 'hiddenField' => false));
				
				$out.="</div>";	
			$out.="</div>";
		$out.="</div>";
	
	
		
		
		$out.=$this->buildQuestion($questions[0], 0, 4);
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.= $this->Form->label("Member.height", "How tall are you?");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out .= $this->Form->input('MemberProfile.height_ft', array('div'=>false, "label"=>false, "class"=>"numerics"));
				$out .= $this->Form->label('MemberProfile.height_ft','ft ', array("class"=>"inline"));
				$out .= $this->Form->input('MemberProfile.height_inch', array('div'=>false, "label"=>false, "class"=>"numerics"));
				$out .= $this->Form->label('MemberProfile.height_inch','inch ', array("class"=>"inline"));	
			$out.="</div>";
		$out.="</div>";
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.= $this->Form->label("MemberProfile.leisure_activity", "What do you usually do during your leisure time?");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<br/>";
				$out.=$this->Form->input("MemberProfile.leisure_activity", array("div"=>false, "label"=>false));				
			$out.="</div>";
		$out.="</div>";
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.= $this->Form->label("MemberProfile.match_want", "What would you want to tell to a possible match?");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<br/>";
				$out.=$this->Form->input("MemberProfile.match_want", array("div"=>false, "label"=>false));				
			$out.="</div>";
		$out.="</div>";
		
		$out.="<div id=\"buttons\">";
			$out.= $this->Form->submit("Save", array("div"=>false));
					
        $out.="</div>";
		
		return $out;
	}
	
	
	/**
	 * 
	 * Build question based on plugged question ...
	 * @param $question
	 * @param $increment
	 */
	private function buildQuestion($question, $increment, $number){
		$options = array();
		foreach($question["ProfileAnswer"] as $answer){
			$options[$answer["id"]] = $answer["answer"];
		}
		$out = "<div class=\"span-18 last row bc-wrap3\">";
			$out.="<div class=\"span-10\">";
			$out .=$this->Form->label("MemberProfileAnswer.$increment.item_id", $question["ProfileQuestion"]["question"]);	
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<div class='radio_list'>";
				if ($question["ProfileQuestionType"]["value"]=="radio"){
					$out.=$this->Form->radio("MemberProfileAnswer.$increment.item_id", $options, array("legend"=>false, "separator"=>"<br/>", 'hiddenField' => false));
				}else{
					$out.=$this->Form->input("MemberProfileAnswer.$increment.item_id", array("type"=>"select", "label"=>false, "multiple"=>"checkbox", "options"=>$options, "separator"=>"<br/>", 'hiddenField' => false));		
				}
				$out.=$this->Form->input("MemberProfileAnswer.$increment.question_id", array("type"=>"hidden", "value"=>$question["ProfileQuestion"]["id"]));
				
				$out.="</div>";
			$out.="</div>";
		$out.="</div>";
		return $out;
	}
	
	
	function page2($questions){
		$i = 0;
		$number = 1;
		$out="";
		foreach($questions as $question){
			$out.=$this->buildQuestion($question, $i, $number);
			$number++;
			$i++;
		}
	
		$out.="<div id=\"buttons\">";
			$out.= $this->Form->submit("Save", array("div"=>false));
					
        $out.="</div>";
		return $out;
		
	}
	
	function page3($questions){
		return $this->page2($questions);
		
	}

	
	function page5($personal_incomes){
		
		$options = array();
		foreach($personal_incomes as $income){
			$options[$income["PersonalIncome"]["id"]] = $income["PersonalIncome"]["value"];
		}
		$out = "<div class=\"span-18 last row bc-wrap3\">";
			$out.="<div class=\"span-10\">";
			$out .=$this->Form->label("MemberProfileAttributeWeight.personal_income_id", "What is your personal income?");	
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<div class='radio_list'>";
				$out.=$this->Form->radio("MemberProfileAttributeWeight.personal_income_id", $options, array("legend"=>false, "separator"=>"<br/>"));
				
				
				$out.="</div>";
			$out.="</div>";
		$out.="</div>";
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.=$this->Form->label("MemberProfileAttributeWeight.personal_income_weight", "How important is your match's income to you?");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.=$this->Form->input("MemberProfileAttributeWeight.personal_income_weight", array("type"=>"hidden"));
				$out .="<div class='slider' id='personal_income_weight'>";		
				$out .= "</div>";
				$out .="<div id='output_personalincome_weight'></div>";
			$out.="</div>";
		$out.="</div>";
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
			$out.=$this->Form->label("MemberProfile.occupation", "Describe your occupation.");	
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.= $this->Form->input("MemberProfile.occupation", array("label"=>false, "div"=>false));	
			$out.="</div>";
		$out.="</div>";
		
		$out.="<div id=\"buttons\">";
			$out.= $this->Form->submit("Save", array("div"=>false));
					
        $out.="</div>";
        
		return $out;
		
	}
	
	
	function page4($educationalLevels, $questions){
		
		$options = array();
		foreach($educationalLevels as $level){
			$options[$level["EducationalLevel"]["id"]] = $level["EducationalLevel"]["value"];
		}
		
		
		$out = "<div class=\"span-18 last row bc-wrap3\">";
			$out.="<div class=\"span-10\">";
				$out.=$this->Form->label("MemberProfileAttributeWeight.educational_level_id", "Choose the category that best describes your highest educational level");
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.="<div class='radio_list'>";
				$out.=$this->Form->radio("MemberProfileAttributeWeight.educational_level_id", $options, array("legend"=>false, "separator"=>"<br/>"));
				$out.="</div>";	
			$out.="</div>";
		$out.="</div>";
		
		$out .= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
				$out.=$this->Form->label("MemberProfileAttributeWeight.educational_level_id", "How important is the educational level of your match?");
			$out.="</div>";
			
			$out.="<div class=\"span-8 last clear\">";
				$out.=$this->Form->input("MemberProfileAttributeWeight.educational_level_weight", array("type"=>"hidden"));		
				$out .="<div class='slider' id='educational_weight'>";		
				$out .= "</div>";
				$out .="<div id='output_educational_weight'>";		
				$out .= "</div>";
			$out.="</div>";
		$out.="</div>";
		
		$i=0;
		foreach($questions as $question){
			$out.=$this->buildQuestion($question, $i, $i+3);
			$i++;
		}
		
		$out.="<div id=\"buttons\">";
			$out.= $this->Form->submit("Save", array("div"=>false));								
        $out.="</div>";
		
		return $out;
	}
	
	
	
	function pageN($attributes=array(), $member_id, $page){
		$out = $this->Form->create("MemberAttributeWeight", array("url"=>"/attributes/questionnaire/".$page, "class"=>"ui-helper-clearfix"));
		$options = array(5=>"Strongly Agree", 4=>"Agree", 1=>"Neither agree or disagree", 3=>"Disagree", 2=>"Strongly Disagree");
		
		$i=0;
		foreach($attributes as $attribute){
			$out.= "<div class=\"span-18 last row\">";
			$out.="<div class=\"span-10\">";
				$out.=$this->Form->label("MemberAttributeWeight.$i.weight", $attribute["Attribute"]["question"]);						
			$out.="</div>";
			$out.="<div class=\"span-8 last clear\">";
				$out.=$this->Form->radio("MemberAttributeWeight.$i.weight", $options, array("legend"=>false, "separator"=>"<br/>"));
				$out.=$this->Form->input("MemberAttributeWeight.$i.attribute_id", array("type"=>"hidden", "value"=>$attribute["Attribute"]["id"]));
				$out.=$this->Form->input("MemberAttributeWeight.$i.member_id", array("type"=>"hidden", "value"=>$member_id));
			
			$out.="</div>";
			$i++;
			$out.="</div>";
		}
		
		$out.="<div id=\"buttons\" class='clear'>";
			$out.= $this->Form->submit("Save", array("div"=>false));
        $out.="</div>";
		$out.=$this->Form->end();
		return $out;
	}
	function renderInMyOwnWordsQuestion($data, $questions){
		$out="<div class=\"span-15 form_container last\">";
		$out.=$this->Html->image("designs/member/edit/in_my_own_words_header.png");
		$out.="</div>";

		$out.="<div class=\"span-14 form\">";
		$i=1;
		foreach($questions as $question){
			$out.="<div class='span-15 last clear question' id='question{$question["InMyOwnWordsQuestion"]["id"]}'>";
				$out.="<p class='number'>$i</p>";
				$i++;
				$out.="<p class='span-15 last question'>{$question["InMyOwnWordsQuestion"]["question"]}</p>";
				$out.=$this->Form->create("InMyOwnWordsAnswer", array("class"=>"ui-helper-clearfix"));
				$out.=$this->Form->input("in_my_own_words_question_id", array("type"=>"hidden", "value"=>$question["InMyOwnWordsQuestion"]["id"]));
				$out.=$this->Form->input("member_id", array("value"=>$data["Member"]["id"], "type"=>"hidden"));	
				$response = "";
				if (!empty($data["InMyOwnWordsAnswer"])){
					foreach($data["InMyOwnWordsAnswer"] as $answer){
						if ($answer["in_my_own_words_question_id"]==$question["InMyOwnWordsQuestion"]["id"]){
							$response = $answer["answer"];
							$out.=$this->Form->input("id", array("type"=>"hidden", "value"=>$answer["id"]));			
						}
					}
				}			
				$out.="<div class='span-15 last clear'>";
					$out.=$this->Form->input("answer", array("value"=>$response, "div"=>false, "label"=>false));		
				$out.="</div>";
				$out.=$this->Ajax->submit("Save", array("url"=>"/in_my_own_words_answers/update", "update"=>"question{$question["InMyOwnWordsQuestion"]["id"]}", "div"=>"span-15 last clear"));
				$out.=$this->Form->end();
			$out.="</div>";
		}
		$out.="</div>";
		return $out;
		
		
	}
	
	
	function validateIfSelected($data, $question, $class_name){
		$class= "class=\"$class_name\"";
		$valid = false;
       	if (!empty($data)){
       		if (isset($data["MemberProfileAnswer"])){
       			foreach($data["MemberProfileAnswer"] as $answer){
					if (!isset($answer["item_id"])){
						continue;		
					}
					if (($answer["question_id"]==$question["ProfileQuestion"]["id"])&&(isset($answer["item_id"]))){
						$valid = true;
					}
       			}
				if ($valid){
					$class= "class=\"$class_name\"";
       			}else{
       				$class="class=\"$class_name error\"";
       			}
			}   				
       	}
       	return $class;
       				
	}
	
}
?>