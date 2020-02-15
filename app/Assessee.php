<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessee extends Model
{

    public static $snakeAttributes = true;
    /**
     * Tax Sessions
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxSessions()
    {
        return $this->belongsToMany('\App\TaxSession', 'tax_returns', 'assessee_id', 'tax_session_id')
            ->withPivot('amount', 'circle_id')
            ->withTimestamps()
            ->as('tax_return');
    }


    /**
     * Circle
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function circle()
    {
        return $this->hasOne('\App\Circle');
    }


}
