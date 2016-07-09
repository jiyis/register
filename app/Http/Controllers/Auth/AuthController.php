<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Index\LoginRequest;
use App\User;
use Validator, Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $guard = 'web';

    protected $username = 'student_id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'student_id' => 'required|max:255',
            //'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'student_id' => $data['student_id'],
            //'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    private function attempt($credentials)
    {
        //Auth::attempt()
        if ( ! isset( $credentials['password'] ) or ! isset( $credentials['student_id'] )) {
            return false;
        }

        $user = User::where('student_id',$credentials['student_id'])
            ->wherePassword(md5($credentials['password']))
            ->first();
        if ($user) {
            Auth::login($user);
            return true;
        }
        Auth::attempt($credentials);

    }
    /**
     * @param LoginRequest $request
     * @return mixed
     * 手动认证用户
     */
    public function login(LoginRequest $request)
    {
        $field = filter_var($request->input('student_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'student_id';
        $request->merge([$field => $request->input('student_id')]);

        if ($this->attempt($request->only($field, 'password')))
        {
            return redirect('/');
        }
        //session()->flash('student_id',$request->input('student_id'));
        return redirect('/login')->withErrors([
            'student_id' => '用户名或密码错误。',
        ])->withInput();
    }

    /*protected function getFailedLoginMessage()
    {
        return '登录信息有误，请重新输入';
    }*/
}
