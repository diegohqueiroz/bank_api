<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialMovement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'bank_account_id' ,'type' ,'value' ,'previous_balance' ,'later_balance' ,
    ];
}
