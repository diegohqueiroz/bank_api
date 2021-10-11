<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankAccount as BankAccountResource;
use App\Http\Resources\BankAccountList as BankAccountListResource;
use App\Repositories\BankAccountRepository;
use App\Exceptions\ApiException;
use Log;

class BankAccountController extends Controller
{

    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->repository = $bankAccountRepository;
    }

    public function index(Request $request)
    {
        //$all = !$request->has('active');
        try{
            Log::debug('[BankAccountController][index] $request->all(): ' . json_encode($request->all()));
            $active = $request->boolean('active');
            $number = $request->number;
            if($number){
                $object = $this->repository->findByNumber($number, $active);
                $data = BankAccountListResource::collection($object);
            }else{
                $object = $this->repository->get($active);
                $data = BankAccountListResource::collection($object);
            }

            Log::debug('[BankAccountController][index] $data: ' . json_encode($data));
            return response($data);
        }catch(\Execption $ex){
            Log::error($ex);
            return response(500);
        }
    }

    public function show($id)
    {
        try{
            Log::debug('[BankAccountController][show] $id: ' . $id);
            $object = $this->repository->find($id);

            if($object == null)
                throw new ApiException("Conta não encontrada");
              
            $data = new BankAccountResource($object);
            Log::debug('[BankAccountController][show] $data: ' . json_encode($data));
            return response($data);
        }catch(ApiException $ex){
            return self::responseApiErro($ex);
        }catch(\Exception $ex){
            Log::error($ex);
            return self::responseInternalErro($ex);
        }
    }

}
