<?php

namespace App\Providers;

use App\Models\menu\MenuModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();

            // For now, if no user logged in, just use user 5 as super admin
            if (!$user) {
                $roleIds = collect([5]); // Super admin
            } else {
                // If you want later, use real roles from logged-in user
                $roleIds = $user->roles->pluck('id');
            }

            if ($roleIds->isEmpty()) {
                $view->with('formattedMenu', []);
                return;
            }

            $menus = MenuModel::whereIn('id', function ($query) use ($roleIds) {
                $query->select('menu')
                    ->from('menu_assign')
                    ->whereIn('role_id', $roleIds);
            })
                ->orderByRaw("CASE WHEN parent_id IS NULL OR parent_id = '#' THEN 0 ELSE 1 END")
                ->orderBy('id', 'asc')
                ->get();

            $menuMap = [];
            $formattedMenu = [];

            foreach ($menus as $menu) {
                $parentId = ($menu->parent_id === '#' || $menu->parent_id === null) ? null : (int)$menu->parent_id;

                $menuMap[$menu->id] = [
                    'id' => $menu->id,
                    'parent_id' => $parentId,
                    'title' => $menu->title,
                    'desc' => $menu->desc,
                    'url' => $menu->url,
                    'icon' => $menu->icon,
                    'submenu' => [],
                ];
            }

            foreach ($menuMap as $id => &$menu) {
                if ($menu['parent_id'] !== null && isset($menuMap[$menu['parent_id']])) {
                    $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
                } else {
                    $formattedMenu[] = &$menu;
                }
            }

            $view->with('formattedMenu', $formattedMenu);
        });
    }
}
