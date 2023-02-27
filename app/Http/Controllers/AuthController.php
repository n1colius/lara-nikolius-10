<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-07-05 15:18:58
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function index()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }

        return view('login');
    }

    public function login_proc(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'email.required'        => 'Email is required',
            'email.email'           => 'Email not valid',
            'password.required'     => 'Password is required',
            'password.string'       => 'Password must be a string'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth

            //Select informasi user
            $sqlraw = "SELECT
                            a.`id`
                            , a.`name`
                            , a.`email`
                        FROM
                            users a
                        WHERE 1=1
                            AND a.`email` = ?
                        LIMIT 1";
            $data_user = DB::select($sqlraw, [$request->input('email')]);

            //Setup Session Login
            $request->session()->put('seslog.id', $data_user[0]->id);
            $request->session()->put('seslog.name', $data_user[0]->name);
            $request->session()->put('seslog.email', $data_user[0]->email);

            //Login Success
            return redirect()->route('home');
        } else { // false
  
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login')->withInput();
        }

    }

    public function register() {
        return view('register');
    }

    public function register_proc (Request $request) {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap is required',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email is required',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password is required',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
  
        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }

    }
    
    public function logout()
    {
        Session::forget('seslog'); //hapus session login
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('home');
    }

}