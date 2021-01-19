<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    protected $guarded = [];

    public function objednavky() {
        return $this->belongsToMany(Objednavka::class);
    }

    public function kategorie() {
        return $this->belongsToMany(Kategoria::class)->withTimestamps();
    }

}
