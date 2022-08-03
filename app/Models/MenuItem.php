<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Casts\File;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'link',
        'icon',
        'sort'
    ];

    public $disk = 'menus';

    protected $casts = [
        'icon' => File::class
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id')->whereNotNull('parent_id')->orderBy('sort');
    }

    public static function getLastSort($menuId)
    {
        $lastSort = self::where('menu_id', $menuId)->orderBy('sort', 'desc')->first();

        return is_null($lastSort) ? 0 : $lastSort->sort + 1;
    }
}
