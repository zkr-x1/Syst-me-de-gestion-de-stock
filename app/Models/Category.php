<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'seuil_alerte',
    ];

    public function getAlertLevel(int $quantity): string
    {
        if ($quantity === 0) {
            return 'rupture'; // Rouge
        } elseif ($quantity <= $this->seuil_alerte) {
            return 'faible';  // Orange
        } else {
            return 'ok';      // Vert
        }
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
