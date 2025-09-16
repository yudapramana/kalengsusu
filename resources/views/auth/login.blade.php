<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Kantor Wilayah Kementerian Agama Prov. Sumatera Barat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('assets/images/logo/logo-kemenag.png') }} " rel="icon">
    <link href="{{ asset('assets/images/logo/logo-kemenag.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('niceadmin/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/boxicons/css/boxicons.min.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/quill/quill.snow.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/quill/quill.bubble.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/remixicon/remixicon.css') }} " rel="stylesheet">
    <link href="{{ asset('niceadmin/vendor/simple-datatables/style.css') }} " rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('niceadmin/css/style.css') }} " rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .logo img {
            max-height: 70px !important;
            margin-right: 10px;
        }

        body,
        html {
            background: none !important;
            height: 100%;
        }

        .bg-image {
            background: url('https://res.cloudinary.com/dezj1x6xp/image/upload/v1698299466/PandanViewMandeh/AF1QipPbUTeNjEbixXR5hd3ZD3tk1XME5u0PJbGLnUPI_s0_vv0w8g.jpg') !important;
            background-size: cover !important;
            filter: blur(3px);
            -webkit-filter: blur(3px);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        main {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
        }

        /* small helper */
        .text-error {
            color: #dc3545;
            font-size: 0.9rem;
        }

        .ajax-global {
            margin-bottom: 1rem;
        }
    </style>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</head>

<body>
    <div class="bg-image"></div>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/images/logo/kanwil_logo_whited.png') }}" alt="">
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun Anda</h5>
                                        <p class="text-center small">Masukkan username dan Password untuk login</p>
                                    </div>

                                    {{-- Global AJAX message --}}
                                    <div id="ajax-global-messages"></div>

                                    <form id="login-form" class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="yourUsername" required autocomplete="username" value="{{ old('username') }}">
                                            </div>
                                            <div class="invalid-feedback text-error" id="error-username" style="display:none;"></div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required autocomplete="current-password">
                                            <div class="invalid-feedback text-error" id="error-password" style="display:none;"></div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Ingat Saya</label>
                                            </div>
                                        </div>

                                        <div class="col-12 center text-center">
                                            <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-theme="light">
                                            </div>
                                            @error('turnstile')
                                                <div class="text-error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" id="btn-login" type="submit">Login</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Lupa password Akun? Hubungi Administrator</p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits"></div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('niceadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}  "></script>
    <script src="{{ asset('niceadmin/vendor/quill/quill.min.js') }}  "></script>
    <script src="{{ asset('niceadmin/vendor/simple-datatables/simple-datatables.js') }}  "></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('niceadmin/js/main.js') }}  "></script>

    <script>
        (function() {
            'use strict';

            // helpers
            const qs = (s, ctx = document) => ctx.querySelector(s);
            const qsa = (s, ctx = document) => Array.from(ctx.querySelectorAll(s));
            const showFieldError = (name, message) => {
                const selector = '#error-' + name.replace(/[\[\].]/g, '_');
                const el = document.querySelector(selector);
                const input = document.querySelector('[name="' + name + '"]');
                if (input) input.classList.add('is-invalid');
                if (el) {
                    el.textContent = message;
                    el.style.display = 'block';
                } else if (message) {
                    // create if not exist
                    const wrap = input ? input.parentElement : qs('#ajax-global-messages');
                    const div = document.createElement('div');
                    div.className = 'text-error';
                    div.id = 'error-' + name.replace(/[\[\].]/g, '_');
                    div.textContent = message;
                    wrap.appendChild(div);
                }
            };
            const clearFieldErrors = () => {
                qsa('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
                qsa('[id^="error-"]').forEach(e => {
                    e.textContent = '';
                    e.style.display = 'none';
                });
                qs('#ajax-global-messages').innerHTML = '';
            };
            const showGlobalMessage = (msg, type = 'danger') => {
                qs('#ajax-global-messages').innerHTML = `<div class="alert alert-${type} ajax-global">${msg}</div>`;
            };

            // form submit
            const form = qs('#login-form');
            const btn = qs('#btn-login');

            if (!form) return;

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearFieldErrors();

                const originalBtnHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...`;

                const url = form.getAttribute('action') || '{{ route('login') }}';
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Build form data
                const formData = new FormData(form);

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    });

                    const json = await (res.status === 204 ? {} : res.json().catch(() => ({})));

                    if (res.ok) {
                        // success
                        if (json.status === 'success' || json.status === 'ok' || json.redirect) {
                            // gunakan redirect dari server (jika ada), kalau tidak pakai APP_URL + '/admin/home'
                            const redirect = json.redirect || "{{ env('APP_URL') }} /admin/home";
                            window.location.href = redirect;
                            return;
                        } else {
                            // fallback success but no redirect
                            showGlobalMessage(json.message || 'Login berhasil', 'success');
                            if (json.redirect) window.location.href = json.redirect;
                        }
                    } else {
                        // Handle common error statuses
                        if (res.status === 422 && json.errors) {
                            // validation errors
                            const errors = json.errors;
                            Object.keys(errors).forEach(key => {
                                showFieldError(key, errors[key][0]);
                            });
                            // scroll to first error
                            const first = document.querySelector('.is-invalid');
                            if (first) first.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        } else if (res.status === 429) {
                            // throttle
                            const msg = json.message || 'Terlalu banyak percobaan login. Silakan coba lagi nanti.';
                            showGlobalMessage(msg, 'warning');
                        } else if (res.status === 419) {
                            showGlobalMessage('Sesi berakhir. Silakan muat ulang halaman dan coba lagi.', 'warning');
                        } else {
                            // other errors
                            const msg = json.message || `Terjadi kesalahan. (code: ${res.status})`;
                            showGlobalMessage(msg, 'danger');
                        }
                    }

                } catch (err) {
                    console.error(err);
                    showGlobalMessage('Gagal menghubungi server. Periksa koneksi internet Anda.', 'danger');
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = originalBtnHtml;
                }
            }, false);

        })();
    </script>

</body>

</html>
