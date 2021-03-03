<?php 

class Token{

    private $apiKey;
    private static $secretKey = "secretKey";
    
    public static function key()
    {
        $secretKey = "secretKey";
        // Generates a random string of ten digits
        $salt = mt_rand();

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $salt, self::$secretKey, true);

        // base64 encode...
        $tokenKey = base64_encode($signature);
        return $tokenKey;
    }
}

?>