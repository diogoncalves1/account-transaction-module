<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class AccountUser extends Model
{
    /** @use HasFactory<\Database\Factories\AccountUserFactory> */
    use HasFactory;

    protected $table = 'account_users';
    protected $fillable = ['user_id', 'account_id', 'shared_role_id', 'status', 'invited_at', 'accepted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function sharedRole()
    {
        // return $this->belongsTo(SharedRole::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
