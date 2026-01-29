<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyRequest extends Model
{
    protected $fillable = [
        'user_id', 'item_name', 'quantity', 'reason', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}