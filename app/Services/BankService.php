<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\FinancialMovement;
use App\Http\Controllers\Controller;
use App\Http\Resources\Balance as BalanceResource;
use App\Repositories\BaseRepository;
use App\Repositories\FinancialMovementRepository;
use App\Repositories\BankAccountRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ApiException;

class BankService extends Controller
{
    private $financialMovementRepository;
    private $bankAccountRepository;

    public function __construct(FinancialMovementRepository $financialMovementRepository, BankAccountRepository $bankAccountRepository)
    {
        $this->financialMovementRepository = $financialMovementRepository;
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function getBalance($id)
    {
        //Log::debug('[BankService][getBalance] $id: ' . $id);
        $value = $this->financialMovementRepository->balance($id);
        return (object) ['balance' => $value, 'date_balance' => Carbon::now()];
    }

    public function createMovement($data)
    {
        //Log::debug('[BankService][createMovement] $data: ' . json_encode($data));
        $old = $this->financialMovementRepository->balance($data['bank_account_id']);
        if($data['movement'] === 'out' && $old < $data['value']){
            throw new ApiException("Saldo insuficiente!");
        }
        $data = self::prepareDataMovement($data, $old);
        $balance = $this->financialMovementRepository->create($data);
        return true;
    }

    public function prepareDataMovement($data, $old)
    {
        $new = $data['movement'] === 'in' ? ($old + $data['value']) : ($old - $data['value']);
        $data['type'] = $data['movement'];
        $data['previous_balance'] = $old;
        $data['later_balance'] = $new;
        return $data;
    }

    public function getStatement($id)
    {
        //Log::debug('[BankService][getStatement] $id: ' . $id);
        $value = $this->financialMovementRepository->statement($id);
        return $value;
    }

}
