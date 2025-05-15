<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PizzaRawMaterial extends Model
{
    use HasFactory;

    protected $table = 'pizza_raw_material';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'int';
    protected $fillable = ['pizza_id', 'raw_material_id', 'quantity'];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
