<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
