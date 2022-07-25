<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class myOrder extends Model
{
    use HasFactory;

    protected $fillable = ['buyerId','buyerName','buyerEmail','firstname','lastname','email','productId','title','quantity','price','total','image','description'];
}
