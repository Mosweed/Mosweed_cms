<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'firstname',
        'lastname',

        'country',
        'bisiness_name',
        'vat_number',
        'city',
        'address',
        'zipcode',
        'housenumber',
        'addition',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
