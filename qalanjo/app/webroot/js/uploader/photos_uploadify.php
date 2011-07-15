<?php
session_start();
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
require_once "SimpleImage.php";
if (!empty($_FILES)) {
	
	
	$ext = file_extension($_FILES['Filedata']['name']); //get extension name
	$random = randomString();
	$file = $random . '.' . $ext; //concatenate extension name to random generated file
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/rb72aknjykn0w5cefu6z3g7yw8xnpa/';
	$targetFile =  str_replace('//','/',$targetPath) . $file;
	$name = $_FILES['Filedata']['name'];
	error_reporting(0);
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		move_uploaded_file($tempFile, $targetFile);
		
		
		$image = new SimpleImage();
		$image->load($targetFile);
		if ($image->getWidth () > 600 || $image->getHeight () > 450) {
			//set proper width
			if ($image->getWidth () > 600) {
				$image->resizeToWidth ( 600 );
			}
			
			//set proper height
			if ($image->getHeight () > 450) {
				$image->resizeToHeight ( 450 );
			}
			
			$image->save ( $targetFile, IMAGETYPE_JPEG, 75, 0755 );
			$newFile = str_replace ( '//', '/', $targetPath ) . 'thumb_' . $file;
			$image->resize ( 155, 115 );
			$image->save ( $newFile, IMAGETYPE_JPEG, 75, 0755 );
		} else {
			$image->save ( $targetFile, IMAGETYPE_JPEG, 75, 0755 );
			$newFile = str_replace ( '//', '/', $targetPath ) . 'thumb_' . $file;
			$image->resize ( 155, 115 );
			$image->save ( $newFile, IMAGETYPE_JPEG, 75, 0755 );
		}
		//move_uploaded_file($tempFile, $targetFile);
		
		/*
		 *  response JSON format
		 */
		
		echo '{';
		echo '"full":"' . $file . '"';
		echo '}';
}

	function file_extension($filename) {
		$path_info = pathinfo($filename);
		return $path_info['extension'];
	}
	
	function randomString() {
	    $length = 32;
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $string = '';    
	
	    for ($i = 0; $i < $length; $i++) {
	        $string .= $characters[mt_rand(0, strlen($characters))];
	    }
   		return $string;
	}
