<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppController;
use App\Http\Requests\AccountRequest;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;

class AccountController extends AppController
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function store(AccountRequest $request)
    {
        $response = $this->accountRepository->store($request);

        return $response;
    }

    public function update(AccountRequest $request, string $id)
    {
        $response = $this->accountRepository->update($request, $id);

        return $response;
    }

    public function destroy(string $id)
    {
        $response = $this->accountRepository->destroy($id);

        return $response;
    }

    public function dataTable(Request $request)
    {
        $response = $this->accountRepository->dataTable($request);

        return $response;
    }
}
