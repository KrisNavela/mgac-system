<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;

    protected $table = 'item_requisition';

    protected $fillable = [
        'requisition_id',
        'item_id',
        'quantity',
        'quantity_unit',
        'in_pcs',
        'ho_ctrl_start',
        'ho_ctrl_end',
        'ho_ctrl_end',
        'coc_prefix',
        'series_start',
        'series_end',
        'unreported',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
