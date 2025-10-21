<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    // make all relevant columns mass assignable
    protected $fillable = ['name', 'description', 'quantity', 'price', 'total_price', 'date_added'];

    public function issuedSupplies()
    {
        return $this->hasMany(IssuedSupply::class);
    }
}