<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountRepository implements RepositoryInterface
{
    public function all()
    {
        return Account::all();
    }

    public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $input = $request->only('name', 'type', 'currency_id');

                $account = Account::create($input);

                if ($request->get('initial_amount')) {
                }

                Log::info('Account ' . $account->id . ' successfully added.');
                return response()->json(['success' => true, 'message' => __('alerts.accountAdded')]);
            });
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => __('alerts.errorAddAccount')], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $account = $this->show($id);

                $input = $request->only('name', 'type', 'currency_id');

                $account->update($input);

                Log::info('Account ' . $account->id . ' successfully updated.');
                return response()->json(['success' => true, 'message' => __('alerts.accountUpdated')]);
            });
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => __('alerts.errorUpdateAccount')], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $account = $this->show($id);

                $account->delete();

                Log::info('Account ' . $account . ' successfully destroyed');
                return response()->json(["error" => true, "message" => __('alerts.accountDeleted')], 500);
            });
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(["error" => true, "message" => __('alerts.errorDeleteAccount')], 500);
        }
    }

    public function show(string $id)
    {
        return Account::find($id);
    }
}
