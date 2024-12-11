<?php

namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Illuminate\Support\Str;

// class SmsOtpService
// {
//     protected $vonageClient;

//     public function __construct()
//     {
//         // Set up Vonage client with API key and secret
//         $basic  = new Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
//         $this->vonageClient = new Client($basic);
//     }

//     /**
//      * Generate a random OTP code.
//      *
//      * @return string
//      */
//     public function generateOtp()
//     {
//         return Str::random(6);  // You can also use a numeric OTP generator if preferred
//     }

//     /**
//      * Send OTP to the phone number via Vonage SMS.
//      *
//      * @param string $phoneNumber
//      * @param string $otp
//      * @return bool
//      */
//     public function sendOtp($phoneNumber, $otp)
//     {
//         try {
//             $message = $this->vonageClient->message()->send([
//                 'to' => $phoneNumber,
//                 'from' => env('VONAGE_PHONE_NUMBER'),
//                 'text' => "Your verification code is: $otp"
//             ]);
//             return true;
//         } catch (\Exception $e) {
//             // Log the exception or handle it as needed
//             return false;
//         }
//     }
// }
