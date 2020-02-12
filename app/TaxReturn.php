<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxReturn extends Model {
    protected $fillable = ['assessee_id', 'tax_session_id', 'amount'];

    public function session() {
        return $this->belongsTo('\App\TaxSession', 'tax_session_id', 'id');
    }
}
