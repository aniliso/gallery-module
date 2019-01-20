<?php

namespace Modules\Gallery\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterGallerySidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('gallery::gallery.title.gallery'), function (Item $item) {
                $item->icon('fa fa-image');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('gallery::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.gallery.category.create');
                    $item->route('admin.gallery.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('gallery.categories.index')
                    );
                });
                $item->item(trans('gallery::albums.title.albums'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.gallery.album.create');
                    $item->route('admin.gallery.album.index');
                    $item->authorize(
                        $this->auth->hasAccess('gallery.albums.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
