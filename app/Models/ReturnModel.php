<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $fillable = ['loan_id', 'return_date', 'fine'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}

