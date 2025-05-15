<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderExtraIngredient extends Model
{
    use HasFactory;

    protected $table = 'order_extra_ingredient';    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'int';
    protected $fillable = ['order_id', 'extra_ingredient_id', 'quantity'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function extraIngredient(): BelongsTo
    {
        return $this->belongsTo(ExtraIngredient::class);
    }
}
