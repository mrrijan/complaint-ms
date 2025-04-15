<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(ComplaintType::class, 'type_id');
    }

    public function statusLogs()
    {
        return $this->hasMany(ComplaintStatusLog::class);
    }
}
