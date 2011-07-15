<?php
	class ProfileCompletorHelper extends AppHelper{
		
		var $helpers = array('Html','Ajax','Session','Form');
		
		function _pageOne($gender,$marital,$educ){
			$builder = '';
					$builder .="<div>";
					$builder .= $this->Form->label('gender_id','Please verify your gender');
					foreach($gender as $g){
						$builder .= $this->Form->radio('confirm_gender_id',array(
							$g['Gender']['id'] => $g['Gender']['value']
							),
							array('div'=>false));;
					}
					$builder .=$this->Form->error('Member.confirm_gender_id');
					$builder .='</div>';
					
					
					$builder .='<div>';
					$builder .= $this->Form->input('MemberProfileAttributeWeight.birthdate');
					
					$builder .=$this->Form->label('MemberProfile.marital_status_id','Current Marital Status');
					foreach($marital as $m){
						$builder .= $this->Form->radio('MemberProfile.marital_status_id',array(
							$m['MaritalStatus']['id']=>	$m['MaritalStatus']['value']
							),
							array('div'=>false));
					}
					$builder .=$this->Form->error('MemberProfile.marital_status_id');
					$builder .= '</div>';
					
					
					$builder .='<div>';
					$builder .=$this->Form->label('MemberProfileAttributeWeight.educational_level_id','Highest Educational attainment');
					foreach($educ as $e){
						$builder .= $this->Form->radio('MemberProfileAttributeWeight.educational_level_id',array(
							$e['EducationalLevel']['id']=>	$e['EducationalLevel']['value']
							),
							array('div'=>false));
					}
					$builder .=$this->Form->error('MemberProfileAttributeWeight.educational_level_id');
					$builder .='</div>';
					
			return $builder;
		}
		
		
		function _pageTwo($income,$eth){
			$builder = '';
				$builder .="<div>";
					$builder .= $this->Form->label('MemberProfileAttributeWeight.personal_income_id','What is your personal Income');
					foreach($income as $i){
						$builder .= $this->Form->radio('MemberProfileAttributeWeight.personal_income_id',array(
							$i['PersonalIncome']['id'] => $i['PersonalIncome']['value']
							),
							array('div'=>false));;
					}
					$builder .=$this->Form->error('MemberProfileAttributeWeight.personal_income_id');
					$builder .='</div>';
					
			return $builder;
		}	
		
	}
?>