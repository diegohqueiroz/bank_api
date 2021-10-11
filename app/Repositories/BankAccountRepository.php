<?php

namespace App\Repositories;

class BankAccountRepository extends BaseRepository
{

    public function find($id)
    {
        $data = $this->model->join('bank_customers', 'bank_customers.id', 'bank_accounts.bank_customer_id')
            ->join('banks', 'banks.id', 'bank_customers.bank_id')
            ->select('bank_accounts.id', 'bank_accounts.number', 'bank_accounts.agency', 'bank_accounts.active', 
                    'bank_accounts.bank_customer_id', 'bank_customers.name as customer_name',
                    'banks.id as bank_id', 'banks.name as bank_name')
            ->orderBy('bank_accounts.agency', 'asc')
            ->where('bank_accounts.id', $id)
            ->first();
        return $data;
    }    

    public function baseGet($active)
    {
        $data = $this->model->join('bank_customers', 'bank_customers.id', 'bank_accounts.bank_customer_id')
            ->select('bank_accounts.id', 'bank_accounts.number', 'bank_accounts.agency', 'bank_accounts.active', 'bank_customers.name as customer_name')
            ->orderBy('bank_accounts.agency', 'asc');
        return $data;
    }    

    public function get($active)
    {
        $data = self::baseGet($active)->where('bank_accounts.active', $active)->get();
        return $data;
    }    

    public function findByNumber($number, $active)
    {
        $data = self::baseGet($active)->where('active', $active)->where('number', $number)->get();
        return $data;
    }


}