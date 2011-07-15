<?php
/**
 * DGCrypt
 *
 * 2-way encryption tool, intended only for storing credit card numbers
 * You should only have to adjust the following properties to customize this tool:
 *		- $mapNums
 *		- $mapStrLength
 *		- $cipherCombos
 *		- $cipherOccurrences
 *
 * See the documentation above each property for rules on how to properly customize.
 * Not adhering to each property's rules will break the 2-way encryption, and could potentially result in data loss.
 *
 * Once in use with stored data, DO NOT alter any of the properties; stored numbers would NOT be recoverable.
 *
 * Author is not responsible for breaks in security - encrypted numbers are not entirely crack-proof, however, by securing the use of this script, you should be able to avoid any iterations of fake numbers, etc., in malicious crack attempts. Raw lists of encrypted numbers should be moderately to highly secure, depending on how large and varied the original numbers are.
 *
 * Remember, storing sensitive information like credit card numbers requires a lot of responsibility - this script cannot replace overall software and server security, so be wise and thorough in your site administration and maintenance.
 *
 * INSTALLATION:
 * You should place this file outside of the server root or public directories. When saving a credit card number, include this script, instantiate the DGCrypt class, and run DGCrypt::encode()
 *
 *		include_once(PATH_OUTSIDE_ROOT.'dgcrypt.php');
 *		$DGCrypt = new DGCrypt();
 *		// $number is 2322123458932567
 *		$encryptedNumber = $DGCrypt->encode($number);
 *		// save $encryptedNumber
 *
 * When retrieving a credit card number, run DGCrypt::decode() like so:
 *
 * 		$originalNumber = $DGCrypt->decode($encryptedNumber);
 *
 * If you are running comparisons alone, avoid using DGCrypt::decode() and just compare using DGCrypt::encode(). This keeps you from sending credit card numbers back and forth in comparison checks, and it's best practice.
 *
 * 		$encryptedNumber = $DGCrypt->encode($providedNumber);
 * 		if ($encryptedNumber == $stringStoredInDatabase) {
 * 			// user provided a matching number
 * 		}
 *
 * @author David Golding
 *
 * @url http://www.davidgoldingdesign.com
 *
 * @license Creative Commons Attribution-No Derivative Works 3.0 United States License (see http://creativecommons.org/licenses/by-nd/3.0/us/ for more information). You may distribute this code, but be sure to provide this license and author name code block at the top. Don't alter the code without the author's permission.
 *
 */

class DGCrypt {
	
/**
 *	mapNums
 *
 *	Maps a given character to an array of 2 possible values
 *	(no duplicates allowed in either the keys or values, including all array values, or the decryption will break)  
 *
 */
	var $mapNums = array(
		0 => array('q', 'D', 'j', 'u', 'Z', 'J', 'S'),
		1 => array('R', 'G', 'K', 'c'),
		2 => array('x', 'o', 'M', 'P'),
		3 => array('a', 'f', 's'),
		4 => array('W', 'L'),
		5 => array('B', 'v', 'z'),
		6 => array('E', 'e', 't', 'y', 'O'),
		7 => array('b', 'Q', 'U', 'X', 'n', 'd'),
		8 => array('p', 'A'),
		9 => array('H', 'l', 'k', 'g', 'r', 'w', 'C')
	);
	
/**
 *	mapStrLength
 *
 *	Maps a given set of string lengths for appending random characters to the encrypted string
 *	- key represents the original value's length
 *	- value represents how many randomized characters to truncate off of the encrypted string during decryption
 *	- adding all of the keys and their |val| together should produce all unique sums;
 *	in other words, no two keys+their offsets should equal each other
 *
 */
	var $mapStrLength = array(
		13 => -8, //output string will be 21 chars in length
		14 => -8, // 22
		15 => -1, // 16
		16 => -2, // 18
		17 => -2, // 19
		18 => -2, // 20
		19 => -5  // 24
	);
	
/**
 * cipherCombos
 *
 * An array of (important!) ASCII character strings, may be any length (4-10 chars recommended)
 * (Best to leave out single quotes and backslashes)
 * Must include at least one non-alphanumeric character in each string or the encryption/decryption will break
 * Array may contain any number of entries (at least 12 recommended)
 */
	var $cipherCombos = array(
		'8mF~',
		':H/@',
		'7[?k',
		'Q_aW',
		'TE)T',
		'e0_G',
		'^AN+',
		'!~E3',
		'(/%d',
		'<*M%q:',
		'd;57',
		'~M/Bh(',
		'{P4n',
		'i3$J)',
		'%H%Y+',
		'tu~K#&',
		'@ZR{bT',
		'~Jw@*XtMy%',
		'&*4H',
		'++^^',
		'[hZ*|',
		'<:8aaa',
		'--~!^;:;'
	);
	
/**
 * cipherOccurrences
 *
 * Number of times a cipher combo string should be inserted into the final encrypted string
 * Must be less than the original string's length
 * 
 * Set to false to disable ASCII ciphering (encrypted string will only contain alphanumeric chars)
 *
 */
	var $cipherOccurrences = 2;
	
/**
 * protectFromDirectAccess
 *
 * Protects the class object from instantiating itself if this script is called directly via HTTP
 *
 */
	var $protectFromDirectAccess = true;
	
/**
 * Constructor method
 *
 */
	function __construct() {
		if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']) && $this->protectFromDirectAccess == true) {
			$this->__destruct();
		}
	}
	
/**
 * Creates an encrypted string
 *
 * @param $str	the string to encrypt
 */
	function encode($str = null) {
		if (!$str) {
			return false;
		} else {
			srand((double)microtime()*1000000); 
			foreach ($this->mapNums as $int=>$char) {
				$key = rand(0, count($char)-1);
				$str = str_replace($int, $char[$key], $str);
			}
			$str = $this->_appendRandomChars($str);
			if ($this->cipherOccurrences != false) {
				$str = $this->_insertRandomCiphers($str);
			}
			return $str;
		}
	}
	
/**
 * Decrypts a string encrypted with DGCrypt::encode
 *
 * @param $str	the string to decrypt
 */
	function decode($str = null) {
		if (!$str) {
			return false;
		} else {
			if ($this->cipherOccurrences != false) {
				$str = $this->_removeCiphers($str);
			}
			$str = $this->_truncStr($str);
			$_mapChars = $this->_reverseMapNums($this->mapNums);
			foreach ($_mapChars as $char=>$int) {
				$str = str_replace($char, $int, $str);
			}
			return $str;
		}
	}
	
/**
 * Used to test mappings
 *
 * @param $str	the string to encrypt and decrypt
 */
	function encodeAndDecode($str = null) {
		if (!$str) {
			return false;
		} else {
			$encodedStr = $this->encode($str);
			$decodedStr = $this->decode($encodedStr);
			return $encodedStr.'('.strlen($encodedStr).')<br/>'.$decodedStr.'('.strlen($decodedStr).')';
		}
	}
	
/**
 * Used to test cipherings
 *
 * @param $str	the string to encrypt and decrypt
 */
	function cipherAndDecipher($str = null) {
		if (!$str) {
			return false;
		} else {
			$encodedStr = $this->_insertRandomCiphers($str);
			$decodedStr = $this->_removeCiphers($encodedStr);
			return $encodedStr.'('.strlen($encodedStr).')<br/>'.$decodedStr.'('.strlen($decodedStr).')';
		}
	}
	
/**
 * Appends random characters onto a given string based on its length and the offset value assigned in $mapStrLength
 *
 * @param $str	the string on which to append random characters
 */
	function _appendRandomChars($str) {
		$strLength = strlen($str);
		foreach ($this->mapStrLength as $length=>$trunc) {
			if ($strLength == $length) {
				$str .= $this->_randomChar(abs($trunc));
			}
		}
		return $str;
	}
	
/**
 * Inserts random strings contained in $cipherCombos depending on the number of occurrences allowed in $cipherOccurrences
 *
 * @param $str	the string in which to add random cipher strings
 * @return A string with random chunks of ASCII character strings interspersed at random intervals
 */
	function _insertRandomCiphers($str) {
		$i = 0;
		$strWell = array();
		$strTrail = $str;
		
		while ($i < $this->cipherOccurrences) {
			$seed = rand(0, count($this->cipherCombos)-1);
			
			$maxLen = rand(1, floor(strlen($str) / $this->cipherOccurrences));
			$remain = 0 - (strlen($strTrail) - $maxLen);
			
			$left = substr($strTrail, 0, $maxLen);
			$right = substr($strTrail, $remain);
			
			$strWell[] = $left;
			$strWell[] = $this->cipherCombos[$seed];
			
			$strTrail = $right;
			$i++;
		}
		if (!empty($strTrail)) {
			$strWell[] = $strTrail;
		}

		return implode($strWell);
	}
	
/**
 * Removes cipher strings from an encrypted string
 *
 * @param $str	the string from which to remove cipher combinations
 */
	function _removeCiphers($str) {
		foreach ($this->cipherCombos as $cipher) {
			if (strpos($str, $cipher) !== 0) {
				$str = str_replace($cipher, null, $str);
			}
		}
		return $str;
	}
	
/**
 * Generates a random alphanumeric string to a given length
 *
 * @param $length	number of randomized characters to generate
 */
	function _randomChar($length = 1) {
		if ($length <= 0) {
			return false;
		}
	    $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $pass = null;
	    srand((double)microtime()*1000000); 
	    $i = 0;
	    
	    while ($i < $length) {
			$num = rand() % 52;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
	    }
	    return $pass;
	}
	
/**
 * Removes randomized characters from encrypted string based on its length and $mapStrLength
 *
 * @param $str	the encrypted string to truncate
 */
	function _truncStr($str) {
		$code = null;
		$strLength = strlen($str);
		$_mapStrTrunc = $this->_reverseMapTrunc($this->mapStrLength);
		foreach ($_mapStrTrunc as $length=>$trunc) {
			if ($strLength == $length) {
				$code = substr($str, 0, $trunc);
			}
		}
		return $code;
	}
	
/**
 * Inverts the mappings in $mapNums for use in encryption/decryption methods
 *
 * @param $map	the number mappings to invert
 */
	function _reverseMapNums($map = array()) {
		$out = array();
		foreach ($map as $int=>$char) {
			if (is_array($char)) {
				foreach($char as $_char) {
					$out[$_char] = $int;
				}
			} else {
				$out[$char] = $int;
			}
		}
		return $out;
	}
	
/**
 * Inverts the mappings in $mapStrLength for use in encryption/decryption methods
 *
 * @param $map	the length mappings to invert
 */
	function _reverseMapTrunc($map = array()) {
		$out = array();
		foreach ($map as $length=>$offset) {
			$key = $length + abs($offset);
			$out[$key] = $offset;
		}
		return $out;
	}
}
?>