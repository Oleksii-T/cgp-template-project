<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\DataTables\DataTables;
use App\Casts\File;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'stripe_id',
        'email_verified_at'
    ];

    public $disk = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'avatar' => File::class
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $disk = Storage::disk($model->disk);
            $disk->delete($model->getRawOriginal('avatar'));
        });
    }

    public function isAdmin()
    {
        return (bool)$this->roles()->where('name', 'admin')->count();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function socials()
    {
        return $this->hasMany(SocialUser::class);
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
