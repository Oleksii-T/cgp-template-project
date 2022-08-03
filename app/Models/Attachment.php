<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    /**
     * @var array
     */
	protected $fillable = [
        'name',
        'path',
        'original_name',
        'type',
        'size',
        'attachmentable_id',
        'attachmentable_id_type'
    ];

    protected $appends = [
        'url'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getSize()
    {
        if ($this->size > 1024) {
            return number_format($this->size / 1024, 2) . ' Mb';
        } else {
            return $this->size . ' Kb';
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->url != null && Storage::exists(str_replace('storage', "public", $model->url))) {
                Storage::delete(str_replace('storage', "public", $model->url));
            }
        });
    }

    public function url(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strpos($this->path, 'http') === 0
                ? $this->path
                : Storage::disk(self::disk($this->type))->url($this->name),
        );
    }

    public static function disk($type)
    {
        switch ($type) {
            case 'video':
                return 'videos';
            case 'image':
                return 'images';
            default:
                return 'files';
        }
    }
}
