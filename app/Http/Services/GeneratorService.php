<?php
namespace App\Http\Services;

class GeneratorService {
    /**
     * generate random string
     */
    public function generateReferralLink() {
        $string = 'abcdefghijklmnopqrstuvqrstuvwxyzABCDEFGHIJ
        KLMNOPQRSTUVWXYZ0123456789';
        //initialize ref
        $ref = '';
        for($i=0; $i<=10; $i++) {
            $ref += $string[floor(rand(0,62))]; 
        }
        return $ref;
    }


    /**
     * generate random string
     */
    public function generateRandomString() {
        $string = 'abcdefghijklmnopqrstuvqrstuvwxyzABCDEFGHIJ
        KLMNOPQRSTUVWXYZ0123456789';
        //initialize string
        $randString = '';
        for($i=0; $i<=10; $i++) {
            $randString += $string[floor(rand(0,62))]; 
        }
        return $randString;
    }
}