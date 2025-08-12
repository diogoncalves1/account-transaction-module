<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionRepository implements RepositoryInterface
{
    public function all()
    {
        return Transaction::all();
    }

    public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $input = $request->only([]);
            });
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $input = $request->only([]);
            });
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function destroy(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {});
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function show(string $id)
    {
        return Transaction::find($id);
    }
}