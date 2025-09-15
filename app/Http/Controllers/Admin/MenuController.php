<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class MenuController extends Controller
{


    public function index(Request $request)
    {
        $title = 'Kelola Menu';
        $selectedMenu = '';
        $menuitems = [];
        if (isset($request->id)) {
            $id = $request->id;
            if ($id == 'new') {
                $selectedMenu = '';
            } else {
                $selectedMenu = \App\Models\Menu::where('id', $id)->first();
                if ($selectedMenu && $selectedMenu->content == '') {
                    $menuitems = \App\Models\MenuItem::where('menu_id', $selectedMenu->id)->get();
                } elseif ($selectedMenu && $selectedMenu->content != '') {
                    // $menuitems = \App\Models\MenuItem::where('menu_id', $selectedMenu->id)->get();

                    $menuitems = json_decode($selectedMenu->content);
                    $menuitems = $menuitems[0];


                    foreach ($menuitems as $menuitem) {
                        $menuitem->id = \App\Models\MenuItem::where('id', $menuitem->id)->value('id');
                        $menuitem->title = \App\Models\MenuItem::where('id', $menuitem->id)->value('title');
                        $menuitem->name = \App\Models\MenuItem::where('id', $menuitem->id)->value('name');
                        $menuitem->slug = \App\Models\MenuItem::where('id', $menuitem->id)->value('slug');
                        $menuitem->type = \App\Models\MenuItem::where('id', $menuitem->id)->value('type');
                        $menuitem->target = \App\Models\MenuItem::where('id', $menuitem->id)->value('target');
                        if (!empty($menuitem->children[0])) {
                            foreach ($menuitem->children[0] as $child) {
                                $child->id = \App\Models\MenuItem::where('id', $child->id)->value('id');
                                $child->title = \App\Models\MenuItem::where('id', $child->id)->value('title');
                                $child->name = \App\Models\MenuItem::where('id', $child->id)->value('name');
                                $child->slug = \App\Models\MenuItem::where('id', $child->id)->value('slug');
                                $child->type = \App\Models\MenuItem::where('id', $child->id)->value('type');
                                $child->target = \App\Models\MenuItem::where('id', $child->id)->value('target');
                                if (!empty($child->children[0])) {
                                    foreach ($child->children[0] as $subChild) {
                                        $subChild->id = \App\Models\MenuItem::where('id', $subChild->id)->value('id');
                                        $subChild->title = \App\Models\MenuItem::where('id', $subChild->id)->value('title');
                                        $subChild->name = \App\Models\MenuItem::where('id', $subChild->id)->value('name');
                                        $subChild->slug = \App\Models\MenuItem::where('id', $subChild->id)->value('slug');
                                        $subChild->type = \App\Models\MenuItem::where('id', $subChild->id)->value('type');
                                        $subChild->target = \App\Models\MenuItem::where('id', $subChild->id)->value('target');
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $posts = \App\Models\Post::whereHas('category', function ($q) {
            $q->where('slug', 'artikel');
        })->orderBy('created_at', 'DESC')->get();

        // return $menuitems;
        $categories = \App\Models\Category::all();
        // return $categories;
        return view('admin.menu.index', [
            'categories' => \App\Models\Category::all(),
            'posts' => $posts,
            'menus' => \App\Models\Menu::all(),
            'title' => $title,
            'br1'  => 'Manage',
            'br2'  => 'Menus',
            'selectedMenu' => $selectedMenu,
            'menuitems' => $menuitems
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \App\Models\Menu::create($data);
        $menu = \App\Models\Menu::orderBy('id', 'DESC')->first();
        return redirect('blog/menus?id=' . $menu->id)->with('success', 'Menu Saved Successfully');
    }

    public function addCategory(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = \App\Models\Menu::findOrFail($menuid);

        if ($menu->content == '') {
            foreach ($ids as $id) {
                $cat = \App\Models\Category::where('id', $id)->first();
                $data['title'] = $cat->title;
                $data['slug'] = $cat->slug;
                $data['type'] = 'category';
                $data['target'] = '_self';
                $data['menu_id'] = $menuid;
                \App\Models\MenuItem::create($data);
            }
        } else {
            foreach ($ids as $id) {
                $menudata = json_decode($menu->content, true);

                $cat = \App\Models\Category::where('id', $id)->first();
                $data['title'] = $cat->title;
                $data['slug'] = $cat->slug;
                $data['type'] = 'category';
                $data['target'] = '_self';
                $data['menu_id'] = $menuid;
                \App\Models\MenuItem::create($data);

                $lastData = \App\Models\MenuItem::orderBy('id', 'DESC')->first();
                $newData = [];
                $newData['id'] = $lastData->id;
                $newData['slug'] = $lastData->slug;
                $newData['title'] = $lastData->title;
                $newData['type'] = $lastData->slug;
                $newData['target'] = $lastData->target;
                $newData['children'] = [[]];
                array_push($menudata[0], $newData);
                $menudata = json_encode($menudata);
                $menu->update(['content' => $menudata]);
            }
        }
    }

    public function addPost(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = \App\Models\Menu::findOrFail($menuid);

        if ($menu->content == '') {
            foreach ($ids as $id) {
                $cat = \App\Models\Post::where('id', $id)->first();
                $data['title'] = $cat->title;
                $data['slug'] = 'post/' . $cat->slug;
                $data['target'] = '_self';
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                \App\Models\MenuItem::create($data);
            }
        } else {
            foreach ($ids as $id) {
                $menudata = json_decode($menu->content, true);

                $cat = \App\Models\Post::where('id', $id)->first();
                $data['title'] = $cat->title;
                $data['slug'] = 'post/' . $cat->slug;
                $data['target'] = '_self';
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                \App\Models\MenuItem::create($data);

                $lastData = \App\Models\MenuItem::orderBy('id', 'DESC')->first();
                $newData = [];
                $newData['id'] = $lastData->id;
                $newData['slug'] = $lastData->slug;
                $newData['title'] = $lastData->title;
                $newData['type'] = $lastData->slug;
                $newData['target'] = $lastData->target;
                $newData['children'] = [[]];
                array_push($menudata[0], $newData);
                $menudata = json_encode($menudata);
                $menu->update(['content' => $menudata]);
            }
        }
    }

    public function addCustomLink(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = \App\Models\Menu::findOrFail($menuid);

        // Check if http exist or not
        $slug = $request->url;
        if(strpos($slug, "http") !== false) {
            // $slug = 'https://' . $slug;
        } else {
            $slug = 'https://' . $slug;
        }

        if ($menu->content == '') {
            $data['title'] = $request->link;
            $data['slug'] = $slug;
            $data['target'] = $request->target;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            \App\Models\MenuItem::create($data);
        } else {
            $menudata = json_decode($menu->content, true);

            $data['title'] = $request->link;
            $data['slug'] = $slug;
            $data['target'] = $request->target;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            \App\Models\MenuItem::create($data);

            $lastData = \App\Models\MenuItem::orderBy('id', 'DESC')->first();
            $newData = [];
            $newData['id'] = $lastData->id;
            $newData['slug'] = $lastData->slug;
            $newData['title'] = $lastData->title;
            $newData['type'] = $lastData->type;
            $newData['target'] = $lastData->target;
            $newData['children'] = [[]];
            array_push($menudata[0], $newData);
            $menudata = json_encode($menudata);
            $menu->update(['content' => $menudata]);
        }
    }

    public function saveMenu(Request $request)
    {
        $data = $request->all();
        if ($data['menuid']) {

            if ($request->has('newContent')) {
                $data['content'] = $request->newContent;
            }

            $menu = \App\Models\Menu::findOrFail($data['menuid']);
            $menu->update($data);
            redirect()->back()->with('success', 'Menu Saved Successfully');
        } else {
            redirect()->back()->with('failed', 'No Menu Selected');
        }
    }

    public function updateItem(Request $request, $id, $k1, $k2 = '', $k3 = '')
    {
        // Find Menu Item by ID and Update data in Table menu_items
        $menuitem = \App\Models\MenuItem::findOrFail($request->id);
        if ($menuitem->type == 'custom') {
            $toUpdate = [
                'name' => $request->name,
                'target' => $request->target,
                'slug' => $request->slug
            ];
        } else {
            $toUpdate = [
                'name' => $request->name,
            ];
        }
        $menuitem->update($toUpdate);
        $menuitem->fresh();

        // Find Menu by menuitem->menu_id
        $menu = \App\Models\Menu::where('id', $menuitem->menu_id)->first();

        // Convert Data JSON 
        $data = json_decode($menu->content, true);

        // Update data by key
        if ($k3 != '' && $k2 != '') {
            $data[0][$k1]['children'][0][$k2]['children'][0][$k3]['title'] = $request->name;
            if ($menuitem->type == 'custom') {
                $data[0][$k1]['children'][0][$k2]['children'][0][$k3]['target'] = $request->target;
                $data[0][$k1]['children'][0][$k2]['children'][0][$k3]['slug'] = $request->slug;
            }
            $newdata = json_encode($data);
            $menu->update(['content' => $newdata]);
        } elseif ($k3 == '' && $k2 != '') {
            $data[0][$k1]['children'][0][$k2]['title'] = $request->name;
            if ($menuitem->type == 'custom') {
                $data[0][$k1]['children'][0][$k2]['target'] = $request->target;
                $data[0][$k1]['children'][0][$k2]['slug'] = $request->slug;
            }
            $newdata = json_encode($data);
            $menu->update(['content' => $newdata]);
        } else {

            // return 'id: ' . $id . ' k1: ' . $k1;

            $data[0][$k1]['title'] = $request->name;

            // return $data;
            if ($menuitem->type == 'custom') {
                $data[0][$k1]['target'] = $request->target;
                $data[0][$k1]['slug'] = $request->slug;
            }
            $newdata = json_encode($data);
            $menu->update(['content' => $newdata]);
        }

        // $data = $request->all();
        // $menuitem->update($data);
        return redirect()->back();
    }

    public function deleteItem($id, $k1, $k2 = '', $k3 = '')
    {
        $menuitem = \App\Models\MenuItem::findOrFail($id);
        $menu = \App\Models\Menu::where('id', $menuitem->menu_id)->first();
        if ($menu->content != '') {
            $data = json_decode($menu->content, true);
            $maindata = $data[0];

            if ($k3 != '' && $k2 != '') {
                unset($data[0][$k1]['children'][0][$k2]['children'][0][$k3]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            } elseif ($k3 == '' && $k2 != '') {
                unset($data[0][$k1]['children'][0][$k2]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            } else {
                unset($data[0][$k1]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            }
        }
        $menuitem->delete();
        return redirect()->back();
    }
}
