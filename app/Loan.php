<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    protected $guard = 'loans';

    protected $fillable = [
        'amount', 'term', 'interest_rate', 'month', 'year'
    ];

    protected $dates = ['deleted_at'];

    public function loanDetail()
    {
        return $this->belongsTo('App\LoanDetail', 'id', 'amount');
    }
}
