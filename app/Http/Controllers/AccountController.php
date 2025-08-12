<?php

namespace App\Http\Controllers;

use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Session;

class AccountController extends AppController
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        //

        Session::flash('page', 'accounts');

        return view('frontend.accounts.index');
    }

    public function create()
    {
        //
        Session::flash('page', 'accounts');

        return view('frontend.accounts.form');
    }
    public function edit(string $id)
    {
        //
        Session::flash('page', 'accounts');

        $account = $this->accountRepository->show($id);

        return view('frontend.accounts.form', compact('account'));
    }

    public function show(string $id)
    {
        //
        Session::flash('page', 'accounts');

        $account = $this->accountRepository->show($id);

        return view('frontend.accounts.show', compact('account'));
    }
}