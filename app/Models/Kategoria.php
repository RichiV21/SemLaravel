<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{
    protected $guarded = [];

    public function produkty() {
        return $this->belongsToMany(Produkt::class);
    }
}
