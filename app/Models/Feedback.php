<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'title',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('user', function ($model) {
                $user = $model->user;
                if (!$user) {
                    return '';
                }
                return '<a class="btn btn-default" href="' . route('admin.users.edit', $user) . '">' . $user->name . '</a>';
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format(env('ADMIN_DATETIME_FORMAT'));
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'feedbacks',
                    'actions' => ['show', 'destroy']
                ])->render();
            })
            ->rawColumns(['user', 'action'])
            ->make(true);
    }
}
