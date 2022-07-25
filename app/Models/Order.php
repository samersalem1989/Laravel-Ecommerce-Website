<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'SaleId', 'firstname', 'lastname', 'city', 'email', 'address','TransactionAmount', 'DocumentURL', 'SaleTime', 'TransactionCardName', 'TransactionCardNum' 
    ];

}
