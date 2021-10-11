<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FinancialMovement;
use App\Http\Controllers\Controller;
use App\Http\Resources\Balance as BalanceResource;
use App\Http\Resources\Statement as StatementResource;
use App\Repositories\FinancialMovementRepository;
use App\Services\BankService;
use App\Exceptions\ApiException;
use Carbon\Carbon;
use Log;

class FinancialMovementController extends Controller
{
    private $bankService;

    public function __construct(FinancialMovementRepository $financialMovementRepository, BankService $bankService)
    {
        $this->repository = $financialMovementRepository;
        $this->bankService = $bankService;
    }

    public function balance($id)
    {
        try{
            Log::debug('[FinancialMovementController][balance] $id: ' . $id);
            $balance = $this->bankService->getBalance($id);
            $data = new BalanceResource($balance);
            return response($data);
        }catch(ApiException $ex){
            return self::responseApiErro($ex);
        }catch(\Exception $ex){
            return self::responseInternalErro($ex);
        }
    }

    public function movement($id, Request $request)
    {
        try{
            Log::debug('[FinancialMovementController][movement] $id: ' . $id . ' $request->all(): ' . json_encode($request->all()));
            $data = $request->all();
            if(!isset($data['movement']) || !isset($data['value']) || !isset($data['bank_account_id'])){
                throw new ApiException("Requisição incompleta!");
            }else if($data['value'] < 0){
                throw new ApiException("Requisição incompleta!");
            }

            $sucess = $this->bankService->createMovement($data);
            return response(['sucess' => $sucess]);
        }catch(ApiException $ex){
            return self::responseApiErro($ex);
        }catch(\Exception $ex){
            Log::error($ex);
            return self::responseInternalErro($ex);
        }
    }

    public function statement($id)
    {
        try{
            Log::debug('[FinancialMovementController][statement] $id: ' . $id);
            $statements = $this->bankService->getStatement($id);
            $data = StatementResource::collection($statements);
            return response($data);
        }catch(ApiException $ex){
            return self::responseApiErro($ex);
        }catch(\Exception $ex){
            return self::responseInternalErro($ex);
        }
    }

}
