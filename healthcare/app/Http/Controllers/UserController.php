<?php

namespace App\Http\Controllers;

use App\User;
use App\Sokhambenh;
use App\Donthuoc;
use App\Devices;
use App\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\JWT\JWT;
use App\JWT\JsonHelper;

use Mail;

use App\Jobs\JobMail;
use App\Mail\TestMail;


class UserController extends Controller {
    //
    public function GetList() {
        $users = User::all();
        // echo Str::length($users);
        // for ($i = 0; $i < 1; $i++){
        //     echo $users[$i];
        // }
        
        // echo $users[0];
        $d = 'test';

        return view('pages.admin.user.list', ['users' => $users ,'d' => $d]);
    }

    public function GetlistDevice () 
    {
        $devices = Devices::all();
        // echo $devices;
        return view('pages.admin.device.list', ['devices' => $devices]);
    }

    public function GetDefault()
    {
        if (Auth::check()) {
            return view('pages.users.home.home');
        } else {
            return view('pages.users.login');
        }
    }

    public function GetAddDevice() {
        return view('pages.admin.device.add');
    }


    public function PostAddDevice(Request $request)
    { 
        $newdevice = new Devices;

        // echo  $request;

        $this->validate(
            $request, 
            [
                'txtIDdevice' => 'required|min:3|max:100|unique:devices,id_device'
            ],
            [
                'txtIDdevice.required' => 'Bạn chưa nhập ID Device',
                'txtIDdevice.min' => 'ID Device phải có độ dài từ 3 đến 100 kí tự',
                'txtIDdevice.max' => 'ID Device phải có độ dài từ 3 đến 100 kí tự',
                'txtIDdevice.unique' => 'ID Device đã tồn tại',
            ]
        );

        $newdevice->id_device =   $request->txtIDdevice;

        $newdevice->save();

        return redirect('admin/device/add')->with('Notify', 'Successfully');


    }

    public function GetAdd() {
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
        $r = random_int(10,999);
        $str = 'us'.$r.'hw'.$r;

        $newuser->id_device =  NULL;
        $newuser->id_userhw =   $str;

        $newuser->name =        $request->txtUser;
        $newuser->number =      '0000000000';
        $newuser->password =    bcrypt($request->txtPass);
        $newuser->email =       $request->txtEmail;


        if ($request->rdoLevel == 1) {
            $newuser->level = "member";
        } else {
            $newuser->level = "manager";
        }

        $newuser->user_enable = null; 
        
        $newuser->save();

        return redirect('admin/user/add')->with('Notify', 'Successfully');
    }

    public function GetEditDevice ($id) {

        $device = Devices::find($id);

        if ($device != ''){
            
            echo $id;
        } else {
            return redirect('admin/device/list')->with('Notify', 'You not permission');
        }
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

    public function GetDeleteDevice($id)
    {
        $device = Devices::find($id);
        if ($device != ''){
            $device ->delete();
             return redirect('admin/device/list')->with('Notify', 'Delete Successfully');
        } else {
            return redirect('admin/device/list')->with('Notify', 'You not permission');
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
        $d = random_int(10,99);
        $str = 'us'.$d;

        // $users = Donthuoc::all();

        // $users = DB::table('users')->get();
        // $users = DB::table('users')->where('iduserhw','US01HW01')->first();
        // $users = DB::table('users')->where('iduserhw','US01HW01')->first();


        // var_dump($users);
        // echo $d ;
        return response($str);
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

    public function PostListSokhambenh(Request $request)
    {
        if (Auth::check()) {

            $json = $request->all();

            $id = $json['id'];

            // $users = User::find($id)->sokhambenh->toJson();
            $users = Sokhambenh::where('id_user',$id)->get();

            return response($users);

        } else {
            return view('pages.users.login');
        }
    }

    // =========================================================
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

    // =========================================================

    public function GetRegister()
    {
        return view('pages.users.register');
    }

    // =========================================================
    public function PostRegister(Request $request)
    {

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
                'txtEmail.unique' => 'Email đã tồn tại'
            ]
        );

        $this->validate(
            $request,
            [
                'number' => 'required|min:8|max:15|unique:users,number'
            ],
            [
                'number.required' => ' Bạn chưa nhập số điện thoại',
                'number.min' => 'Bạn chưa nhập số điện thoại',
                'number.unique' => 'số đt đã tồn tại đã tồn tại'
            ]
        );

        // =========================================================


        // $newuser = new User;
        // $newuser->id_userhw = 'us00hw00';
        // $newuser->name = $request->txtUser;
        // $newuser->password = bcrypt($request->txtPass);
        // $newuser->email = $request->txtEmail;
        // $newuser->number = $request->number;
        // $newuser->level = $request['option'];

        // $newuser->active = 'false';
        // $newuser->key_active = $key ;
        // $newuser->user_enable = null;

        // =========================================================
        
        $key = Str::random(5); 
        $data = ['key' => $key ];
        dispatch(new \App\Jobs\JobMail($data));

        // =========================================================
           
        // Mail::send(
        //     'pages.mail.blanks', // view gửi mail
        //     $data,
        //     function($m) use ($request) {
        //         $m->to($request->txtEmail, 'Visitor')->subject('KEY ACTIVE'); 
        //     }
        // );

        // =========================================================
        
        return view('pages.users.keycheck', $data);
        
        // return response()->json($request);
        // return redirect('home');
    }

    public function PostRegisterCheck(Request $request)
    {
        $newuser = new User;
        $data = $request->all();

        $r = random_int(10,999);
        $str = 'us'.$r.'hw'.$r;

        $newuser->id_device =  NULL;
        $newuser->id_userhw =   $str;
        $newuser->name =        $data['name'];
        $newuser->number =      $data['number'];
        $newuser->password =    bcrypt($data['pass']);
        $newuser->email =       $data['email'];
        $newuser->level =       $data['option'];
        $newuser->user_enable = null;
        $newuser->save();
        
        return response()->json("ok"); 
        // return redirect('home');
    }


    // =========================================================
    public function GetLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    // =========================================================
    // kê đơn
    public function GetKedon()
    {
        if (Auth::check()) {
            return view('pages.users.kedon.kedon');
        } else {
            return view('pages.users.login');
        }
    }

    // =========================================================
    public function GetShareInfo()
    {
        if (Auth::check()) {
            return view('pages.users.share.share');
        } else {
            return view('pages.users.login');
        }
    }

    // =========================================================
    public function GetEditAcc()
    {
        if (Auth::check()) {
            return view('pages.users.editacc.editacc');

        } else {
            return view('pages.users.login');
        }

    }

    public function PostEditAcc(Request $request)
    {
        if (Auth::check()) {
            
            $data = $request->all();
            
            $user = User::find($data['id']);

            $user->name = $data['name'];
            // $user->email = $data['email'] ;
            $user->password = bcrypt($data['pass']);
            $user->id_userhw = $data['idhw'];

        
            $user->save();
            
            return response()->json($user['id_userhw']);
        } else {
            return view('pages.users.login');
        }

    }

    public function PostCheckKey(Request $request)
    {
        if (Auth::check()) {
            
            $data = $request->all();            
            $user = User::find($data['id']);

            if ($user['key_active'] == $data['key_active'] ){
                $user->active = 'true';
                $user->save();
                return response($user);
            }
            
        } else {
            return view('pages.users.login');
        }

    }

    public function TestSendMail() {
        $data = [
            'key' => '12345@itc'
        ];

        Mail::send(
            'pages.mail.blanks', 
            $data,
            function($message) {
                $message->to('phamhieu078@gmail.com', 'key');
                $message->subject('Visitor Feedback!'); 
            }
        );

    }
     // =========================================================

     public function GetMainTab() {
        return view('pages.users.home.maintab');
     }

    public function GetInputIdDevice() {
        return view('pages.users.home.innputiddevice');
    }

    public function PostIdDevice(Request $request) {

        if (Auth::check()) {
            $data = $request->all();
            $id = $data['id'];
            $id_device = $data['id_device'];

            $flight = User::find($id);
            $flight->id_device = $id_device;
            $flight->save();
            
            return response($flight);
        } else {
            return view('pages.users.login');
        }
    
    }

    public function GetInputMember(){
        return view('pages.users.home.inputmember');
    }

    public function PostMemeber(Request $request) {

        if (Auth::check()) {

            $data = $request->all();
            $newmember = new Member;
            $r = random_int(10,999);
            // $str = 'us'.$r.'hw'.$r;
           
            $id = $data['id'];

            $newmember->id_device = $data['id_device'];
            $newmember->id_userhw = $data['id_userhw'];
            
            $newmember->id_member = $data['id_userhw'].'mb'.$r;
            $newmember->name = $data['nameMember'];

            $newmember->save();
        
            // $query = Member::where('id_userhw','us07hw07')->get();

            // $r = random_int(10,999);
            // $str = 'us'.$r.'hw'.$r;
            
            // $newmember = new Member;
            // $newmember->

            // return response($data);
            return response()->json("ok");

        } else {
            return view('pages.users.login');
        }
    
    }

    public function PostListMember(Request $request){
        if (Auth::check()) {

            $json = $request->all();

            $id_userhw = $json['id_userhw'];

            $query = Member::where('id_userhw',$id_userhw)->get();
        
            return response($query);
        } else {
            return view('pages.users.login');
        }
    }

    public function PostRemoveMember(Request $request){

        if (Auth::check()) {

            $json = $request->all();
            $id_member = $json['id_member'];

            $value = Member::where('id_member',$id_member)->get();

            if (count($value) == 0 ) {
                return response()->json('fail');
            } else {
                $query = Member::where('id_member',$id_member);
                $query->delete();
                return response()->json('ok');
            }            

        } else {
            return view('pages.users.login');
        }
    }

}
