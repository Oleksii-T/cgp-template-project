<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'stripe_id',
        'price',
        'title',
        'description',
        'interval',
        'trial'
    ];

    CONST INTERVALS = [
        'month',
        'year'
    ];

    public function scopeMonthly($query, $get=false)
    {
        $query->where('interval', 'month');
        return $get ? $query->get() : $query;
    }

    public function scopeYearly($query, $get=false)
    {
        $query->where('interval', 'year');
        return $get ? $query->get() : $query;
    }

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->editColumn('price', function ($model) {
                return Setting::get('currency_sign') . $model->price;
            })
            ->editColumn('interval', function ($model) {
                return ucfirst($model->interval);
            })
            ->editColumn('trial', function ($model) {
                return $model->trial ? ($model->trial . ' days') : 'none';
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'subscription-plans'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
