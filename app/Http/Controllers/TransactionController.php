<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\AccountRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    private TransactionRepository $transactionRepository;
    private AccountRepository $accountRepository;


    public function __construct(AccountRepository $accountRepository, TransactionRepository $transactionRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        //

        Session::flash('page', 'transactions');

        return view('frontend.transactions.index');
    }

    public function create()
    {
        //

        Session::flash('page', 'transactions');

        $accounts = $this->accountRepository->allUser();

        return view('frontend.transactions.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }
}