<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionAttachment extends Model
{
    use HasFactory;

    protected $table = 'attachment_requisition';

    protected $fillable = [
        'requisition_id',
        'file_path',
    ];
}
