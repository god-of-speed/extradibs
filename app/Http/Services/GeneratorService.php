<?php
namespace App\Http\Services;

class GeneratorService {
    /**
     * generate random string
     */
    public function generateReferralLink() {
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        //initialize ref
        $ref = '';
        for($i=0; $i<=10; $i++) {
            $ref .= $string[(int)ceil(mt_rand(0,61))]; 
        }
        return $ref;
    }


    /**
     * generate random string
     */
    public function generateRandomString() {
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        //initialize string
        $randString = '';
        for($i=0; $i<=10; $i++) {
            $randString .= $string[(int)ceil(mt_rand(0,61))]; 
        }
        return $randString;
    }
}