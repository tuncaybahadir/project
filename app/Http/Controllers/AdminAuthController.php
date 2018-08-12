<?php

class AdminAuthController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        if (!Auth::guest()) {
            return Redirect::to('/');
        }

        return View::make('admin.auth.login');
    }

    public function login()
    {
        $email_login = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        );

        if (Auth::attempt($email_login)) {
            if (Auth::user()->role < 1 || Auth::user()->active != 1) {
                Auth::logout();

                return Redirect::to('/')->with(array('note' => 'Hesabınızın yönetim paneli erişim hakkı bulunmamaktadır!'));
            }

            return Redirect::to('admin/')->with(array('note' => 'Başarılı bir şekilde giriş yapıldı.'));
        } else {
            return Redirect::to('admin/login')->with(array('note' => 'E-Posta adresi veya parola hatalı!'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::back()->with(array('note' => 'Başarılı bir şekilde çıkış yapıldı.'));
    }
}
