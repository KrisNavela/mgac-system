<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionRemarks extends Model
{
    use HasFactory;

    protected $table = 'remarks_requisition';

    protected $fillable = [
        'requisition_id',
        'content',
        'user_id',
    ];
    
    public function requisition()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
