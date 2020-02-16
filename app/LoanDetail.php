<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanDetail extends Model
{
    use SoftDeletes;

    protected $guard = 'loan_details';

    protected $fillable = [
        'loan_id', 'month', 'year', 'amount', 'principal', 'interest', 'balance'
    ];

    protected $dates = ['deleted_at'];

    public function loan()
    {
        return $this->hasOne('App\Loan', 'id', 'loan_id');
    }
}
