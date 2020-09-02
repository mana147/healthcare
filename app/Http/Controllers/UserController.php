<?php

namespace App\Http\Controllers;

use App\User;
use App\Sokhambenh;
use App\Donthuoc;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\JWT\JWT;
use App\JWT\JsonHelper;


class UserController extends Controller {
    //
    public function GetList()
    {
        $users = User::all();
        return view('pages.admin.user.list', ['users' => $users]);
    }

    public function GetDefault()
    {
        if (Auth::check()) {
            return view('pages.users.home.home');
        } else {
            return view('pages.users.login');
        }
    }

    public function GetAdd()
    {
        return view('pages.admin.user.add');
    }

    public function PostAdd(Request $request)
    {
        $newuser = new User;
        $this->validate(
            $request,
            [
                'txtUser' => 'required|min:3|max:100|unique:users,name'
            ],
            [
                'txtUser.required' => ' Bạn chưa nhập username',
                'txtUser.min' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.max' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.unique' => 'Username đã tồn tại',
            ]
        );

        $this->validate(
            $request,
            [
                'txtPass' => 'required|min:5|max:100'
            ],
            [
                'txtPass.required' => ' Bạn chưa nhập PassWord',
                'txtPass.min' => 'Username phải có độ dài từ 5 đến 100 kí tự',
                'txtPass.max' => 'Username phải có độ dài từ 5 đến 100 kí tự',
            ]
        );

        $this->validate(
            $request,
            [
                'txtEmail' => 'unique:users,email'
            ],
            [
                'txtEmail.unique' => 'Email đã tồn tại',
            ]
        );

        $newuser = new User;
        $newuser->name = $request->txtUser;
        $newuser->password = bcrypt($request->txtPass);
        $newuser->email = $request->txtEmail;

        if ($request->rdoLevel == 1) {
            $newuser->level = "member";
        } else {
            $newuser->level = "manager";
        }

        $newuser->save();

        return redirect('admin/user/add')->with('Notify', 'Successfully');
    }

    public function GetEdit($id)
    {
        $user = User::find($id);
        if ($user->level != 'admin') {
            return view('pages.admin.user.edit', ['user' => $user]);
        } else {
            return redirect('admin/user/list')->with('Notify', 'You not permission');
        }
    }


    public function PostEdit(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate(
            $request,
            [
                'txtUser' => 'required|min:3|max:100|unique:users,name'
            ],
            [
                'txtUser.required' => ' Bạn chưa nhập username',
                'txtUser.min' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.max' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.unique' => 'Username đã tồn tại',
            ]
        );

        $this->validate(
            $request,
            [
                'txtPass' => 'required|min:5|max:100'
            ],
            [
                'txtPass.required' => ' Bạn chưa nhập PassWord',
                'txtPass.min' => 'Username phải có độ dài từ 5 đến 100 kí tự',
                'txtPass.max' => 'Username phải có độ dài từ 5 đến 100 kí tự',
            ]
        );


        $user->name = $request->txtUser;
        $user->password = bcrypt($request->txtPass);
        if ($request->rdoLevel == 1) {
            $user->level = "member";
        } else {
            $user->level = "manager";
        }
        $user->save();
        return redirect('admin/user/edit/' . $id)->with('Notify', 'Successfully');
    }

    public function GetDelete($id)
    {
        $user = User::find($id);
        if ($user->level != 'admin') {
            $user->delete();
            return redirect('admin/user/list')->with('Notify', 'Delete Successfully');
        } else {
            return redirect('admin/user/list')->with('Notify', 'You not permission');
        }
    }

    public function GetAdmin()
    {
        if (Auth::check()) {
            return redirect('admin/user/list');
        } else {
            return view('pages.admin.login');
        }
    }

    public function GetHome()
    {
        if (Auth::check()) {
            return view('pages.users.home.home');
        } else {
            return view('pages.users.login');
        }
    }

    public function GetAdminLogin()
    {
        return view('pages.admin.login');
    }

    public function PostAdminLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập password',
            ]
        );

        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 'manager']) ||
            Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 'admin']))
        {
            return redirect('admin/user/list');
        } else {
            return redirect('admin/login')->with('Notify', 'Login False');
        }
    }

    public function GetAdminLogout(Request $request)
    {
        Auth::logout();
        return redirect('admin/login');
    }

    // GetLogin
    public function GetLogin()
    {
        return view('pages.users.login');
    }

    // PostLogin

    public function PostLogin(Request $request)
    {
        Auth::logout();

        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập password',
            ]
        );


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect('home');
            // return response()->json($str);

        } else {
            // return response()->json($str);
            return redirect('login')->with('Notify', 'Login False');
        }
    }
    // getjson
    public function GetJson()
    {
        // echo 'getjson ok';

        // $token = array();
        // $token["id"] = 123123;
        // $token["name"] = "pham trung hieu";
        // $token["email"] = "phamhieu078@gmail.com";
        // $jsonwebtoken = JWT::encode($token, "itc@123");
        // $json = JsonHelper::getJson("token", $jsonwebtoken);

        // return response()->json($jsonwebtoken);

        // if (Auth::check()) {
        //     return response()->json($db);
        // } else {
        //     return view('pages.users.login');
        // }
        // $jsonString = file_get_contents(base_path('database/data/user1.json'));
        // $data = json_decode($jsonString, true);


        // $users = Sokhambenh::where('id_userhw','us02hw02')->donthuoc->toArray();

        // $u = User::where('id_userhw','us02hw02')->get();
        $d = User::find(1)->sokhambenh->toJson();


        // $users = Donthuoc::all();

        // $users = DB::table('users')->get();
        // $users = DB::table('users')->where('iduserhw','US01HW01')->first();
        // $users = DB::table('users')->where('iduserhw','US01HW01')->first();


        // var_dump($users);
        // echo $data ;
        return response($d);
    }

    // ================================================================

    public function Createdatabase(){
        // Schema::table('users', function ($table) {
        //     $table->integer('id_sokhambenh')->unsigned();
        // });

        // Schema::table('sokhambenh', function ($table) {
        //     // $table->string('id_userhw');
        //     // $table->string('chuan_doan');
        //     // $table->integer('nhip_tim');
        //     // $table->integer('oxy');
        //     // $table->integer('huyet_ap');
        //     // $table->integer('nhiet_do');
        //     // $table->integer('chieu_cao');
        //     // $table->integer('can_nang');
        //     // $table->integer('tuoi');
        //     // $table->integer('gioi_tinh');
        //     $table->integer('id_donthuoc');
        // });


        // Schema::table('donthuoc', function ($table) {
        //     // $table->increments('id');
        //     // $table->timestamps();

        //     $table->text('chuandoanbenh');
        //     $table->string('tenthuoc');
        //     $table->string('donvi');
        //     $table->integer('soluong');
        //     $table->text('lieudung');
        //     $table->integer('id_sokhambenh');
        // });

        // Schema::create('test2', function (Blueprint $table) {
        //     $table->bigIncrements('id');

        //     $table->string('name')->unique();
        //     $table->integer('numb')->unsigned();

        //     // $table->integer('votes')->unsigned()->nullable()->default(12);

        //     $table->integer('user_id')->unsigned()->nullable()->default(1);
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        //     $table->integer('cate_id')->unsigned()->nullable()->default(1);
        //     $table->foreign('cate_id')->references('id')->on('test1')->onDelete('cascade');

        //     $table->timestamps();
        // });

        echo 'create_database ok';

        // Schema::create('posts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('slide_url');
        //     $table->string('title');
        //     $table->string('content');
        //     $table->timestamps();
        // });

        Schema::table('sokhambenh', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->timestamps();
        });

    }


    public function Setdatasokhambenh()
    {

        $user = new Sokhambenh;

        // $user->id = 9;
        $user->id_userhw = 'us05hw05';
        $user->chuan_doan = 'bệnh tiểu đường tuýt 2';
        $user->nhip_tim = 123;
        $user->oxy = 123;
        $user->huyet_ap = 123;
        $user->nhiet_do = 123;
        $user->chieu_cao = 123;
        $user->can_nang = 123;
        $user->tuoi = 123;
        $user->gioi_tinh = 'nu';
        $user->id_donthuoc = 0;

        $user->save();

        echo 'setdata_sokhambenh ok';

        // echo $user->get();
    }

    public function Setdatadonthuoc() {

         $user = new Donthuoc;

         $user->tenthuoc = 'Abdsitap';
         $user->donvi  = 'vỉ';
         $user->soluong = 2;
         $user->lieudung = 'ngày dùng 4 viên';
         $user->id_sokhambenh = 0;

         $user->save();

         echo 'setdata_donthuoc ok';
    }



    //==================================================================

    public function PostSearchId(Request $request)
    {
        if (Auth::check()) {

            $json = $request->all();

            $id = $json['id_userhw'];

            $users = User::where('id_userhw',$id)->get();

            return response()->json($users[0]);
        } else {
            return view('pages.users.login');
        }

    }

    public function PostSokhambenh(Request $request)
    {
        if (Auth::check()) {

            $json = $request->all();

            $id = $json['id'];

            $users = User::find($id)->sokhambenh->toJson();

            return response($users);

        } else {
            return view('pages.users.login');
        }
    }

    public function PostSaveListId(Request $request)
    {
        if (Auth::check()) {
            $data = $request->all();
            $id = $data['id'];

            $flight = User::find($id);

            // $flight->name = 'Pham Trung Hieu';
            $flight->user_enable = $data;
            $flight->save();

            return response($flight);
        } else {
            return view('pages.users.login');
        }
    }

    //==================================================================


    // GetUserLogin
    public function GetUserLogin()
    {
        if (Auth::check()) {

            $users = Auth::user();

            // error_log("auth check ok ");

            return response()->json($users);

        } else {

            return view('pages.users.login');

        }
    }


    public function GetRegister()
    {
        return view('pages.users.register');
    }

    public function PostRegister(Request $request)
    {
        $newuser = new User;

        $this->validate(
            $request,
            [
                'txtUser' => 'required|min:3|max:100|unique:users,name'
            ],
            [
                'txtUser.required' => ' Bạn chưa nhập username',
                'txtUser.min' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.max' => 'Username phải có độ dài từ 3 đến 100 kí tự',
                'txtUser.unique' => 'Username đã tồn tại',
            ]
        );

        $this->validate(
            $request,
            [
                'txtPass' => 'required|min:5|max:100'
            ],
            [
                'txtPass.required' => ' Bạn chưa nhập PassWord',
                'txtPass.min' => 'Username phải có độ dài từ 5 đến 100 kí tự',
                'txtPass.max' => 'Username phải có độ dài từ 5 đến 100 kí tự',
            ]
        );

        $this->validate(
            $request,
            [
                'txtEmail' => 'required|unique:users,email'
            ],
            [
                'txtEmail.unique' => 'Email đã tồn tại',
            ]
        );


        $newuser = new User;

        $newuser->id_userhw = "user";
        $newuser->name = $request->txtUser;
        $newuser->password = bcrypt($request->txtPass);
        $newuser->email = $request->txtEmail;
        $newuser->level = "member";

        $newuser->id_sokhambenh = 0;

        $newuser->user_enable = null;

        $newuser->save();

        return redirect('home');
    }

    public function GetLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    // kê đơn
    public function GetKedon()
    {
        if (Auth::check()) {
            return view('pages.users.kedon.kedon');
        } else {
            return view('pages.users.login');
        }
    }

    public function GetShareInfo()
    {
        if (Auth::check()) {
            return view('pages.users.share.share');
        } else {
            return view('pages.users.login');
        }
    }



}
