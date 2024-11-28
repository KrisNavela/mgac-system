<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberSeries extends Model
{
    use HasFactory;

    protected $fillable = [

        'requisition_id',
        'branch_code',
        'branch_name',
        'item_id',
        'item_code',
        'number',
        'number_status',
        'coc_prefix',
        
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    
}
