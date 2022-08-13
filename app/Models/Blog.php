<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Yajra\DataTables\DataTables;
use App\Traits\HasTranslations;
use App\Traits\HasAttachments;
use App\Casts\File;

class Blog extends Model implements LocalizedUrlRoutable
{
    use HasTranslations, HasAttachments;

    /** basic props **/

    protected $fillable = [
        'id'
    ];

    protected $appends = [
        'slug',
        'title',
        'content'
    ];

    /** props **/

    public $disk = 'blogs';

    const TRANSLATABLES = [
        'slug',
        'title',
        'content'
    ];

    /** events **/

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->purgeFiles('thumbnail');
            $model->purgeFiles('images');
            $model->purgeTranslations();
        });
    }

    /** relations **/

    public function thumbnail()
    {
        return $this->morphOne(Attachment::class, 'attachmentable')->where('group', 'thumbnail');
    }

    public function images()
    {
        return $this->morphMany(Attachment::class, 'attachmentable')->where('group', 'images');
    }

    /** casts **/

    public function slug(): Attribute
    {
        return new Attribute(
            get: fn () => $this->translated('slug')
        );
    }

    public function title(): Attribute
    {
        return new Attribute(
            get: fn () => $this->translated('title')
        );
    }

    public function content(): Attribute
    {
        return new Attribute(
            get: fn () => $this->translated('content')
        );
    }

    /** helpers **/

    /** static helpers **/

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('content', function ($model) {
                $c = strip_tags($model->content);
                $max = 60;
                return strlen($c) > 60 ? (substr($c, 0, 60) . '...') : $c;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format(env('ADMIN_DATETIME_FORMAT'));
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'blogs'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /** private helpers **/
}
