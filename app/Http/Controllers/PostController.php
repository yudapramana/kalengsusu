<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Kabkota, Post, Tag};
use Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Purifier; // mews/purifier

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = null;
        if ($request->has('category')) {
            $category = $request->input('category');
        } else {
            $category = 'utama';
        }

        $categoryRow = Category::where('slug', $category)->firstOrFail();
        $categoryID = $category ? $categoryRow->id : null;


        $user = Auth::user();
        $pQuery = Post::query();


        if ($request->ajax()) {


            if ($user->hasRole('kontributor_daerah')) {
                $id_kabkota = $user->id_kabkota;
                $pQuery = $pQuery->where('id_kabkota', $id_kabkota);
            } else {

                if($category == 'daerah') {
                    // $pQuery = $pQuery->where('status', 'draft');

                    $pQuery = $pQuery->where('id_kabkota', $request->id_kabkota_filter);
                }

            }


            $pQuery = $pQuery->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
            $pQuery = $pQuery->orderBy('created_at', 'desc');

            if ($user->hasRole('kontributor_daerah')) {
                $posts = $pQuery->take(50)->get();
            } elseif ((!$user->hasRole('kontributor_daerah')) && $category == 'daerah') {
                $posts = $pQuery->take(50)->get();
            } else {
                $posts = $pQuery->take(50)->get();
            }



            $datatable = DataTables::of($posts)
                ->addIndexColumn()
                // ->addColumn('title_can', function ($post) {
                //     $text = '<span style="font-weight:bolder;">' . $post->title . ' &nbsp; <br> <span class="text-muted" style="font-size:x-small">' . $post->created_at->format('d-m-Y') . '</span><br>
                //             <span class="text-muted preserveLines" style="font-size:smaller">Slug: ' . $post->slug . ' </span><br>
                //             <span class="text-muted preserveLines" style="font-size:xx-small">Keywords: ' . $post->keywords . ' </span><br>
                //             <span class="text-muted preserveLines" style="font-size:xx-small">Meta:' . $post->meta_desc . ' </span>';
                //     return $text;
                // })
                ->addColumn('image_url_can', function ($post) {
                    $img = $post->cover_small;
                    if ($img) {
                        $html = '<div class="profile-edit">
                                    <img class="profile-edit" id="profile_photo_jst" src="' . $img . '" alt="None">
                                </div>';
                    } else {
                        $html = '-';
                    }
                    return $html;
                })
                ->addColumn('title_can', function ($post) {
                    $editor = $post->editor ? $post->editor : '-';
                    $photographer = $post->photographer ? $post->photographer : '-';

                    $text = '<span style="font-weight:bolder;"><a class="text-black" target="_blank" href="' . config('isec.base_url') .'/post/' . $post->slug.' ">' . $post->title . '</a></span> <br>
                            <span class="text-muted preserveLines" style="font-size:xx-small">Editor: ' . $editor  . ' </span>&nbsp
                              <span class="text-muted preserveLines" style="font-size:xx-small">Fotografer: ' . $photographer . ' </span>';
                    return $text;
                })
                ->addColumn('highlights', function ($post) {
                    $text = '';

                    if ($post->is_featured == 1) {
                        $text .= '<span class="badge bg-primary" style="font-size:x-small">featured</a></span>&nbsp;';
                    }
                    if ($post->is_slider == 1) {
                        $text .= '<span class="badge bg-primary" style="font-size:x-small">slider</a></span>&nbsp;';
                    }
                    if ($post->is_recommended == 1) {
                        $text .= '<span class="badge bg-primary" style="font-size:x-small">recommended</a></span>&nbsp;';
                    }
                    if ($post->is_breaking == 1) {
                        $text .= '<span class="badge bg-primary" style="font-size:x-small">breaking</a></span>&nbsp;';
                    }
                    return $text;
                })
                ->addColumn('date_add', function ($post) {
                    $text = '<span class="text-muted" style="font-size:x-small">' . $post->created_at->format('d-m-Y h:i:s') . '</span>';
                    return $text;
                })
                ->addColumn('author', function ($post) {
                    $text = '<span class="text-muted" style="font-size:x-small"><a style="color:gray; font-weight:bold" target="_blank" href=' .  route('blog.list', 'author=' . $post->user->name)  . '>' . $post->user->username . '</a></span>';
                    return $text;
                })

                ->addColumn('category_title', function ($post) {
                    $text = '<span class="badge bg-secondary" style="font-size:x-small"><a style="color:white;" target="_blank" href=' .  route('blog.list', 'category=' . $post->category->title)  . '>' . $post->category->title . '</a></span>';
                    return $text;
                })
                ->addColumn('action', function ($post) use ($user) {
                    $btn = '';

                    // cek apakah status published
                    $isPublished = $post->status === 'published';

                    // tombol edit
                    if ($isPublished) {
                        $btn .= '<button class="btn btn-sm btn-warning btn-xs" disabled><i class="bi bi-pencil-square"></i></button>&nbsp;';
                    } else {
                        $btn .= '<a href="' . route('posts.edit', $post->id) . '" class="btn btn-sm btn-warning btn-xs"><i class="bi bi-pencil-square"></i></a>&nbsp;';
                    }

                    // tombol hapus
                    if ($user->hasRole('super_administrator') || $user->hasRole('administrator') || $user->hasRole('kontributor_utama')) {
                        if ($isPublished) {
                            $btn .= '<button class="btn btn-sm btn-danger btn-xs" disabled><i class="bi bi-trash-fill"></i></button>';
                        } else {
                            $btn .= '<button id="destroyBtn" type="button" class="btn btn-sm btn-danger btn-xs" data-bs-id_item="' . $post->id  . '" data-id_item="' .  $post->id  . '"><i class="bi bi-trash-fill"></i></button>';
                        }
                    }

                    return $btn;
                })
                ->addColumn('datastatus', function ($item) use ($user) {
                    $statusArr = ['published', 'draft', 'archived'];
                    $colorArr = ['success', 'warning', 'danger'];
                    $nowColor = null;
                    $statusNow = $item->status;
                    if (($key = array_search($statusNow, $statusArr)) !== false) {
                        unset($statusArr[$key]);
                        $nowColor = $colorArr[$key];
                    }

                    if ($user->hasRole('super_administrator') || $user->hasRole('editor_utama')) {
                    // if ($user->hasRole('super_administrator') || $user->hasRole('editor_utama') || $user->hasRole('kontributor_utama') || $user->hasRole('kontributor daerah')) {

                        $btn = '<span class="badge bg-' . $nowColor . ' dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="">' . $statusNow . '</span>';
                        $btn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';

                        foreach ($statusArr as $stat) {
                            $btn .= '<button id="switchBtn" class="dropdown-item" tabindex="0" aria-controls="defTbl" title="" data-bs-original-title="Switch Status" type="button" data-status="' . $stat . '"><span>ubah menjadi ' . $stat . '</span></button>';
                        }

                        $btn .=    '</div>';
                    } else {
                        $btn = '<span class="badge bg-' . $nowColor . ' " id="btnGroupDrop1" type="button" data-bs-original-title="" title="">' . $statusNow . '</span>';
                    }
                    return $btn;
                })
                ->addColumn('desc_beautify', function ($post) {
                    $html = '';
                    $html .=  \Illuminate\Support\Str::limit($post->desc, 200, $end = '...');
                    $html .= '<br>';
                    $html .= '<span class="text-muted preserveLines" style="font-size:smaller">View Count: ' . $post->view_count . ' Reads</span>';
                    return $html;
                })
                ->rawColumns(['highlights', 'category_title', 'action', 'desc_beautify', 'title_can', 'datastatus', 'date_add', 'author', 'image_url_can']);


            $kabkotas = Kabkota::get();

            $html_filter = '<div class="col-md-12">
                                <label for="kabkota" class="form-label fw-bold">Pilih Daerah</label>
                                <select class="form-control select2-filter id_kabkota_filter" id="id_kabkota_filter">
                                    <option value="0">Pilih Daerah</option>';
            foreach ($kabkotas as $key => $item) {
                $html_filter .= '<option value="' . $item->id_kabkota . '">' . $item->name . '</option>';
            }
            $html_filter .= '  </select>

                            </div>';


            $datatable->with([
                'html_filter' => $html_filter,
            ]);

            return $datatable->make(true);
        }

        $kabkotas = Kabkota::all();
        return view(
            'admin.posts.index',
            [
                'title'  => 'Berita',
                'br1'  => 'Berita',
                'br2'  => ucwords($category),
                'category'  => $category,
                'categoryID' => $categoryID,
                'kabkotas' => $kabkotas,
            ],
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $category = $request->has('category') ? $request->input('category') : null;
        $categoryRow = Category::where('slug', $category)->firstOrFail();
        $categoryID = $category ? $categoryRow->id : null;
        $categories = Category::all();
        $tags       = Tag::all();
        $kabkotas = Kabkota::all();
        $title = 'Posts';
        $br1 = 'Create';
        $br2 = 'Posts';
        return view('admin.posts.create', compact('categories', 'tags', 'title', 'br1', 'br2', 'kabkotas', 'category', 'categoryID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {
        $user = Auth::user();

        // return $request->all();

        $validator = Validator::make($request->all(), [
            "title"     => "required|unique:posts,title",
            "desc"      => "required",
            "category"  => "required",
            "keywords"  => "required",
            "meta_desc" => "required",
            'cover_public_id' => ['required','string','regex:/^[A-Za-z0-9_\-\/]+$/'],
            'cover_version' => ['nullable','regex:/^v\d+$/'],
            'cover_ext' => ['nullable','in:jpg,jpeg,png,gif,webp'],
        ]);

        $payload = [
            'public_id' => $request->input('cover_public_id'),
            'version'   => $request->input('cover_version') ?: null,
            'ext'       => $request->input('cover_ext') ?: null,
            'uploaded_at' => now()->toDateTimeString(),
        ];


        // Encrypt payload menjadi satu string acak
        $cover = Crypt::encryptString(json_encode($payload));

        // Sanitasi HTML (izinkan tag dasar — konfigurasi di config/purifier.php)
        $cleanDesc = Purifier::clean($request->input('desc'));
        


        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post               = new Post();
        $post->cover        = $cover ?? null;
        $post->title        = $request->title;
        $post->slug         = \Str::slug($request->title);
        $post->user_id      = $user->id;
        $post->category_id  = $request->category;
        $post->desc         = $cleanDesc;
        $post->keywords     = $request->keywords;
        $post->meta_desc    = $request->meta_desc;
        $post->id_kabkota   = $request->kabkota;
        $post->editor       = $request->editor;
        $post->photographer = $request->photographer;

        $post->is_breaking    = $request->is_breaking == 'on' ? 1 : 0;
        $post->is_recommended = $request->is_recommended == 'on' ? 1 : 0;
        $post->is_featured    = $request->is_featured == 'on' ? 1 : 0;
        $post->is_slider      = $request->is_slider == 'on' ? 1 : 0;
        $post->status         = 'draft';
        $post->save();

        $categorySlug = \App\Models\Category::find($request->category)->slug;

        if ($request->ajax()) {
            return response()->json([
                'status'   => 'success',
                'message'  => 'Data added successfully',
                'redirect' => route('posts.index', ['category' => $categorySlug]),
                'data'     => $post
            ]);
        }

        return redirect()
            ->route('posts.index', ['category' => $categorySlug])
            ->with('success', 'Data added successfully');
    }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();
    //     $data = $request->input();


    //     $validator = Validator::make($request->all(), [
    //         "title"     => "required|unique:posts,title",
    //         "desc"      => "required",
    //         "category"  => "required",
    //         "keywords"  => "required",
    //         "meta_desc" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $post               = new Post();
    //     $post->cover        = isset($request->cover) ? $request->cover : null;
    //     $post->title        = $request->title;
    //     $post->slug         = \Str::slug($request->title);
    //     $post->user_id      = Auth::user()->id;
    //     $post->category_id  = $request->category;
    //     $post->desc         = $request->desc;
    //     $post->keywords     = $request->keywords;
    //     $post->meta_desc    = $request->meta_desc;
    //     $post->id_kabkota   = $request->kabkota;
    //     $post->editor    = $request->editor;
    //     $post->photographer   = $request->photographer;

    //     $post->is_breaking      = $request->is_breaking == 'on' ? 1 : 0;
    //     $post->is_recommended   = $request->is_recommended == 'on' ? 1 : 0;
    //     $post->is_featured      = $request->is_featured == 'on' ? 1 : 0;
    //     $post->is_slider        = $request->is_slider == 'on' ? 1 : 0;
	//     $post->status = 'draft';

    //     // if ($user->hasRole('kontributor_daerah')) {
    //     //    $post->status = 'draft';
    //     // }

    //     // untag
    //     // $post->save();

    //     // $post->tags()->attach($request->tags);

    //     $categorySlug = \App\Models\Category::find($request->category)->slug;

    //     return redirect()->route('posts.index', ['category' => $categorySlug])->with('success', 'Data added successfully');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $kabkotas = Kabkota::all();

        $title = 'Posts';
        $br1 = 'Edit';
        $br2 = 'Posts';
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'title', 'br1', 'br2', 'kabkotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $user = Auth::user();

    // ambil post
    $post = Post::findOrFail($id);

    // validasi
    $validator = Validator::make($request->all(), [
        "title" => "required|unique:posts,title," . $id, // unique kecuali record ini
        "desc" => "required",
        "category" => "required",
        "keywords" => "required",
        "meta_desc" => "required",
        // saat update, cover bisa nullable (hanya required saat create pada store)
        'cover_public_id' => ['nullable','string','regex:/^[A-Za-z0-9_\-\/]+$/'],
        'cover_version' => ['nullable','regex:/^v\d+$/'],
        'cover_ext' => ['nullable','in:jpg,jpeg,png,gif,webp'],
    ]);

    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // jika ada cover baru (cover_public_id diisi), buat payload enkripsi baru
    if ($request->filled('cover_public_id')) {
        $payload = [
            'public_id' => $request->input('cover_public_id'),
            'version' => $request->input('cover_version') ?: null,
            'ext' => $request->input('cover_ext') ?: null,
            'uploaded_at' => now()->toDateTimeString(),
        ];
        $cover = Crypt::encryptString(json_encode($payload));
        $post->cover = $cover;
    }
    // jika tidak ada input cover, biarkan cover existing (tidak diubah)

    // Sanitasi HTML untuk desc
    $cleanDesc = Purifier::clean($request->input('desc'));

    // update atribut
    $post->title = $request->input('title');
    $post->slug = \Str::slug($request->input('title'));
    $post->user_id = $user->id;
    $post->category_id = $request->input('category');
    $post->desc = $cleanDesc;
    $post->keywords = $request->input('keywords');
    $post->meta_desc = $request->input('meta_desc');
    $post->id_kabkota = $request->input('kabkota');
    $post->editor = $request->input('editor');
    $post->photographer = $request->input('photographer');

    // checkboxes: gunakan has() karena saat unchecked input tidak terkirim
    $post->is_breaking = $request->has('is_breaking') ? 1 : 0;
    $post->is_recommended = $request->has('is_recommended') ? 1 : 0;
    $post->is_featured = $request->has('is_featured') ? 1 : 0;
    $post->is_slider = $request->has('is_slider') ? 1 : 0;

    // status: jangan ubah jika ingin mempertahankan existing,
    // tapi kalau ingin set ulang ke draft, uncomment baris berikut:
    // $post->status = 'draft';

    $post->save();

    // ambil slug category untuk redirect
    $categoryModel = \App\Models\Category::find($request->input('category'));
    $categorySlug = $categoryModel ? $categoryModel->slug : null;

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'redirect' => $categorySlug ? route('posts.index', ['category' => $categorySlug]) : route('posts.index'),
            'data' => $post
        ]);
    }

    return redirect()->route('posts.index', ['category' => $categorySlug])
        ->with('success', 'Data updated successfully');
}

    // public function update(Request $request, $id)
    // {

    //     // return $request->all();
    //     $validator = Validator::make($request->all(), [
    //         "title"     => "required|unique:posts,title," . $id,
    //         "desc"      => "required",
    //         "category"  => "required",
    //         "tags"      => "array|required",
    //         "keywords"  => "required",
    //         "meta_desc" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }


    //     $post = Post::findOrFail($id);
    //     $post->cover        = isset($request->cover) ? $request->cover : null;
    //     $post->title        = $request->title;
    //     $post->slug         = $request->slug;
    //     $post->category_id  = $request->category;
    //     $post->desc         = $request->desc;
    //     $post->keywords     = $request->keywords;
    //     $post->meta_desc    = $request->meta_desc;
    //     $post->id_kabkota    = $request->kabkota;
    //     $post->is_breaking      = $request->is_breaking == 'on' ? 1 : 0;
    //     $post->is_recommended   = $request->is_recommended == 'on' ? 1 : 0;
    //     $post->is_featured      = $request->is_featured == 'on' ? 1 : 0;
    //     $post->is_slider        = $request->is_slider == 'on' ? 1 : 0;
    //     $post->editor    = $request->editor;
    //     $post->photographer   = $request->photographer;
    //     // untag
    //     // $post->save();

    //     // $post->tags()->sync($request->tags);

    //     $categorySlug = \App\Models\Category::find($request->category)->slug;

    //     return redirect()->route('posts.index', ['category' => $categorySlug])->with('success', 'Data added successfully');


    //     // return redirect()->route('posts.index')->with('success', 'Data updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $success = false;
        $message = '';

        try {
            $res = Post::findOrFail($id);
            $res->delete();
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json(['success' => $success, 'message' => $message]);
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->restore();
            return redirect()->back()->with('success', 'Data successfully restored');
        } else {
            return redirect()->back()->with('error', 'Data is not in trash');
        }
    }

    public function deletePermanent($id)
    {

        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {

            return redirect()->back()->with('error', 'Data is not in trash');
        } else {

            $post->tags()->detach();


            if ($post->cover && file_exists(storage_path('app/public/' . $post->cover))) {
                \Storage::delete('public/' . $post->cover);
            }

            $post->forceDelete();

            return redirect()->back()->with('success', 'Data deleted successfully');
        }
    }
}
