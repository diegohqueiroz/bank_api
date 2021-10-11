<?php

namespace App\Repositories;

use DB;

class FinancialMovementRepository extends BaseRepository
{

    public function balance($bank_account_id)
    {
        $in = $this->model->where('bank_account_id', $bank_account_id)->where('type', 'in')->select(DB::Raw('sum(value) as value'))->first()->value;
        $out = $this->model->where('bank_account_id', $bank_account_id)->where('type', 'out')->select(DB::Raw('sum(value) as value'))->first()->value;
        return ($in - $out);
    }

    public function statement($bank_account_id)
    {
        $data = $this->model->where('bank_account_id', $bank_account_id)
        	->select('created_at','type','value','previous_balance','later_balance')
        	->orderBy('id','asc')
        	->get();
        return $data;
    }
}