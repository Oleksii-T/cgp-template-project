<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return (bool)$this->roles()->where('name', 'admin')->count();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function getDefaultPaymentMethod()
    {
        return $this->paymentMethods()->where('is_default', 1)->first();
    }

    public function activeSubscription()
    {
        // subscription is actve if it has active(payed) cycle, even if it is canceled
        return $this->subscriptions()->whereHas('cycle')->get()->first();
    }

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format(env('ADMIN_DATETIME_FORMAT'));
            })
            ->addColumn('action', function ($model) {
                return view('admin.users.actions-list', compact('model'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
