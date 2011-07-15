<?php 
class CrypterComponent extends Object { 
   
	/**
	 * 
	 * Do not change after production ...
	 * @var 
	 */
    var $key = 'PuTyOuRK3yHeRe';

    var $name = "Crypter"; 
    function enCrypt($data = null) { 
        if ($data != null) { 
            $td = mcrypt_module_open('cast-256', '', 'ecb', ''); 
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND); 
            mcrypt_generic_init($td, $this->key, $iv); 
            $encrypted_data = mcrypt_generic($td, $data); 
            $encoded = base64_encode($encrypted_data); 
            if (!mcrypt_generic_deinit($td) || !mcrypt_module_close($td)) { 
                $encoded = false; 
            } 
        } else { 
            $encoded = false; 
        } 
        return $encoded; 
    } 
    function deCrypt($data = null) { 
        if ($data != null) { 
            $data = (string) base64_decode(trim($data)); 
            $td = mcrypt_module_open('cast-256', '', 'ecb', ''); 
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND); 
            mcrypt_generic_init($td, $this->key, $iv); 
            $data = (string) trim(mdecrypt_generic($td, $data)); 
            if (!mcrypt_generic_deinit($td) || !mcrypt_module_close($td)) { 
                $data = false; 
            } 
        } else { 
            $data = false; 
        } 
        return $data; 
    } 
    function maskCardNumber($cardNumber) { 
        $cardArray = str_split($cardNumber); 
        $length = count($cardArray); 
        $maskedCardNumber = ""; 
        for ($i = 0; $i < $length -4; $i++) { 
            $cardArray[$i] = 'X'; 
        } 
        for ($i = 0; $i < $length; $i++) { 
            $maskedCardNumber = $maskedCardNumber . $cardArray[$i]; 
        } 
        return $maskedCardNumber; 
    } 
} 