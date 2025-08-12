<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function store(TransactionRequest $request)
    {
        $response = $this->transactionRepository->store($request);

        return $response;
    }

    public function update(TransactionRequest $request, string $id)
    {
        $response = $this->transactionRepository->update($request, $id);

        return $response;
    }

    public function destroy(string $id)
    {
        $response = $this->transactionRepository->destroy($id);

        return $response;
    }

    public function dataTable(Request $request)
    {
        $response = $this->transactionRepository->dataTable($request);

        return $response;
    }
}
