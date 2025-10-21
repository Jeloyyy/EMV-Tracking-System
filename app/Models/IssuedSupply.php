<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuedSupply extends Model
{
    protected $fillable = [
        'supply_id', 'user_id', 'quantity', 'date_issued', 'is_returned', 'price', 'total_price'
    ];

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}