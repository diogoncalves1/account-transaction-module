<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Currency\Entities\Currency;
use Modules\User\Entities\User;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $table = "accounts";
    protected $fillable = ['name', 'type', 'balance', 'currency_id', 'active'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'accounts_user', 'account_id', 'user_id')
            ->using(AccountUser::class)
            ->withPivot('shared_role_id');
    }

    public function userSharedRole()
    {
        return $this->users()
            ->where('account_users.user_id', auth()->id())
            ->join('shared_roles', 'account_users.shared_role_id', '=', 'shared_roles.id')
            ->first();
    }
}
