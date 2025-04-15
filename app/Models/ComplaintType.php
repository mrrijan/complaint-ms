<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    protected $guarded = [];
    public function Complaints()
    {
        return $this->hasMany(Complaint::class, 'type_id');
    }
}
