<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pizza extends Model
{
    use HasFactory;
    
    protected $table = 'pizzas';    
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $keyType = 'int';
    protected $fillable = ['name'];

    public function sizes(): HasMany
    {
        return $this->hasMany(PizzaSize::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'pizza_ingredient');
    }

    public function rawMaterials(): BelongsToMany
    {
        return $this->belongsToMany(RawMaterial::class, 'pizza_raw_material');
    }
}
