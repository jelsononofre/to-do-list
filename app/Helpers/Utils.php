<?php

namespace App\Helpers;

use Carbon\Carbon;

class Utils
{
    public static function formatDate($date)
    {
        return Carbon::createFromDate($date)
            ->format("d-m-Y");
    }
}