<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_code', 'product_name', 'product_price'
    ];

    public function transaction_detail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }
}
