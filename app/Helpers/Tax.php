<?php

namespace App\Helpers;

use App\TaxReturn;

class Tax {
    
    public static function getTaxReturnDetails($assessee, $session) {
        $where = [
            ['assessee_id', '=', $assessee],
            ['tax_session_id', '=', $session]
        ];

        return TaxReturn::where($where)->first();
    }

}
