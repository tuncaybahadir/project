<?php

use App\Http\Requests\UpdatePasswordRequest;
use Redirect as Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return View::make('admin.index');
    }

    public function password()
    {
        return View::make('admin.user.password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {

        $data = $request->all();


        $admin = Auth::user();
        $admin->password = Hash::make($data['new_password_confirmation']);
        $admin->save();

        return Redirect::to('admin/')->with(array('note' => 'Başarılı bir şekilde şifreniz değiştirildi.'));

    }

}
