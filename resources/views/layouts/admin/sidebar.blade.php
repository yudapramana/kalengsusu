<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link @if (request()->segment(2) == 'home') @else collapsed @endif" href="{{ route('admin.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span> </a>
        </li>

        {{-- @can('menu-reservations') --}}
        {{-- <li class="nav-heading">Sistem Marketing</li>
        @can('page-reservation-index')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'reservations') @else collapsed @endif"
                href="/reservations"><i class="bi bi-bookmark-check-fill"></i><span>Reservasi </span></a></li>
        @endcan
        @can('page-reservation-audits')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'audits') @else collapsed @endif"
                href="/audits"><i class="bi bi-stopwatch-fill"></i><span>Log Perubahan </span></a></li>
        @endcan
        @can('page-reservation-deleted')
        <li class="nav-item"><a
                class="nav-link @if (request()->segment(2) == 'deleted-reservations') @else collapsed @endif"
                href="/deleted-reservations"><i class="bi bi-trash-fill"></i><span>Data Dihapus </span></a></li>
        @endcan --}}
        {{-- @endcan --}}

        @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator'))
            <li class="nav-heading">Kelola Informasi</li>
            <li class="nav-item"> <a class="nav-link @if (request()->segment(2) == 'informasi') @else collapsed @endif" href="{{ route('info.index') }}">
                    <i class="bi bi-clipboard-data"></i>

                    <span>Data & Informasi</span> </a>
            </li>
        @endif

        {{-- <li class="nav-item"> <a
                class="nav-link @if (request()->segment(2) == 'permohonan') @else collapsed @endif"
                href="{{ route('permohonan.index') }}">
                <i class="bi bi-clipboard"></i>

                <span>Permohonan</span> </a>
        </li> --}}

        <li class="nav-heading">Kelola Web</li>

        {{-- @can('menu-information') --}}
        @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator'))
            <li class="nav-item">
                <a class="nav-link @if (request()->segment(2) == 'information') @else collapsed @endif" data-bs-target="#information-nav" data-bs-toggle="collapse" href="#" aria-expanded="@if (request()->segment(2) == 'information') true @else false @endif">
                    <i class="bi bi-journal-text"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="information-nav" class="nav-content collapse @if (request()->segment(2) == 'information') show @endif" data-bs-parent="#sidebar-nav" style="">

                    @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('kontributor_utama'))
                        <li>
                            <a href="{{ route('services.index') }}" class="@if (request()->segment(3) == 'services') active @endif">
                                <i class=" bi bi-circle"></i><span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('activities.index') }}" class="@if (request()->segment(3) == 'activities') active @endif">
                                <i class=" bi bi-circle"></i><span>Activities</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('galleries.index') }}" class="@if (request()->segment(3) == 'galleries') active @endif">
                                <i class=" bi bi-circle"></i><span>Galleries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('carousels.index') }}" class="@if (request()->segment(3) == 'carousels') active @endif">
                                <i class=" bi bi-circle"></i><span>Carousels</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
        {{-- @endcan --}}

        {{-- @can('menu-data') --}}
        @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator'))
            <li class="nav-item">
                <a class="nav-link @if (request()->segment(2) == 'data') @else collapsed @endif" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#" aria-expanded="@if (request()->segment(2) == 'data') true @else false @endif">
                    <i class="bi bi-chat-left-text"></i><span>Data Input</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-nav" class="nav-content collapse @if (request()->segment(2) == 'data') show @endif" data-bs-parent="#sidebar-nav" style="">
                    @can('page-data-messages')
                        <li>
                            <a href="{{ route('messages.index') }}" class="@if (request()->segment(3) == 'messages') active @endif">
                                <i class=" bi bi-circle"></i><span>Messages</span>
                            </a>
                        </li>
                    @endcan
                    @can('page-data-users')
                        <li>
                            <a href="{{ route('users.index') }}" class="@if (request()->segment(3) == 'users') active @endif">
                                <i class=" bi bi-circle"></i><span>Users</span>
                            </a>
                        </li>
                    @endcan
                    @can('page-data-roles')
                        <li>
                            <a href="{{ route('roles.index') }}" class="@if (request()->segment(3) == 'roles') active @endif">
                                <i class=" bi bi-circle"></i><span>Roles</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endif
        {{-- @endcan --}}

        {{-- @can('menu-blog') --}}
        <li class="nav-item">
            <a class="nav-link @if (request()->segment(2) == 'blog') @else collapsed @endif" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#" aria-expanded="@if (request()->segment(2) == 'blog') true @else false @endif">
                <i class="bi bi-file-earmark-post"></i><span>Berita</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blog-nav" class="nav-content collapse @if (request()->segment(2) == 'blog') show @endif" data-bs-parent="#sidebar-nav" style="">

                @foreach ($bootCategories as $cat)
                    @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('kontributor_utama'))
                        <li>
                            <a href="{{ route('posts.index', ['category' => $cat->slug]) }}" class="{{ request()->segment(3) == 'posts' ? (isset($category) ? ($category == $cat->slug ? 'active' : '') : '-') : '-' }}">
                                <i class=" bi bi-circle"></i><span>{{ $cat->title }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->hasRole('kontributor_daerah') && ($cat->slug == 'artikel' || $cat->slug == 'daerah'))
                        <li>
                            <a href="{{ route('posts.index', ['category' => $cat->slug]) }}" class="{{ request()->segment(3) == 'posts' ? (isset($category) ? ($category == $cat->slug ? 'active' : '') : '-') : '-' }}">
                                <i class=" bi bi-circle"></i><span>{{ $cat->title }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach


                {{-- <li>
                    <a href="{{ route('posts.index', ['category' => 'utama']) }}"
                        class="{{    request()->segment(3) == 'posts' ?  (isset($category)  ? ($category == 'utama' ? 'active' : '') : '-'     )   : '-'  }}">
                        <i class=" bi bi-circle"></i><span>Utama</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('posts.index', ['category' => 'daerah']) }}"
                        class="{{    request()->segment(3) == 'posts' ?  (isset($category)  ? ($category == 'daerah' ? 'active' : '') : '-'     )   : '-'  }}">
                        <i class=" bi bi-circle"></i><span>Daerah</span>
                    </a>
                </li> --}}



            </ul>
        </li>
        {{-- @endcan --}}



        {{-- Setting --}}
        @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator'))

            <li class="nav-item">
                <a class="nav-link @if (request()->segment(2) == 'setting') @else collapsed @endif" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#" aria-expanded="@if (request()->segment(2) == 'setting') true @else false @endif">
                    <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="setting-nav" class="nav-content collapse @if (request()->segment(2) == 'setting') show @endif" data-bs-parent="#sidebar-nav" style="">
                    @can('page-blog-categories')
                        <li>
                            <a href="{{ route('categories.index') }}" class="@if (request()->segment(3) == 'categories') active @endif">
                                <i class=" bi bi-circle"></i><span>Categories</span>
                            </a>
                        </li>
                    @endcan
                    @can('page-blog-tags')
                        <li>
                            <a href="{{ route('tags.index') }}" class="@if (request()->segment(3) == 'tags') active @endif">
                                <i class=" bi bi-circle"></i><span>Tags</span>
                            </a>
                        </li>
                    @endcan

                    @if (Auth::user()->hasRole('super_administrator') || Auth::user()->hasRole('administrator'))
                        <li>
                            <a href="{{ route('menus.index', ['id' => '1']) }}" class="@if (request()->segment(3) == 'menus') active @endif">
                                <i class=" bi bi-circle"></i><span>Menus</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        {{-- @can('page-blog-news') --}}
        {{-- <li>
            <a href="{{ route('news.index') }}" class="@if (request()->segment(3) == 'news') active @endif">
                <i class=" bi bi-circle"></i><span>News</span>
            </a>
        </li> --}}
        {{-- @endcan --}}
        {{-- @can('page-blog-categories') --}}









        {{-- @can('menu-information')
        <li class="nav-heading">Kelola Informasi</li>
        @can('page-information-services')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'services') @else collapsed @endif"
                href="/services"><i class="bi bi-shop"></i><span>Services</span></a></li>
        @endcan
        @can('page-information-products')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'products') @else collapsed @endif"
                href="/products"><i class="bi bi-basket"></i><span>Products</span></a></li>
        @endcan
        @can('page-information-galleries')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'galleries') @else collapsed @endif"
                href="/galleries"><i class="bi bi-border-all"></i><span>Galleries</span></a></li>
        @endcan
        @can('page-information-carousels')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'carousels') @else collapsed @endif"
                href="/carousels"><i class="'bi bi-display"></i><span>Carousels</span></a></li>
        @endcan
        @endcan --}}

        {{-- @can('menu-data')
        <li class="nav-heading">Kelola Data</li>
        @can('page-data-messages')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'messages') @else collapsed @endif"
                href="/messages"><i class="bi bi-chat-left-text"></i><span>Message </span></a></li>
        @endcan
        @can('page-data-users')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'users') @else collapsed @endif"
                href="/users"><i class="bi bi-person-lines-fill"></i><span>User Data </span></a></li>
        @endcan
        @can('page-data-roles')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'roles') @else collapsed @endif"
                href="/roles"><i class="bi bi-person-workspace"></i><span>User Role </span></a></li>
        @endcan
        @endcan --}}

        {{-- @can('menu-blog')
        <li class="nav-heading">Kelola Blog</li>
        @can('page-blog-categories')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'categories') @else collapsed @endif"
                href="/categories"><i class="bi bi-chat-left"></i><span>Categories </span></a></li>
        @endcan
        @can('page-blog-tags')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'tags') @else collapsed @endif"
                href="/tags"><i class="bi bi-tag"></i><span>Tags </span></a></li>
        @endcan
        @can('page-blog-posts')
        <li class="nav-item"><a class="nav-link @if (request()->segment(2) == 'posts') @else collapsed @endif"
                href="/posts"><i class="bi bi-file-earmark-post"></i><span>Posts </span></a></li>
        @endcan
        @endcan --}}

    </ul>
</aside>
