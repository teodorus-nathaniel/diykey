<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function details() {
        return $this->hasMany(DetailTransaction::class);
    }
}
