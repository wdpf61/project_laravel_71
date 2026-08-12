<?php

namespace App\Services;

class PaymentService
{
    public function Process($amount) {
        echo  "payment is done $amount tk";
    }
    public function BkashPayemnt($amount) {
        echo  "BkashPayemnt is done $amount tk";
    }
    public function RoketPayemnt($amount) {
        echo  "RoketPayemnt is done $amount tk";
    }
}
