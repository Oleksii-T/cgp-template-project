<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;
use App\Traits\HasAttachment;

class Feedback extends Model
{
    use HasAttachment;

    protected $fillable = [
        'user_id',
        'email',
        'title',
        'text'
    ];

    public function file()
    {
        return $this->morphOne(Attachment::class, 'attachmentable')->where('group', 'file');
    }

    public function image()
    {
        return $this->morphOne(Attachment::class, 'attachmentable')->where('group', 'image');
    }

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
                return view('admin.feedbacks.actions-list', compact('model'))->render();
            })
            ->rawColumns(['user', 'action'])
            ->make(true);
    }
}
