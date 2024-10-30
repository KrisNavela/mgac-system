<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [

        'item_code',
        'item_desc',
        'quantity',
    ];

    public function requisitions(): belongsToMany
    {
        return $this->belongsToMany(Requisition::class)->withPivot('quantity');
    }

    public function requisitionItems()
    {
        return $this->hasMany(RequisitionItem::class);
    }

    public function numberSeries()
    {
        return $this->hasMany(NumberSeries::class);
    }

    public function spoiledForms()
    {
        return $this->hasMany(SpoiledForm::class);
    }

    public function itemOrders()
    {
        return $this->hasMany(ItemOrderController::class);
    }
}
