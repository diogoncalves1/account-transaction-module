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
        //

        $this->accountRepository->store($request);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
