<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [

        'req_date',
        'status',
        'user_id',
        'bonds_status',
        'uw_status',
        'type_request',
        'replenishment_month',
        'replenishment_year',
        'collasst_status',
        'collmanager_status',
        'finalapproval_status',
        'coc_request_status',
        'treasuryapproval_status',
        'cocapproval_status',
        'collasst_date',
        'collmanager_date',
        'finalapproval_date',
        'finalapproval_date',
        'remarks',
        'delivery_status',
        'delivery_no',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity', 'quantity_unit', 'ho_ctrl_start', 'ho_ctrl_end', 'series_start', 'series_end', 'coc_prefix', 'unreported');
    }

    public function requisitionItems(): HasMany
    {
        return $this->hasMany(RequisitionItem::class);
    }

    public function requisitionRemarks(): HasMany
    {
        return $this->hasMany(RequisitionRemarks::class);
    }

    public function requisitionAttachments(): HasMany
    {
        return $this->hasMany(RequisitionAttachment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Find the latest requisition
            $lastRequisition = Requisition::latest('id')->first();
            
            // Define the starting sequence number
            $nextNumber = $lastRequisition ? intval(substr($lastRequisition->req_no, 3)) + 1 : 1;
            
            // Set the requisition number with prefix "REQ"
            $model->req_no = 'REQ' . str_pad($nextNumber, 10, '0', STR_PAD_LEFT);
        });
    }

}
