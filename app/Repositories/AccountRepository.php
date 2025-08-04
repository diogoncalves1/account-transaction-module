<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function dataTable(Request $request)
    {
        // App::setLocale($request->get("locale"));
        $userId = Auth::id();

        $query =  Account::query();

        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere("type", 'like', "%{$search}%")
                    ->orWhere("balance", 'like', "%{$search}%");
            });
        }

        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = $request->input("columns.$orderColumnIndex.data");
        $orderDir = $request->input('order.0.dir');
        if ($orderColumn && $orderDir) {
            $query->orderBy($orderColumn, $orderDir);
        }


        $accounts = $query->offset($request->start)
            ->limit($request->length)
            ->whereHas("accounts_user", function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->distinct()
            ->get();

        $total = $query->count();
        foreach ($accounts as &$account) {
            $account->type = __("frontend." . $account->type);
            $account->user = $account->users->map(function ($user) {
                return $user->name;
            });
            $account->currencySymbol = $account->currency->symbol;

            $sharedRole = $account->shared_role->first();

            $btnGroup = "<div class='btn-group'>";
            if ($sharedRole->hasPermission("viewAccountDetails"))
                $btnGroup .= "<button type='button' onclick='goToView({$account->id})' data-toggle='tooltip' data-placement='top'
                                 title='" . __('frontend.viewDetails')  . "' class='btn mr-1 btn-default'>
                                <i class='fas fa-eye'></i> 
                            </button>";
            if ($sharedRole->hasPermission("editAccount"))
                $btnGroup .= "<button type='button' onclick='goToEdit({$account->id})' data-toggle='tooltip' data-placement='top'
                                 title='" . __('frontend.editAccount')  . "' class='btn mr-1 btn-default'>
                                <i class='fas fa-edit'></i>
                            </button>";
            if ($sharedRole->hasPermission("deleteAccount"))
                $btnGroup .= "<button type='button' onclick='modalDelete(" . route('accounts.destroy', $account->id) . ")' data-toggle='tooltip' data-placement='top'
                                 title='" . __('frontend.deleteAccount')  . "' class='btn btn-default'>
                                <i class='fas fa-trash'></i>
                            </button>";
            $btnGroup .= "</div>";
            $account->actions = $btnGroup;
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $accounts
        ]);
    }
}
