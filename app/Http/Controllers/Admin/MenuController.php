<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.menus.index');
        }

        return Menu::dataTable(Menu::query());
    }

    public function edit(Request $request, Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function store(MenuRequest $request)
    {
        $menu = Menu::findByCode($request->code);
        $data = $request->except('_token');

        $data['link'] = $data['link'] ?? Str::slug($data['title']);

        if (!isset($data['item_id'])) {
            $data['sort'] = MenuItem::getLastSort($menu->id);
            $data['menu_id'] = $menu->id;

            $menuItem = MenuItem::create($data);
        } else {
            $menuItem = MenuItem::find($data['item_id']);
            $menuItem->update($data);
        }

        return response()->json([
            'status' => 'success',
            'html' => view('components.admin.menu-items-sortable', ['menu' => $menu])->render(),
            'id' => $menuItem->id,
            'sort' => $menuItem->sort,
            'title' => $menuItem->title,
            'icon' => $menuItem->icon
        ]);
    }

    public function get_sortable(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'html' => view('components.admin.menu-items-sortable', ['menu' => Menu::findByCode($request->code)])->render()
        ]);
    }

    public function save_sortable(Request $request)
    {
        foreach ($request->items as $id => $item) {
            $menuItem = MenuItem::find($id);

            if ($menuItem->menu->code != $request->code)
                continue;

            $menuItem->sort = $item['sort'];
            $menuItem->parent_id = isset($item['parent_id']) ? $item['parent_id'] : null;
            $menuItem->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menu_items,id'
        ]);

        MenuItem::find($request->id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
