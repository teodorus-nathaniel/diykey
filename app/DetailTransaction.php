<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    public function header() {
        return $this->belongsTo(HeaderTransaction::class);
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
