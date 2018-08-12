<?php

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Redirect as Redirect;

class AdminUserController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (Auth::user()->role!=1)
                return Redirect::to('/admin')->with(
                    array(
                        'note' => 'Yetkiniz Bulunmamaktadır !',
                    )
                );
        });
    }

    private static $roles = array(1 => 'Admin', 2 => 'Editör');
    private static $active = array('Pasif', 'Aktif');

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return View::make('admin.user.index', compact('users'));
    }

    public function create()
    {
        $data = array(
            'post_route' => URL::to('admin/users/store'),
            'userRoles' => self::$roles,
            'activeRoles' => self::$active
        );

        return View::make('admin.user.create_edit', $data
        );
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->all();

        if (empty($data['active'])) {
            $data['active'] = 0;
        }

        $usr = new User();
        $usr->name = $data['name'];
        $usr->email = $data['email'];
        $usr->password = Hash::make($data['password_confirmation']);
        $usr->role = $data['role'];
        $usr->active = $data['active'];
        $usr->save();

        return Redirect::to('admin/users')->with(array('note' => 'Yeni Kullanıcı başarılı bir şekilde eklendi!'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        $data = array(
            'post_route' => URL::to('admin/users/update'),
            'user' => $user,
            'userRoles' => self::$roles,
            'activeRoles' => self::$active
        );

        return View::make('admin.user.create_edit', $data);
    }

    public function update(UpdateUserRequest $request)
    {

        (bool)$state = false;

        if (!empty($request['password']) && !empty($request['password_confirmation'])) {
            $messages = [
                'same'  => 'Girdiğiniz şifreler eşleşmiyor',
                'min'   => 'Yeni şifreniz en az :min karakterden oluşmalıdır',
            ];

            $rules = array(
                'password'              => 'min:6',
                'password_confirmation' => 'min:6|same:password'
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                $state = false;
                $messages = $validator->messages();

                return Redirect::to('admin/user/edit/'.$request['id'])
                    ->withErrors($messages)
                    ->withInput();
            }
            else
            {
                $state = true;
            }
        }

        $usr = User::find($request['id']);
        $usr->name = $request['name'];
        $usr->email = $request['email'];
        $usr->role = $request['role'];
        $usr->active = $request['active'];

        if ($state) {
            $usr->password = Hash::make($request['password_confirmation']);
        }
        $usr->save();

        \CacheRemove::tags('videos/reference');

        return Redirect::to('/admin/users/edit/'.$request['id'])
            ->with(array(
                'note' => 'Kullanıcı Bilgileri Güncellendi'
            ));

    }

    public function destroy($id)
    {
        User::destroy($id);

        return Redirect::to('admin/users')->with(array('note' => 'Kullanıcı başarılı bir şekilde silindi!'));
    }

}
