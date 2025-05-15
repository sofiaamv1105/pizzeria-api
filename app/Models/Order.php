<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';    
    protected $fillable = ['client_id', 'branch_id', 'total_price', 'status', 'delivery_type', 'delivery_person_id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function deliveryPerson(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'delivery_person_id');
    }

    public function pizzaSizes(): BelongsToMany
    {
        return $this->belongsToMany(PizzaSize::class, 'order_pizza')->withPivot('order_pizza_quantity');
    }

    public function extraIngredients(): BelongsToMany
    {
        return $this->belongsToMany(ExtraIngredient::class, 'order_extra_ingredient')->withPivot('order_extra_quantity');
    }
}
