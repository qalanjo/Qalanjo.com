<?php
echo $this->Form->create("Member");
echo $this->Form->input("Member.id", array("type"=>"hidden"));
echo $this->Form->input("MemberSetting.id", array("type"=>"hidden", "value"=>$this->data["MemberSetting"]["member_id"]));
echo $this->Form->input("MemberSetting.member_id", array("type"=>"hidden", "value"=>$this->data["Member"]["id"]));
echo $this->Form->input("MemberSetting.setting", array("type"=>"hidden", "value"=>$settings));	