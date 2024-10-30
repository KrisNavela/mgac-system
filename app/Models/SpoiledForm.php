<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpoiledForm extends Model
{
    use HasFactory;
    
    protected $fillable = [

        'spoiled_date',
        'spoiled_no',
        'user_id',
        'item_id',
        'quantity',
        'spoiled_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Find the latest requisition
            $lastSpoiledForm = SpoiledForm::latest('id')->first();
            
            // Define the starting sequence number
            $nextNumber = $lastSpoiledForm ? intval(substr($lastSpoiledForm->spoiled_no, 3)) + 1 : 1;
            
            // Set the requisition number with prefix "REQ"
            $model->spoiled_no = 'SPO' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
