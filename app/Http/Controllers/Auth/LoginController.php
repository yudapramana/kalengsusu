<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'admin/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }

    /**
     * Override showLoginForm dari trait AuthenticatesUsers
     */
    public function showLoginForm()
    {
        // Contoh: lempar data tambahan ke view
        $data = [
            'title' => 'Masuk ke Dashboard',
            'someData' => 'nilai tambahan jika perlu'
        ];

        // Render view kustom (bisa 'auth.login' atau view lain)
        return view('auth.login', $data);
    }

   

    public function login(Request $request)
    {
        // Pastikan field username/email disesuaikan: method username() akan men-merge request
        $field = $this->username(); // this will also modify request to contain the correct field

        // Validasi input
        $validator = Validator::make($request->all(), [
            $field => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Throttle / lockout (menggunakan trait AuthenticatesUsers)
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            // Jika AJAX, kembalikan JSON dengan info lockout
            if ($request->ajax()) {
                $seconds = $this->limiter()->availableIn(
                    $this->throttleKey($request)
                );
                return response()->json([
                    'status' => 'error',
                    'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
                    'retry_after' => $seconds
                ], 429);
            }

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only($field, 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // sukses login
            $request->session()->regenerate();

            // reset attempts
            if (method_exists($this, 'clearLoginAttempts')) {
                $this->clearLoginAttempts($request);
            }

            // update last login info (duplikat juga di authenticated(), tapi aman)
            $user = Auth::user();
            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);

            // AJAX response
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'redirect' => $this->redirectPath()
                ], 200);
            }

            return redirect()->intended($this->redirectPath());
        }

        // gagal login -> increment attempts
        if (method_exists($this, 'incrementLoginAttempts')) {
            $this->incrementLoginAttempts($request);
        }

        // prepare error message
        $errMsg = ['password' => ['Kredensial tidak cocok atau pengguna tidak ditemukan.']];

        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'errors' => $errMsg
            ], 422);
        }

        // non-ajax fallback
        return redirect()->back()
            ->withErrors($errMsg)
            ->withInput($request->only($field, 'remember'));
    }

}
