<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
