<?php

class SimpleImage{
	var $image;
	var $image_type;
	function load($filename){
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if ($this->image_type==IMAGETYPE_JPEG){
			$this->image = imagecreatefromjpeg($filename);
		}else if ($this->image_type==IMAGETYPE_GIF){
			$this->image = imagecreatefromgif($filename);
		}else if ($this->image_type==IMAGETYPE_PNG){
			$this->image = imagecreatefrompng($filename);
		}

	}

	function save($filename, $image_type=IMAGETYPE_JPEG, $compression = 75, $permissions=null){
		if ($image_type==IMAGETYPE_JPEG){
        	imagejpeg($this->image, $filename, $compression);
        }else if ($image_type==IMAGETYPE_GIF){
        	imagegif($this->image, $filename);
        }else if ($image_type==IMAGETYPE_PNG){
        	imagepng($this->image, $filename);
        }
        if ($permissions!=null){
        	chmod($filename, $permissions);
        }
	}
	
	function output($image_type=IMAGETYPE_JPEG){
		if ($image_type==IMAGETYPE_JPEG){
        	imagejpeg($this->image);
        }else if ($image_type==IMAGETYPE_GIF){
        	imagegif($this->image);
        }else if ($image_type==IMAGETYPE_PNG){
        	imagepng($this->image);
        }
	}
	function getWidth(){
		return imagesx($this->image);
	}
	
	function getHeight(){
		return imagesy($this->image);
	}
	
	function resizeToHeight($height){
		$ratio = $height/$this->getHeight();
		$width = $this->getWidth()*$ratio;
		$this->resize($width, $height);
	}
	
	function resizeToWidth($width){
		$ratio = $width/$this->getWidth();
		$height = $this->getHeight()*$ratio;
		$this->resize($width, $height);
	}
	
	function scale($scale){
		$width = $this->getWidth()*$scale/100;
		$height = $this->getHeight()*$scale/100;
		$this->resize($width, $height);
	}
	
	function resize($width, $height){
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}
	
	
}
?>