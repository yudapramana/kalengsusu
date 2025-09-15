@extends('layouts.admin.master')
@section('title', $title)


@section('_styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
    .profile .profile-edit img {
        max-width: 120px;
    }

    #profile_photo_src {
        max-width: 120px;
    }

    .profile-edit {
        max-width: 120px;
    }

    .preserveLines {
        white-space: pre-wrap;
    }

    .item-list-body {
        font-size: smaller !important;
    }
</style>

<style>
    .menu-edit:after {
        font-family: 'FontAwesome';
        /* essential to enable caret symbol*/
        content: "\f14b \00a0 ";
        /* adjust as needed, taken from font-awesome.css */
        color: grey;
    }

    .menu-destroy:after {
        font-family: 'FontAwesome';
        /* essential to enable caret symbol*/
        content: "\f1f8 \00a0 ";
        /* adjust as needed, taken from font-awesome.css */
        color: grey;
    }


    .item-destroy:after {
        font-family: 'FontAwesome';
        /* essential to enable caret symbol*/
        content: "\f057 \00a0 ";
        /* adjust as needed, taken from font-awesome.css */
        color: grey;
    }

    .accordion-toggle:after {
        font-family: 'FontAwesome';
        /* essential to enable caret symbol*/
        content: "\f107 \00a0 ";
        /* adjust as needed, taken from font-awesome.css */
        color: grey;
    }

    .accordion-toggle.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f105 \00a0 ";
        /* adjust as needed, taken from font-awesome.css */
    }

    .item-list,
    .info-box {
        background: #fff;
        padding: 10px;
    }

    .item-list-body {
        max-height: 300px;
        overflow-y: scroll;
    }

    .panel-body p {
        margin-bottom: 5px;
    }

    .info-box {
        margin-bottom: 15px;
    }

    .item-list-footer {
        padding-top: 10px;
    }

    .panel-heading a {
        display: block;
    }

    .form-inline {
        display: inline;
    }

    .form-inline select {
        padding: 4px 10px;
    }

    .btn-menu-select {
        padding: 4px 10pxz
    }

    .disabled {
        pointer-events: none;
        opacity: 0.7;
    }

    .menu-item-bar {
        background: #eee;
        padding: 5px 10px;
        border: 1px solid #d7d7d7;
        margin-bottom: 5px;
        cursor: move;
        display: block;
    }

    /* #serialize_output {
        display: none;
    } */

    .menulocation label {
        font-weight: normal;
        display: block;
    }

    body.dragging,
    body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 1;
    }

    ol.example li.placeholder {
        position: relative;
    }

    ol.example li.placeholder:before {
        position: absolute;
    }

    #menuitem {
        list-style: none;
    }

    #menuitem ul {
        list-style: none;
    }

    #menuitem ol {
        list-style: none;
    }

    .input-box {
        width: 75%;
        background: #fff;
        padding: 10px;
        box-sizing: border-box;
        margin-bottom: 5px;
    }

    .input-box .form-control {
        width: 50%
    }

    ul.ui-sortable {
        padding-left: 2rem !important;
        list-style-type: revert !important;
    }
</style>


@endsection





@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ $br1 }}</a></li>
                <li class="breadcrumb-item active">{{ $br2 }}</li>
            </ol>
        </nav>
    </div>


    <section class="section">

        @include('flash-message')

        <div class="row container-fluid">
            <h2><span>Menus</span></h2>

            <div class="content info-box">

                @if(count($menus) > 0)
                Select a menu &nbsp;
                <select id="menuid" name="id" class="menu-select">
                    <option value="new">-- Select Menu --</option>
                    @foreach($menus as $menu)
                    <option value="{{$menu->id}}" @if($selectedMenu !='' && $selectedMenu->id == $menu->id) selected
                        @endif>{{$menu->title}}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-secondary btn-menu-select">Select</button>
                or
                @endif
                <a href="{{url('setting/menus?id=new')}}">Create a new menu</a>.
            </div>

            <div class="row" id="main-row">
                <div class="col-sm-3 cat-form @if(count($menus) == 0) disabled @endif">
                    <h3><span>Add Menu Items</span></h3>

                    <div class="panel-group" id="menu-items">
                        <div class="card pb-2 mb-2">
                            <div class="card-header">
                                <a href="#categories-list" data-bs-toggle="collapse" data-toggle="collapse"
                                    data-parent="#menu-items">Categories <span class="caret pull-right"></span></a>
                            </div>
                            <div class="card-body collapse show" id="categories-list">
                                <div class="panel-body py-3">
                                    <div class="item-list-body">
                                        @foreach($categories as $cat)
                                        <p><input type="checkbox" name="select-category[]" value="{{$cat->id}}"
                                                data-uri="#"> {{$cat->title}}</p>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <label class="btn btn-sm btn-default"><input type="checkbox"
                                                id="select-all-categories"> Select All</label>
                                        <button type="button" class="pull-right btn btn-default btn-sm"
                                            id="add-categories">Add to Menu</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card pb-2 mb-2">
                            <div class="card-header">
                                <a href="#posts-list" data-bs-toggle="collapse" data-parent="#menu-items">Articles <span
                                        class="caret pull-right"></span></a>
                            </div>
                            <div class="card-body collapse" id="posts-list">
                                <div class="panel-body py-3">
                                    <div class="item-list-body">
                                        @foreach($posts as $post)
                                        <p><input type="checkbox" name="select-post[]" value="{{$post->id}}"
                                                data-uri="/post/{{$post->slug}}"> {{$post->title}}</p>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <label class="btn btn-sm btn-default"><input type="checkbox"
                                                id="select-all-posts"> Select All</label>
                                        <button type="button" id="add-posts"
                                            class="pull-right btn btn-default btn-sm">Add to Menu</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card pb-2 mb-2">
                            <div class="card-header">
                                <a href="#custom-links" data-bs-toggle="collapse" data-parent="#menu-items">Custom Links
                                    <span class="caret pull-right"></span></a>
                            </div>
                            <div class="card-body collapse" id="custom-links">
                                <div class="panel-body py-3">
                                    <div class="item-list-body-no">
                                        <div class="form-group mb-2">
                                            <label class="form-label small">URL</label>
                                            <input type="url" id="url" class="form-control form-control-sm input-sm"
                                                placeholder="https://">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label small">Link Text</label>
                                            <input type="text" id="linktext"
                                                class="form-control form-control-sm input-sm" placeholder="">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label small">Target Type</label>
                                            <div class="form-check">
                                                <input class="form-check-input small" type="radio" name="href_target"
                                                    value="_blank" checked>
                                                <label class="form-check-label small" for="target">
                                                    Open in a new tab
                                                </label>
                                            </div>
                                            @if(Auth::user()->hasRole('super_administrator'))
                                            <div class="form-check">
                                                <input class="form-check-input small" type="radio" name="href_target"
                                                    value="_self">
                                                <label class="form-check-label small" for="target">
                                                    Open in same frame
                                                </label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item-list-footer">
                                        <button type="button" class="pull-right btn btn-default btn-sm"
                                            id="add-custom-link">Add to Menu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 cat-view">
                    <h3><span>Menu Structure</span></h3>
                    @if($selectedMenu == '')
                    <h4>Create New Menu</h4>
                    <form method="post" action="{{url('create-menu')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-sm btn-primary">Create Menu</button>
                            </div>
                        </div>
                    </form>
                    @else
                    @if($menuitems == null)
                    <p>Add Categories, Posts, or Custom Links to the menu</p>
                    @endif

                    @if($menuitems != null)
                    <ul class="menu ui-sortable" id="menuitems">
                        @foreach($menuitems as $k1 => $menuitem1)
                        <li data-type="{{ $menuitem1->type }}"
                            data-slug="{{ $menuitem1->slug ? $menuitem1->slug : '#' }}"
                            data-target="{{ $menuitem1->target ? $menuitem1->target : '_self' }}"
                            data-title="{{ $menuitem1->title }}" data-id="{{ $menuitem1->id }}">
                            <span class="menu-item-bar">@if(!empty($menuitem1->name)){{$menuitem1->name}} @else {{
                                $menuitem1->title }} @endif
                                <a href="#collapseMenu{{$menuitem1->id}}" data-bs-toggle="collapse">
                                    <i class="bi bi-caret-down pull-right text-end float-end"></i>
                                </a>
                            </span>
                            <div class="collapse" id="collapseMenu{{$menuitem1->id}}">
                                <div class="card">
                                    <div class="card-body mt-3">
                                        <form method="post"
                                            action="{{url('update-menuitem')}}/{{$menuitem1->id}}/{{$k1}}">
                                            {{ csrf_field() }}
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <label classs="m-0 p-0" for="link-name">Link Name</label>
                                                    <input class="form-control form-control-sm" type="text" name="name"
                                                        id="name"
                                                        value="@if(!empty($menuitem1->name)){{$menuitem1->name}} @else {{ $menuitem1->title }} @endif">
                                                </div>

                                                @if($menuitem1->type == 'custom')
                                                <div class="col-12">
                                                    <label classs="m-0 p-0" for="url">URL</label>
                                                    <input type="text" name="slug" id="slug"
                                                        value="{{ $menuitem1->slug }}"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12">
                                                    <input type="radio" name="target" value="_blank"
                                                        @if($menuitem1->target == '_blank') checked
                                                    @endif>&nbsp; Open in a new tab

                                                    <input type="radio" name="target" value="_self"
                                                        @if($menuitem1->target == '_self') checked
                                                    @endif>&nbsp; Open in same frame
                                                </div>
                                                @endif

                                                <div class="col-12 text-end">
                                                    <button type="submit" data-form_id=""
                                                        class="btn btn-sm btn-warning save-item-btn">Update</button>
                                                    <a href="{{ url('delete-menuitem') }}/{{$menuitem1->id}}/{{$k1}}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                @if(isset($menuitem1->children[0]))
                                @foreach($menuitem1->children[0] as $k2 => $menuitem2)
                                <li data-type="{{ $menuitem2->type }}"
                                    data-slug="{{ $menuitem2->slug ? $menuitem2->slug : '#' }}"
                                    data-target="{{ $menuitem2->target ? $menuitem2->target : '_self' }}"
                                    data-title="{{ $menuitem2->title }}" data-id="{{ $menuitem2->id }}">
                                    <span class="menu-item-bar">@if(!empty($menuitem2->name)){{$menuitem2->name}} @else
                                        {{ $menuitem2->title }} @endif
                                        <a href="#collapseChild{{$menuitem2->id}}" data-bs-toggle="collapse">

                                            <i class="bi bi-caret-down pull-right text-end float-end"></i>
                                        </a>
                                    </span>
                                    <div class="collapse" id="collapseChild{{$menuitem2->id}}">
                                        <div class="card">
                                            <div class="card-body mt-3">
                                                <form method="post"
                                                    action="{{url('update-menuitem')}}/{{$menuitem2->id}}/{{$k1}}/{{$k2}}">
                                                    {{ csrf_field() }}
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <label classs="m-0 p-0" for="link-name">Link Name</label>
                                                            <input class="form-control form-control-sm" type="text"
                                                                name="name" id="name"
                                                                value="@if(!empty($menuitem2->name)){{$menuitem2->name}} @else {{ $menuitem2->title }} @endif">
                                                        </div>

                                                        @if($menuitem2->type == 'custom')
                                                        <div class="col-12">
                                                            <label classs="m-0 p-0" for="url">URL</label>
                                                            <input type="text" name="slug" id="slug"
                                                                value="{{ $menuitem2->slug }}"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="radio" name="target" value="_blank"
                                                                @if($menuitem2->target == '_blank') checked
                                                            @endif>&nbsp; Open in a new tab

                                                            <input type="radio" name="target" value="_self"
                                                                @if($menuitem2->target == '_self') checked
                                                            @endif>&nbsp; Open in same frame
                                                        </div>
                                                        @endif

                                                        <div class="col-12 text-end">
                                                            <button type="submit" data-form_id=""
                                                                class="btn btn-sm btn-warning save-item-btn">Update</button>
                                                            <a href="{{ url('delete-menuitem') }}/{{$menuitem2->id}}/{{$k1}}/{{$k2}}"
                                                                class="btn btn-sm btn-danger">Delete</a>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <ul>
                                        @if(isset($menuitem2->children[0]))
                                        @foreach($menuitem2->children[0] as $k3 => $menuitem3)
                                        <li data-type="{{ $menuitem3->type }}"
                                            data-slug="{{ $menuitem3->slug ? $menuitem3->slug : '#' }}"
                                            data-target="{{ $menuitem3->target ? $menuitem3->target : '_self' }}"
                                            data-title="{{ $menuitem3->title }}" data-id="{{ $menuitem3->id }}">
                                            <span
                                                class="menu-item-bar">@if(!empty($menuitem3->name)){{$menuitem3->name}}
                                                @else {{ $menuitem3->title }} @endif
                                                <a href="#collapseChild{{$menuitem3->id}}" data-bs-toggle="collapse">

                                                    <i class="bi bi-caret-down pull-right text-end float-end"></i>
                                                </a>
                                            </span>
                                            <div class="collapse" id="collapseChild{{$menuitem3->id}}">
                                                <div class="card">
                                                    <div class="card-body mt-3">
                                                        <form method="post"
                                                            action="{{url('update-menuitem')}}/{{$menuitem3->id}}/{{$k1}}/{{$k2}}/{{$k3}}">
                                                            {{ csrf_field() }}
                                                            <div class="row g-2">
                                                                <div class="col-12">
                                                                    <label classs="m-0 p-0" for="link-name">Link
                                                                        Name</label>
                                                                    <input class="form-control form-control-sm"
                                                                        type="text" name="name" id="name"
                                                                        value="@if(!empty($menuitem3->name)){{$menuitem3->name}} @else {{ $menuitem3->title }} @endif">
                                                                </div>

                                                                @if($menuitem3->type == 'custom')
                                                                <div class="col-12">
                                                                    <label classs="m-0 p-0" for="url">URL</label>
                                                                    <input type="text" name="slug" id="slug"
                                                                        value="{{ $menuitem3->slug }}"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="radio" name="target" value="_blank"
                                                                        @if($menuitem3->target == '_blank') checked
                                                                    @endif>&nbsp; Open in a new tab

                                                                    <input type="radio" name="target" value="_self"
                                                                        @if($menuitem3->target == '_self') checked
                                                                    @endif>&nbsp; Open in same frame
                                                                </div>
                                                                @endif

                                                                <div class="col-12 text-end">
                                                                    <button type="submit" data-form_id=""
                                                                        class="btn btn-sm btn-warning save-item-btn">Update</button>
                                                                    <a href="{{ url('delete-menuitem') }}/{{$menuitem3->id}}/{{$k1}}/{{$k2}}/{{$k3}}"
                                                                        class="btn btn-sm btn-danger">Delete</a>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        @endforeach

                                        @endif
                                    </ul>
                                </li>
                                @endforeach

                                @endif
                            </ul>
                        </li>
                        @endforeach
                    </ul>

                    <div class="form-group">
                        <p><b>Location</b></p>
                        <p class="py-0 my-0">
                            <label for="" class="form-check-label">
                                <input @if($selectedMenu->location == 'header') checked @endif type="radio"
                                name="location" id="location" value="header">&nbsp;&nbsp;Header
                            </label>
                        </p>
                        <p class="py-0 my-0">
                            <label for="" class="form-check-label">
                                <input @if($selectedMenu->location == 'main-nav') checked @endif type="radio"
                                name="location" id="location" value="main-nav">&nbsp;&nbsp;Main Navigation
                            </label>
                        </p>
                        <p class="py-0 my-0">
                            <label for="" class="form-check-label">
                                <input @if($selectedMenu->location == 'footer') checked @endif type="radio"
                                name="location" id="location" value="footer">&nbsp;&nbsp;Footer
                            </label>
                        </p>
                    </div>
                    <div class="text-right text-end">
                        <button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
                    </div>
                    @endif

                    <p><b>Printed JSON</b></p>

                    <!-- <pre id="serialize_output">{!! $selectedMenu ? $selectedMenu->content : '-' !!}</pre> -->
                    <pre id="serialize_output"
                        style="background-color:antiquewhite; padding:10px;">{!! $selectedMenu ? $selectedMenu->content : '-' !!}</pre>

                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- <style>
        .item-list,
        .info-box {
            background: #fff;
            padding: 10px;
        }

        .item-list-body {
            max-height: 300px;
            overflow-y: scroll;
        }

        .panel-body p {
            margin-bottom: 5px;
        }

        .info-box {
            margin-bottom: 15px;
        }

        .item-list-footer {
            padding-top: 10px;
        }

        .panel-heading a {
            display: block;
        }

        .form-inline {
            display: inline;
        }

        .form-inline select {
            padding: 4px 10px;
        }

        .btn-menu-select {
            padding: 4px 10px
        }

        .disabled {
            pointer-events: none;
            opacity: 0.7;
        }

        .menu-select {
            padding: 5px 10px;
        }

        .form-inline {
            display: inline-block;
            padding: 0 15px;
        }



        .item-list,.info-box{background: #fff;padding: 10px;}
        .item-list-body{max-height: 300px;overflow-y: scroll;}
        .panel-body p{margin-bottom: 5px;}
        .info-box{margin-bottom: 15px;}
        .item-list-footer{padding-top: 10px;}
        .panel-heading a{display: block;}
        .form-inline{display: inline;}
        .form-inline select{padding: 4px 10px;}
        .btn-menu-select{padding: 4px 10px}
        .disabled{pointer-events: none; opacity: 0.7;}
        .menu-item-bar{background: #eee;padding: 5px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 75%; cursor: move;display: block;}
        #serialize_output{display: block;}
        .menulocation label{font-weight: normal;display: block;}
        body.dragging, body.dragging * {cursor: move !important;}
        .dragged {position: absolute;z-index: 1;}
        ol.example li.placeholder {position: relative;}
        ol.example li.placeholder:before {position: absolute;}
        #menuitem{list-style: none;}
        #menuitem ul{list-style: none;}
        .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
        .input-box .form-control{width: 50%}
    </style> -->

    @include('admin.categories._modal')


</main>




@endsection


@section('_scripts')

<!-- Styles -->
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>


<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success px-3 mx-3'
            , cancelButton: 'btn btn-danger px-3 mx-3'
        }
        , buttonsStyling: false
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Cover
    var coverWidget = cloudinary.createUploadWidget({
        cloudName: 'dezj1x6xp'
        , uploadPreset: 'pandanviewmandeh'
        , theme: 'minimal'
        , multiple: false
        , max_file_size: 10048576
        , background: "white"
        , quality: 20
    }, (error, result) => {
        if (!error && result && result.event === "success") {
            console.log('Info Arsip Masuk: ', result.info);
            var linklogo = result.info.secure_url;
            $('#new-cover_image_url').val(linklogo);

            $('#cover_image_url_btn').hide();

            $('.show-cover-box').show();
            $('#preview-cover').attr("src", linklogo);

        }
    });

    // document.getElementById("cover_image_url_btn").addEventListener("click", function() {
    //     coverWidget.open();
    // }, false);

    $('.select2').select2({
        theme: 'bootstrap-5'
        , dropdownParent: $("#tambahGroup")
    , });

    $("#select2insidemodal").select2({
        dropdownParent: $("#myModal")
    });




    var table = $('#example').DataTable({
        orderable: false
        , sort: false
        , order: false
        , lengthChange: false
        , responsive: false
        , scrollX: true
        , autoWidth: false
        , lengthMenu: [
            [10, 25, 50, -1]
            , ['10 rows', '25 rows', '50 rows', 'Show all']
        ]
        , iDisplayLength: 50
        , buttons: [
            'pageLength', {
                text: '<i class="fa fa-plus-circle"></i> Tambah'
                , attr: {
                    'title': 'Import Data'
                    , 'data-bs-original-title': 'Import Data'
                    , 'data-bs-target': '#tambahGroup'
                    , 'data-bs-toggle': 'modal'
                    , 'data-bs-backdrop': 'static'
                    , 'data-bs-keyboard': 'false'
                    , 'data-bs-title': 'Tambah Baru'
                    , 'data-title': 'Tambah Baru'
                    , 'type': 'button'
                    , 'id': 'addBtn'
                    , 'class': 'btn btn-primary'
                }
                , action: function(e, dt, node, config) {
                    // alert('Button activated');
                }
            }, {
                text: '<i class="fa fa-refresh"></i>  Reload'
                , attr: {
                    'title': 'Refresh Table'
                    , 'class': 'btn btn-warning'
                }
                , action: function(e, dt, node, config) {
                    dt.ajax.reload(null, false);
                    $('#example').block({
                        message: `Loading...`
                    });
                    setTimeout(function() {
                        $('#example').unblock();
                    }, 1500);
                }
            }
        ]
        , initComplete: function(e, dt, node, config) {

        }
        , columns: [{
            data: 'DT_RowIndex'
            , name: 'DT_RowIndex'
            , className: 'text-center'
        }, {
            data: 'title'
            , name: 'title'
        , }, {
            data: 'slug'
            , name: 'slug'
            , className: 'text-center align-middle'
        }, {
            data: 'keywords'
            , name: 'keywords'
            , className: 'text-center align-middle'
        }, {
            data: 'action'
            , name: 'action'
            , className: 'text-center align-middle'
        }, ]
    });


    $(document).ready(function() {
        table.ajax.url('/blog/categories').load();
        console.log('mana neeee');

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

        $('.toggle-sidebar-btn').on('click', function() {
            setTimeout(function() {
                table.columns.adjust();
            }, 500);
        });

        $(document).on("click", "#addBtn", function() {
            var title = $(this).data('title');
            $("#judul-modal").html(title);
            $("#id_gallery").val('');

            // $('#title').val('');
            // $('#deskripsi').val('');
            // $('#alt').val('');
            // $('#filter_tag').val('');

            $('#nama').prop('disabled', false);
            $('#deskripsi').prop('disabled', false);

            $('#cover_image_url_btn').show();
            // $('.show-cover-box-edit').hide();

            $('#content_image_url_btn').show();
            // $('.show-content-box-edit').hide();

            $('#new-cover_image_url_').val('');
            $('#new-content_image_url_').val('');

            $('.show-cover-box').hide();
            $('#preview-cover').attr("src", '');

            $('.show-content-box').hide();
            $('#preview-content').attr("src", '');


        });

        $(document).on("click", "#editBtn", function() {
            $("#judul-modal").html('Edit Data Group');
            var data = table.row($(this).parents('tr')).data();
            console.log(data);
            $("#id_category").val(data.id);

            $('#name').val(data.name);
            $('#slug').val(data.slug);
            $('#keywords').val(data.keywords);
            $('#meta_desc').val(data.meta_desc);

            $('#nama').prop('disabled', false);
            $('#deskripsi').prop('disabled', false);


            $('#new-cover_image_url').val(data.image_url);
            $('#cover_image_url_btn').hide();
            $('.show-cover-box').show();
            $('#preview-cover').attr("src", data.image_url);

            $('#new-content_image_url').val(data.content_image_url);
            $('#content_image_url_btn').hide();
            $('.show-content-box').show();
            $('#preview-content').attr("src", data.content_image_url);

        });


    });

    $("#submitGroupBtn").on("click", function(event) {
        event.preventDefault();

        $('.modalBox').block({
            message: null
        });

        $('#submitGroupBtn').prop("disabled", true);

        var formdata = $("#groupForm").serialize(); // here $(this) refere to the form its submitting
        console.log(formdata);

        url = $('#groupForm').attr('action');
        $.ajax({
            type: 'POST'
            , url: url
            , data: formdata, // here $(this) refers to the ajax object not form
            dataType: 'json', // let's set the expected response format
            success: function(data) {
                setTimeout(function() {
                    $('#submitGroupBtn').prop("disabled", false);
                    $('.modalBox').unblock();
                    console.log(data);
                    if (data.success == 'yeah') {
                        $('#tambahGroup').modal('hide');
                        table.ajax.reload(null, false);
                        Swal.fire(
                            'Great!', 'Data sukses di update!', 'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!', data.message, 'error'
                        );
                    }


                }, 1500);

            }
            , error: function(err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $('.ajax-invalid').remove();
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span class="ajax-invalid" style="color: red;">' +
                            error[0] + '</span>'));
                    });
                } else if (err.status == 403) {
                    Swal.fire(
                        'Unauthorized!', 'You are unauthorized to do the action', 'warning'
                    );

                }
            }
        });



    });

    $(document).on('click', '#retry-cover-btn', function(e) {
        $('#cover_image_url_btn').show();
        $('.show-cover-box').hide();
    });

    $(document).on('click', '#retry-cover-btn-edit', function(e) {
        $('#cover_image_url_btn-edit').show();
        $('.show-cover-box-edit').hide();
    });

    $(document).on('click', '#retry-content-btn', function(e) {
        $('#content_image_url_btn').show();
        $('.show-content-box').hide();
    });

    $(document).on('click', '#retry-content-btn-edit', function(e) {
        $('#content_image_url_btn-edit').show();
        $('.show-content-box-edit').hide();
    });

    $(document).on("click", "#destroyBtn", function() {
        event.preventDefault();
        var idItem = $(this).data('id_item');

        swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin akan melakukan penghapusan data?'
            , text: "Anda tidak dapat mengembalikan file yang sudah dihapus!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'Ya, hapus!'
            , cancelButtonText: 'Tidak, batalkan!'
            , reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ route('categories.destroy', ':id') }}";
                url = url.replace(':id', idItem);
                $.ajax({
                    type: 'DELETE'
                    , url: url
                    , dataType: 'json', // let's set the expected response format
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            $('#tambahGroup').modal('hide');
                            swalWithBootstrapButtons.fire(
                                'Dihapus!'
                                , 'Data berhasil dihapus'
                                , 'success'
                            )
                        } else {
                            Swal.fire(
                                'Error!', data.message, 'error'
                            );
                        }
                        table.ajax.reload(null, false);
                    }
                    , error: function(err) {
                        if (err.status ==
                            422
                        ) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            // you can loop through the errors object and show it to the user
                            console.warn(err.responseJSON.errors);
                            // display errors on each form field
                            $('.ajax-invalid').remove();
                            $.each(err.responseJSON.errors, function(i, error) {
                                var el = $(document).find('[name="' +
                                    i + '"]');
                                el.after($('<span class="ajax-invalid" style="color: red;">' +
                                    error[0] + '</span>'));
                            });
                        } else if (err.status == 403) {
                            Swal.fire(
                                'Unauthorized!'
                                , 'You are unauthorized to do the action'
                                , 'warning'
                            );
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan!', 'Data Aman', 'error'
                )
            }
        });

    });

</script>

<script src="{{ asset('js/jquery-sortable.js') }}"></script>


<script>
    $('#select-all-categories').click(function(event) {
        if (this.checked) {
            $('#categories-list :checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('#categories-list :checkbox').each(function() {
                this.checked = false;
            });
        }
    });

</script>

<script>
    $('#select-all-posts').click(function(event) {
        if (this.checked) {
            $('#posts-list :checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('#posts-list :checkbox').each(function() {
                this.checked = false;
            });
        }
    });

</script>

<script>
    $('#add-categories').click(function(event) {
        var menuid = "{!! $selectedMenu ? $selectedMenu->id : '' !!}";
        var n = $('input[name="select-category[]"]:checked').length;
        var array = $('input[name="select-category[]"]:checked');
        var ids = [];
        for (i = 0; i < n; i++) {
            ids[i] = array.eq(i).val();
        }
        if (ids.length == 0) {
            return false;
        } else {
            $.ajax({
                type: "get"
                , data: {menuid:menuid,ids:ids}
                , url: "{{url('add-categories-to-menu')}}"
                , success: function() {
                    location.reload();
                }
            })
        }
    });

    $('#add-posts').click(function(event) {
        var menuid = "{!! $selectedMenu ? $selectedMenu->id : '' !!}";
        var n = $('input[name="select-post[]"]:checked').length;
        var array = $('input[name="select-post[]"]:checked');
        var ids = [];
        for (i = 0; i < n; i++) {
            ids[i] = array.eq(i).val();
        }
        if (ids.length == 0) {
            return false;
        } else {
            $.ajax({
                type: "get"
                , data: {menuid:menuid,ids:ids}
                , url: "{{url('add-posts-to-menu')}}"
                , success: function() {
                    location.reload();
                }
            });
        }
    });

    $('#add-custom-link').click(function(event) {
        var menuid = "{!! $selectedMenu ? $selectedMenu->id : '' !!}";
        var url = $('#url').val();
        var link = $('#linktext').val();
        var hreftarget = $('input[name="href_target"]:checked').val();

        if(url.length > 0 && link.length > 0) {
            $.ajax({
                type: "get"
                , data: {menuid:menuid,url:url,link:link,target:hreftarget}
                , url: "{{url('add-custom-link')}}"
                , success: function() {
                    location.reload();
                }
            });
        }
    });

</script>

<script>
    $('.btn-menu-select').click(function(event) {
        var selected = $('#menuid').find(":selected").val();
        // alert(selected);
        var base_url = window.location.origin;
        window.location.href = base_url + "/setting/menus?id=" + selected;

    });


    var group = $('#menuitems').sortable({
        group: 'serialization',
        onDrop: function($item, container, _super) {
            var data = group.sortable("serialize").get();
            var jsonString = JSON.stringify(data, null, 0);
            $('#serialize_output').text(jsonString);
            _super($item,container);
        }
    });

   

</script>


<script>
    $('#saveMenu').click(function(event) {

        var menuid = "{!! $selectedMenu ? $selectedMenu->id : '' !!}";
        var newContent = $('#serialize_output').text();
        var menuLocation = $('input[name="location"]:checked').val();


        if(newContent.length > 0) {
            var data = JSON.parse($('#serialize_output').text());
            $.ajax({
                type: "post"
                , data: {menuid:menuid,content:newContent,location:menuLocation}
                , url: "{{url('save-menu')}}"
                , success: function() {
                    document.location.reload();
                }
            })
        } else {
            $.ajax({
                type: "post"
                , data: {menuid:menuid,location:menuLocation}
                , url: "{{url('save-menu')}}"
                , success: function() {
                    document.location.reload();
                }
            })
        }
    });
</script>
@endsection