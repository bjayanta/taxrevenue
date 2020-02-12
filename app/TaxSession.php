<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxSession extends Model {

    public function assessees() {
        return $this->belongsToMany('\App\Assessee', 'tax_returns', 'tax_session_id', 'assessee_id')
            ->withPivot('amount', 'circle_id')
            ->withTimestamps()
            ->as('tax_return');
    }
}
