<?php

use App\Models\RefDataSubKlasifikasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/poststatus/switch', function (Request $request) {

    $data = $request->input();
    $message = '';
    $success = false;


    try {
        if (isset($request->switch_status)) {
            $post = \App\Models\Post::find($data['id_post']);
            $post->status = $request->string_status;
            // if($request->string_status == 'published') {
            //     $post->editor = Auth::user()->name;
            // }
            $post->save();
            $success = true;

            
        }
    } catch (\Exception $e) {
        $message = $e->getMessage();
    }

    return response()
        ->json(['success' => $success, 'message' => $message]);
})->name('post.status.switch');


Route::get('/cd_upload_test', function (Request $request) {
    $url = 'https://sumbar.kemenag.go.id/v2/uploads/images/image_600x460_65426b3f5b50c.jpg';
    $uploadedFileUrl = Cloudinary::upload($url)->getSecurePath();
    return $uploadedFileUrl;
});

Route::get('/time_now', function (Request $request) {
    $timenow = \Carbon\Carbon::now();
    return $timenow;
});

Route::get('/db_old/get/posts', function (Request $request) {
    $counter = 0;
    $posts = DB::connection('mysql_old')->table('posts')->where(DB::raw('YEAR(created_at)'), '=', '2023')->orderBy('id', 'DESC')
        ->chunk(200, function ($posts) use (&$counter) {

            foreach ($posts as $post) {
                $realuserid = $post->user_id;
                $convertuserid = null;

                switch ($realuserid) {
                    case 1:
                        // adminrina
                        $convertuserid = 7;
                        break;

                    case 13:
                        // adminrina
                        $convertuserid = 4;
                        break;

                    case 49:
                        // adminfitradewi
                        $convertuserid = 4;
                        break;

                    case 296:
                        // adminrhama
                        $convertuserid = 2;
                        break;

                    case 480:
                        // admineri
                        $convertuserid = 3;
                        break;

                    case 562:
                        // adminvethriarahmi
                        $convertuserid = 5;
                        break;

                    default:
                        # code...
                        break;
                }

                if ($convertuserid) {
                    if ($post->image_big != null) {

                        $fPost = \App\Models\Post::where('old_id', $post->id)->first();

                        if (!$fPost) {

                            $countChars = count_chars($post->title);

                            if ($countChars <= 190) {
                                $image_url_raw = 'https://sumbar.kemenag.go.id/v2/' . $post->image_big;
                                $image_url = Cloudinary::upload($image_url_raw)->getSecurePath();


                                $newPost                    = new \App\Models\Post();
                                $newPost->created_at        = $post->created_at;
                                $newPost->cover             = $image_url;
                                $newPost->title             = $post->title;
                                $newPost->slug              = Str::slug($post->title);
                                $newPost->user_id           = $convertuserid;
                                $newPost->category_id       = Str::contains(strtolower($post->content), ['jakarta']) ? 3 : 1;
                                $newPost->desc              = $post->content;
                                $newPost->keywords          = $post->keywords;
                                $newPost->meta_desc         = $post->title;
                                $newPost->id_kabkota        = ($post->daerah == 9999);
                                $newPost->is_featured       = 1;
                                $newPost->is_slider         = 0;
                                $newPost->is_recommended    = 0;
                                $newPost->is_breaking       = 0;
                                $newPost->old_id            = $post->id;
                                $newPost->save();

                                $counter++;
                            }
                        }
                    }
                }
            }
        });

    return 'Done dengan jumlah import: ' . $counter;
});

Route::get('/db_old/fetch', function (Request $request) {

    $counter = 0;

    $oldidmin = 72738;
    $oldidmax = DB::table('posts')->where('old_id', '!=', 0)->min('old_id');

    // return $oldidmin . '______' . $oldidmax;


    // $posts = DB::connection('mysql_old')->table('posts')->whereYear('created_at', 2023)->orderBy('id')->get();


    // $posts = DB::connection('mysql_old')->table('posts')->whereYear('created_at', 2023)
    //     ->whereBetween('id', [$oldidmin, $oldidmax])->get();
    $posts = \App\Models\OldPost::whereBetween('id', [$oldidmin, $oldidmax])->orderBy('id', 'DESC')
        ->chunk(100, function ($posts) use ($counter) {
            foreach ($posts as $key => $post) {

                $user_id = null;
                $daerah_id = null;
                $category_id = $post->subcategory_id;
                switch ($category_id) {
                    case 15:
                        $user_id = 8;
                        $daerah_id = 1301;
                        break;
                    case 16:
                        $user_id = 9;
                        $daerah_id = 1302;
                        break;
                    case 17:
                        $user_id = 10;
                        $daerah_id = 1303;
                        break;
                    case 18:
                        $user_id = 11;
                        $daerah_id = 1304;
                        break;
                    case 19:
                        $user_id = 12;
                        $daerah_id = 1305;
                        break;
                    case 20:
                        $user_id = 13;
                        $daerah_id = 1306;
                        break;
                    case 21:
                        $user_id = 14;
                        $daerah_id = 1307;
                        break;
                    case 22:
                        $user_id = 15;
                        $daerah_id = 1308;
                        break;
                    case 23:
                        $user_id = 16;
                        $daerah_id = 1309;
                        break;
                    case 24:
                        $user_id = 17;
                        $daerah_id = 1310;
                        break;
                    case 25:
                        $user_id = 18;
                        $daerah_id = 1311;
                        break;
                    case 26:
                        $user_id = 19;
                        $daerah_id = 1312;
                        break;
                    case 14:
                        $user_id = 20;
                        $daerah_id = 1371;
                        break;
                    case 27:
                        $user_id = 21;
                        $daerah_id = 1372;
                        break;
                    case 28:
                        $user_id = 22;
                        $daerah_id = 1373;
                        break;
                    case 29:
                        $user_id = 23;
                        $daerah_id = 1374;
                        break;
                    case 30:
                        $user_id = 24;
                        $daerah_id = 1375;
                        break;
                    case 31:
                        $user_id = 25;
                        $daerah_id = 1376;
                        break;
                    case 32:
                        $user_id = 26;
                        $daerah_id = 1377;
                        break;

                    default:
                        # code...
                        break;
                }

                // $arrData[$key]['category_id'] = $category_id;
                // $arrData[$key]['subcategory_id'] = $post->subcategory_id;
                // $arrData[$key]['user_id'] = $user_id;
                // $arrData[$key]['daerah_id'] = $daerah_id;




                if ($post->image_big != null && $user_id != null && $daerah_id != null) {
                    $image_url_raw = 'https://sumbar.kemenag.go.id/v2/' . $post->image_big;
                    $image_url = Cloudinary::upload($image_url_raw)->getSecurePath();

                    $fPost = \App\Models\Post::where('old_id', $post->id)->first();
                    if (!$fPost) {
                        $newPost                    = new \App\Models\Post();
                        $newPost->created_at        = $post->created_at;
                        $newPost->cover             = $image_url;
                        $newPost->title             = $post->title;
                        $newPost->slug              = Str::slug($post->title);
                        $newPost->user_id           = $user_id;
                        $newPost->category_id       = 2;
                        $newPost->desc              = $post->content;
                        $newPost->keywords          = $post->keywords;
                        $newPost->meta_desc         = $post->title;
                        $newPost->id_kabkota        = $daerah_id;
                        $newPost->is_featured       = 1;
                        $newPost->is_slider         = 0;
                        $newPost->is_recommended    = 0;
                        $newPost->is_breaking       = 0;
                        $newPost->old_id            = $post->id;
                        $newPost->save();

                        $counter++;
                    }
                }
            }
        });

    return $counter;
});

Route::get('/db_old/migrate/posts', function (Request $request) {

    $newpostoldid = \App\Models\Post::where('old_id', '!=', 0)->orderBy('id', 'desc')->first()->old_id;
    // $newpostoldid = DB::table('posts')->max('old_id');

    $posts = \App\Models\OldPost::where('id', '>', $newpostoldid)->get();


    if (Count($posts) > 0) {
        foreach ($posts as $post) {
            $convertuserid = $post->user_id;

            switch ($convertuserid) {
                case 1:
                    // adminrina
                    $convertuserid = 7;
                    break;

                case 13:
                    // adminrina
                    $convertuserid = 4;
                    break;

                case 49:
                    // adminfitradewi
                    $convertuserid = 4;
                    break;

                case 296:
                    // adminrhama
                    $convertuserid = 2;
                    break;

                case 480:
                    // admineri
                    $convertuserid = 3;
                    break;

                case 562:
                    // adminvethriarahmi
                    $convertuserid = 5;
                    break;

                default:
                    # code...
                    break;
            }

            if ($convertuserid == $post->user_id) {
            }

            if ($post->image_big != null) {
                $image_url_raw = 'https://sumbar.kemenag.go.id/v2/' . $post->image_big;
                $image_url = Cloudinary::upload($image_url_raw)->getSecurePath();

                $fPost = \App\Models\Post::where('title', $post->title)->first();
                if (!$fPost) {
                    $newPost                    = new \App\Models\Post();
                    $newPost->created_at        = $post->created_at;
                    $newPost->cover             = $image_url;
                    $newPost->title             = $post->title;
                    $newPost->slug              = Str::slug($post->title);
                    $newPost->user_id           = $convertuserid;
                    $newPost->category_id       = Str::contains(strtolower($post->content), ['jakarta']) ? 3 : 1;
                    $newPost->desc              = $post->content;
                    $newPost->keywords          = $post->keywords;
                    $newPost->meta_desc         = $post->title;
                    $newPost->id_kabkota        = $post->daerah;
                    $newPost->is_featured       = 1;
                    $newPost->is_slider         = 0;
                    $newPost->is_recommended    = 0;
                    $newPost->is_breaking       = 0;
                    $newPost->old_id            = $post->id;
                    $newPost->save();
                }
            }
        }
        return 'Miration has been done. click <a href="/berita">here</a> to go to Home Page';
    } else {
        return 'data has been updated. click <a href="/berita">here</a> to go to Home Page';
    }
});

Route::get('/db_old/migrate/test', function (Request $request) {

    $newpostoldid = \App\Models\Post::where('old_id', '!=', 0)->orderBy('id', 'desc')->first()->old_id;
    // $newpostoldid = DB::table('posts')->max('old_id');

    // return $newpostoldid;

    $posts = \App\Models\OldPost::where('id', '>', $newpostoldid)->get();
    return $posts;

    if (Count($posts) > 0) {
        foreach ($posts as $post) {
            $convertuserid = $post->user_id;

            switch ($convertuserid) {
                case 1:
                    // adminrina
                    $convertuserid = 7;
                    break;

                case 13:
                    // adminrina
                    $convertuserid = 4;
                    break;

                case 49:
                    // adminfitradewi
                    $convertuserid = 4;
                    break;

                case 296:
                    // adminrhama
                    $convertuserid = 2;
                    break;

                case 480:
                    // admineri
                    $convertuserid = 3;
                    break;

                case 562:
                    // adminvethriarahmi
                    $convertuserid = 5;
                    break;

                default:
                    # code...
                    break;
            }

            if ($convertuserid == $post->user_id) {
            }

            if ($post->image_big != null) {
                $image_url_raw = 'https://sumbar.kemenag.go.id/v2/' . $post->image_big;
                $image_url = Cloudinary::upload($image_url_raw)->getSecurePath();

                $fPost = \App\Models\Post::where('title', $post->title)->first();
                if (!$fPost) {
                    $newPost                    = new \App\Models\Post();
                    $newPost->created_at        = $post->created_at;
                    $newPost->cover             = $image_url;
                    $newPost->title             = $post->title;
                    $newPost->slug              = Str::slug($post->title);
                    $newPost->user_id           = $convertuserid;
                    $newPost->category_id       = Str::contains(strtolower($post->content), ['jakarta']) ? 3 : 1;
                    $newPost->desc              = $post->content;
                    $newPost->keywords          = $post->keywords;
                    $newPost->meta_desc         = $post->title;
                    $newPost->id_kabkota        = $post->daerah;
                    $newPost->is_featured       = 1;
                    $newPost->is_slider         = 0;
                    $newPost->is_recommended    = 0;
                    $newPost->is_breaking       = 0;
                    $newPost->old_id            = $post->id;
                    $newPost->save();
                }
            }
        }
        return 'Miration has been done. click <a href="/berita">here</a> to go to Home Page';
    } else {
        return 'data has been updated. click <a href="/berita">here</a> to go to Home Page';
    }
});

Route::get('/users/all', function (Request $request) {

    //    $users = \App\Models\User::select('name', 'username', 'plain_password')->get();
    $users = DB::table('users')->select('name', 'username', 'plain_password as password')->get();
    return $users;
});

Route::get('permohonan', [App\Http\Controllers\PermohonanController::class, 'index'])->name('permohonan.index');
Route::post('permohonan/switch', [App\Http\Controllers\PermohonanController::class, 'switchStatus'])->name('permohonan.status.switch');


Route::get('/gallery/t/{type?}', [App\Http\Controllers\SectController::class, 'gallery'])->name('sect.gallery');


Route::get('sect/permohonan_informasi', [App\Http\Controllers\SectController::class, 'permohonan'])->name('sect.permohonan');
Route::post('sect/permohonan/store', [App\Http\Controllers\SectController::class, 'storePermohonan'])->name('permohonan.store');

Route::post('/captcha-validation', [\App\Http\Controllers\CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [\App\Http\Controllers\CaptchaServiceController::class, 'reloadCaptcha'])->name('reload.captcha');

Route::post('image-upload', [App\Http\Controllers\ImageUploadController::class, 'storeImage'])->name('image.upload');

Route::get('/migrate-fresh', function () {
    // Artisan::call('vendor:publish');
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('migrate:fresh', ['--seed' => true]);

    return 'Migration and seeding has been succeed, click <a href="/">here</a> to return to home page';
});

Route::get('/xdown/{view}', function ($view) {
    Artisan::call('down', ['--secret' => 'devmode', '--render' => 'errors.' . $view]);

    return 'Web Down with command view: ' . $view;
});

Route::get('/xup', function () {
    Artisan::call('up');
    return 'Web Up';
});

Route::group(['middleware' => ['web']], function () {
    // your routes here

    Route::get('/visitor', [App\Http\Controllers\Visitor\DashboardController::class, 'index'])->name('visitor.index');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing.index');

    Route::get('/contact', function () {
        return view('landing.v2.contact', [
            'title' => 'Contact - Web Kemenag Kanwil Prov Sumbar',
            'accountfb' => 'Kanwil Kemenag Sumbar',
            'account' => 'Kanwil Kemenag Sumbar',
            'channel' =>  '@Kanwil Kemenag Sumbar'
        ]);
    });

    // Route::get('/gallery/{type}', function ($type) {

    //     $galleries = \App\Models\Gallery::where('type', $type)->get();
    //     // $galleries = $galleries->shuffle();

    //     $filterTags = $galleries->pluck('filter_tag')->unique();

    //     return view('landing.gallery', [
    //         'title' => 'Gallery Web Kemenag Kanwil Prov Sumbar',
    //         'accountfb' => 'Kanwil Kemenag Sumbar',
    //         'account' => 'Kanwil Kemenag Sumbar',
    //         'channel' =>  '@Kanwil Kemenag Sumbar',
    //         'galleries' =>  $galleries,
    //         'filterTags' =>  $filterTags,
    //     ]);
    // });

    Route::get('/aboutus', function () {

        return view('landing.aboutus', [
            'title' => 'Web Kemenag Kanwil Prov Sumbar - About Us',
            'accountfb' => 'Kanwil Kemenag Sumbar',
            'account' => 'Kanwil Kemenag Sumbar',
            'channel' =>  '@Kanwil Kemenag Sumbar'
        ]);
    });

    Route::get('regulasi', function () {
        return view(
            'landing.v2.regulasi',
            [
                'title' => 'Web - Regulasi',
            ]
        );
    });


    Route::get('/service/{slug}', function ($slug) {

        $service = \App\Models\Services::where('slug', $slug)->first();
        $products = \App\Models\Products::where('id_service', $service->id_service)->get();

        return view('landing.service-detail', [
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'service' =>  $service,
            'products' =>  $products
        ]);
    });

    Route::get('/all-services', function () {
        $services = \App\Models\Services::where('listed', 'yes')->get();

        return view('landing.all-services', [
            'title' => 'Web Kemenag Kanwil Prov Sumbar - Semua Layanan',
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'services' =>  $services
        ]);
    });

    Route::get('/summary/total_post/just_can_get_by_admin/{year}/{token}', function ($year, $token) {

        if($token != 'adminkemenagsumbar') {
		return 'not authorized';
        }

        if($year == 'all_time') {
            $posts = DB::select("
            SELECT kabkota.id_kabkota, kabkota.name, COUNT(posts.id_kabkota) AS total
            FROM kabkota
            LEFT JOIN posts ON posts.id_kabkota = kabkota.id_kabkota AND posts.status = 'published'
            WHERE kabkota.id_kabkota != 0
            GROUP BY kabkota.id_kabkota, kabkota.name
            ORDER BY total DESC 
         ", [$year]);
        } else {
            $posts = DB::select("
            SELECT kabkota.id_kabkota, kabkota.name, COUNT(posts.id_kabkota) AS total
            FROM kabkota
            LEFT JOIN posts ON posts.id_kabkota = kabkota.id_kabkota AND posts.status = 'published' AND YEAR(created_at) = ?
            WHERE kabkota.id_kabkota != 0
            GROUP BY kabkota.id_kabkota, kabkota.name
            ORDER BY total DESC 
         ", [$year]);
        }

       

        return view('landing.v2.summary', [
            'posts' => $posts,
            'year' => $year,
            'title' => 'Ringkasan Ranking Berita - Web Kemenag Kanwil Prov Sumbar',
            'accountfb' => 'Kanwil Kemenag Sumbar',
            'account' => 'Kanwil Kemenag Sumbar',
            'channel' =>  '@Kanwil Kemenag Sumbar'
        ]);
    });

    Route::get('/blog', function (Request $request) {

        $kabkotaname = '';
        if ($request->has('search')) {
            $search = $request->input('search');
            $posts = \App\Models\Post::where('status', 'published')->where('title', 'LIKE', "%{$search}%")
                ->orWhere('desc', 'LIKE', "%{$search}%")->orderBy('created_at', 'DESC')->paginate(4);
        } elseif ($request->has('category')) {
            $search = $request->input('category');

            if ($request->has('id_kabkota')) {
                $kabkotaname = \App\Models\Kabkota::find($request->input('id_kabkota'))->name;
                $posts = \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) use ($search) {
                    $q->where('slug', $search);
                })
                    ->where('id_kabkota', $request->input('id_kabkota'))
                    ->orderBy('created_at', 'DESC')->paginate(10);
            } else {
                $posts = \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) use ($search) {
                    $q->where('slug', $search);
                })->orderBy('created_at', 'DESC')->paginate(10);
            }
        } elseif ($request->has('tag')) {
            $search = $request->input('tag');
            $posts = \App\Models\Post::where('status', 'published')->whereHas('tags', function ($q) use ($search) {
                $q->where('slug', $search);
            })->orderBy('created_at', 'DESC')->paginate(10);
        } elseif ($request->has('author')) {
            $search = $request->input('author');
            $posts = \App\Models\Post::where('status', 'published')->whereHas('user', function ($q) use ($search) {
                $q->where('name', $search);
            })->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $posts = \App\Models\Post::where('status', 'published')->orderBy('created_at', 'DESC')->paginate(10);
        }

        $posts->appends(request()->input())->links();


        $categories = \App\Models\Category::withCount('posts')->get();
        $tags = \App\Models\Tag::all();
        $recent_posts = \App\Models\Post::where('status', 'published')->whereHas('category', function ($q) {
            $q->where('slug', 'utama');
        })->take(3)->get();

        return view('landing.v2.blog', [
            'title' => 'Blog Web Kemenag Kanwil Prov Sumbar',
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'categories' =>  $categories,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'tags' => $tags,
            'kabkotaname' => $kabkotaname,
        ]);
    })->name('blog.list');

    // Route::get('/berita', function (Request $request) {

    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $posts = \App\Models\Post::whereHas('category', function ($q) {
    //             $q->where('slug', 'utama');
    //         })->where('title', 'LIKE', "%{$search}%")
    //             ->orWhere('desc', 'LIKE', "%{$search}%")->orderBy('created_at', 'DESC')->paginate(4);
    //     } elseif ($request->has('category')) {
    //         $search = $request->input('category');
    //         $posts = \App\Models\Post::whereHas('category', function ($q) {
    //             $q->where('slug', 'utama');
    //         })->whereHas('category', function ($q) use ($search) {
    //             $q->where('slug', $search);
    //         })->orderBy('created_at', 'DESC')->paginate(4);
    //     } elseif ($request->has('tag')) {
    //         $search = $request->input('tag');
    //         $posts = \App\Models\Post::whereHas('category', function ($q) {
    //             $q->where('slug', 'utama');
    //         })->whereHas('tags', function ($q) use ($search) {
    //             $q->where('slug', $search);
    //         })->orderBy('created_at', 'DESC')->paginate(4);
    //     } else {
    //         $posts = \App\Models\Post::whereHas('category', function ($q) {
    //             $q->where('slug', 'utama');
    //         })->orderBy('created_at', 'DESC')->paginate(4);
    //     }

    //     $posts->appends(request()->input())->links();


    //     $categories = \App\Models\Category::withCount('posts')->get();
    //     $tags = \App\Models\Tag::all();
    //     $recent_posts = \App\Models\Post::whereHas('category', function ($q) {
    //         $q->where('slug', 'utama');
    //     })->take(3)->get();

    //     return view('landing.v2.news', [
    //         'title' => 'Berita Web Kemenag Kanwil Prov Sumbar',
    //         'accountfb' => 'pandanviewmandeh',
    //         'account' => 'pandanviewmandeh',
    //         'channel' =>  '@pandanviewmandehofficial4919',
    //         'categories' =>  $categories,
    //         'posts' => $posts,
    //         'recent_posts' => $recent_posts,
    //         'tags' => $tags
    //     ]);
    // });

    Route::get('/aktifitas', function (Request $request) {

        $activities = \App\Models\Activity::orderBy('created_at', 'DESC')->paginate(4);


        $categories = \App\Models\Category::withCount('posts')->get();
        $tags = \App\Models\Tag::all();
        $recent_posts = \App\Models\Post::whereHas('category', function ($q) {
            $q->where('slug', 'utama');
        })->take(3)->get();

        return view('landing.v2.activities', [
            'title' => 'Aktifitas KemenagPessel',
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'categories' =>  $categories,
            'activities' => $activities,
            'recent_posts' => $recent_posts,
            'tags' => $tags
        ]);
    });

    Route::get('cookie/{slug}', function (Request $request, $slug) {
        $cookie_name = (\Str::replace('.', '', ($request->ip())) . '-' . $slug);

        $cookie_value = \Cookie::get($cookie_name);
        if ($cookie_value === null) {
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
        }

        return $cookie;
    });

    Route::get('post/{slug}', function (Request $request, $slug) {
        $post = \App\Models\Post::where('slug', $slug)->first();

        if ($post->status == 'published') {

            $cookie_name = (\Str::replace('.', '', ($request->ip())) . '-' . $post->id);

            $cookie = \Cookie::get($cookie_name);
            if ($cookie == '') { //check if cookie is set
                $cookie = cookie($cookie_name, '1', 60); //set the cookie
                $post->incrementReadCount(); //count the view
            }

            if ($post->showPost()) { // this will test if the user viwed the post or not
                // return $post;
            } else {
                \App\Models\PostView::createViewLog($post);
            }

            $categories = \App\Models\Category::withCount('posts')->get();
            $tags = \App\Models\Tag::all();
            $recent_posts = \App\Models\Post::whereHas('category', function ($q) {
                $q->where('slug', 'utama');
            })->take(3)->get();
            return view('landing.v2.post', [
                'accountfb' => 'pandanviewmandeh',
                'account' => 'pandanviewmandeh',
                'channel' =>  '@pandanviewmandehofficial4919',
                'categories' =>  $categories,
                'recent_posts' => $recent_posts,
                'tags' => $tags,
                'post' => $post
            ])->withCookie($cookie); //store the cookie;

        } else {
            return redirect()->route('landing.index');
        }
    });

    Route::get('/lang/home', [App\Http\Controllers\LangController::class, 'index']);
    Route::get('/lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

    Route::post('/messages/store', [\App\Http\Controllers\Visitor\MessageController::class, 'store'])->name('messages.store');;
});

Auth::routes();
// Auth::routes(['login' => true]);

Route::prefix('controlcenter')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
});

Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');

Route::get('/admin/information/services', [\App\Http\Controllers\Admin\ServicesController::class, 'index'])->name('services.index');
Route::post('/admin/information/services/store', [\App\Http\Controllers\Admin\ServicesController::class, 'store'])->name('services.store');

Route::get('/admin/information/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
Route::post('/admin/information/products/store', [\App\Http\Controllers\Admin\ProductController::class, 'store']);

Route::get('/admin/information/activities', [\App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('activities.index');
Route::post('/admin/information/activities/store', [\App\Http\Controllers\Admin\ActivityController::class, 'store'])->name('activities.store');
Route::delete('/admin/information/destroy/{id}', [\App\Http\Controllers\Admin\ActivityController::class, 'destroy'])->name('activities.destroy');


Route::get('/admin/information/galleries', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('galleries.index');
Route::post('/admin/information/galleries/store', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('galleries.store');

Route::get('/admin/information/carousels', [\App\Http\Controllers\Admin\CarouselController::class, 'index'])->name('carousels.index');
Route::post('/admin/information/carousels/store', [\App\Http\Controllers\Admin\CarouselController::class, 'store'])->name('carousels.store');

Route::get('/admin/information/testimonies', [\App\Http\Controllers\Admin\TestimonyController::class, 'index'])->name('testimonies.index');
Route::post('/admin/information/testimonies/store', [\App\Http\Controllers\Admin\TestimonyController::class, 'store']);




Route::get('/admin/data/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');

Route::get('/admin/data/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
Route::post('/admin/data/users/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
Route::delete('/admin/data/users/{id}/destroy', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

Route::get('/admin/data/roles', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
Route::post('/admin/data/roles/store', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
Route::delete('/admin/data/roles/{id}/destroy', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');



Route::resource('/admin/setting/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/admin/setting/tags', App\Http\Controllers\TagController::class);
// Manage Posts
Route::get('/admin/blog/posts/trash', [App\Http\Controllers\PostController::class, 'trash'])->name('posts.trash');
Route::post('/admin/blog/posts/trash/{id}/restore', [App\Http\Controllers\PostController::class, 'restore'])->name('posts.restore');
Route::delete('blog/posts/delete-permanent/{id}', [App\Http\Controllers\PostController::class, 'deletePermanent'])->name('posts.deletePermanent');
Route::delete('/admin/blog/posts/destroy/{id}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.delete');

Route::resource('/admin/blog/posts', App\Http\Controllers\PostController::class);
// Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');


Route::get('/admin/blog/news/trash', [App\Http\Controllers\NewsController::class, 'trash'])->name('news.trash');
Route::post('/admin/blog/news/trash/{id}/restore', [App\Http\Controllers\NewsController::class, 'restore'])->name('news.restore');
Route::delete('blog/news/delete-permanent/{id}', [App\Http\Controllers\NewsController::class, 'deletePermanent'])->name('news.deletePermanent');
Route::resource('/admin/blog/news', App\Http\Controllers\NewsController::class);


Route::get('/admin/setting/menus/{id?}',  [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menus.index');
Route::post('create-menu',  [\App\Http\Controllers\Admin\MenuController::class, 'store']);
Route::get('add-categories-to-menu',  [\App\Http\Controllers\Admin\MenuController::class, 'addCategory']);
Route::post('save-menu',  [\App\Http\Controllers\Admin\MenuController::class, 'saveMenu']);
Route::get('add-posts-to-menu',  [\App\Http\Controllers\Admin\MenuController::class, 'addPost']);
Route::get('add-custom-link',  [\App\Http\Controllers\Admin\MenuController::class, 'addCustomLink']);
Route::post('update-menuitem/{id}/{k1}/{k2?}/{k3?}',  [\App\Http\Controllers\Admin\MenuController::class, 'updateItem']);
Route::get('delete-menuitem/{id}/{k1}/{k2?}/{k3?}',  [\App\Http\Controllers\Admin\MenuController::class, 'deleteItem']);



// Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class);

Route::get('/admin/reservations/{yearMonth?}', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('reservations.index');
Route::post('/admin/reservations/store', [\App\Http\Controllers\Admin\ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/admin/reservations/destroy/{id_reservation}', [\App\Http\Controllers\Admin\ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::get('/admin/deleted-reservations/{yearMonth?}', [\App\Http\Controllers\Admin\ReservationController::class, 'deleted'])->name('reservations.deleted');
Route::delete('/admin/reservations/restore/{id_reservation}', [\App\Http\Controllers\Admin\ReservationController::class, 'restore'])->name('reservations.restore');


Route::get('/admin/reservation/audits/{id_reservation}', function ($id_reservation) {
    $res = \App\Models\Reservation::where('id_reservation', $id_reservation)->withTrashed()->first();
    $all = $res->audits()->with('user')->get();
    return $all;
});



Route::get('/admin/audits', [\App\Http\Controllers\Admin\AuditController::class, 'index'])->name('audits.index');
Route::get('/admin/audits/fetch/{id_reservation}', [\App\Http\Controllers\Admin\AuditController::class, 'fetch'])->name('audits.fetch');


Route::get('/admin/informasi', [\App\Http\Controllers\Admin\InfoController::class, 'index'])->name('info.index');
Route::post('/admin/informasi/store', [\App\Http\Controllers\Admin\InfoController::class, 'store'])->name('info.store');
Route::delete('/admin/informasi/delete/{id}', [\App\Http\Controllers\Admin\InfoController::class, 'destroy'])->name('info.destroy');


Route::post('/admin/upload-file/upload', [\App\Http\Controllers\UploadFileController::class, 'upload'])->name('file.upload');
Route::delete('/admin/upload-file/destroy/{id}', [\App\Http\Controllers\UploadFileController::class, 'destroy'])->name('file.destroy');


Auth::routes();

Route::get('/search/{param}', [\App\Http\Controllers\SearchController::class, 'search'])->name('search.param');


Route::post('/data/all', [\App\Http\Controllers\HomeController::class, 'all'])->name('data.all');
Route::get('/info/{sect}', [\App\Http\Controllers\HomeController::class, 'info'])->name('guest.info');


Route::get('/data/detail/{idx}', [\App\Http\Controllers\Landing\PostController::class, 'index'])->name('data.index');
Route::get('/data/download/{idx}', [\App\Http\Controllers\Landing\PostController::class, 'download'])->name('data.download');



Route::put('/kategori/add', [\App\Http\Controllers\MasterController::class, 'addKategori'])->name('kategori.add');
Route::put('/instansi/add', [\App\Http\Controllers\MasterController::class, 'addInstansi'])->name('instansi.add');
Route::put('/tag/add', [\App\Http\Controllers\MasterController::class, 'addTag'])->name('tag.add');


Route::get('/subklasifikasi', function () {
    $subklasifikasi = RefDataSubKlasifikasi::all();
    return $subklasifikasi;
});

Route::get('/getusers', function () {
    $users = \App\Models\User::select('name', 'username', 'password')->where('email', '!=', '199407292022031002@kemenag.go.id')->with('roles')->get();
    return $users;
});
