<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

// use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('login', function () {
    if(Auth::check()){
        return redirect()->route('index');
    }
    return view('login');
})->name('login');
//reset password
Route::get('reset-password',function(){
    if(Auth::check()){
        return redirect()->route('index');
    }
    return view('repass');
})->name('repass');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );
    // dd($status);
    return $status === Password::RESET_LINK_SENT
                ? view('noti',['content' => '<center><h2>Một email đặt lại mật khẩu đã được gửi đến hộp thư của bạn kiểm tra hộp thư và đặt lại mật khẩu</h2></center><script>setTimeout(()=>{location.href="'.route('login').'";},3000)</script>'])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );
    // dd($request->only('email', 'password', 'password_confirmation', 'token'));
    // dd(Password::PASSWORD_RESET);
    return $status === Password::PASSWORD_RESET
                ? view('noti',['content' => '<center><h2>Cập nhật mật khẩu thành công</h2></center><script>setTimeout(()=>{location.href="'.route('login').'";},3000)</script>'])
                : view('noti',['content' => '<center><h2 style="color:red">Hệ thống bị lỗi</h2></center><script>setTimeout(()=>{location.href="'.route('login').'";},3000)</script>']);
})->middleware('guest')->name('password.update');

Route::get('generation',[App\Http\Controllers\GenerationBarcode::class, 'Generation'])->name('generation');
Route::post('register',[App\Http\Controllers\Usercontroller::class, 'register'])->name('register');
Route::post('loginpost',[App\Http\Controllers\Usercontroller::class, 'login'])->name('loginpost');
Route::post('loginpost-face',[App\Http\Controllers\Usercontroller::class, 'loginFace'])->name('loginpostface');
Route::post('covid-api',[App\Http\Controllers\HomeController::class, 'covid_api'])->name('covid_api');







Route::group(['middleware' => ['auth']], function () { 
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('index');
    })->name('logout');
    Route::get('profile/{id}',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/{id}',[App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('upload',[App\Http\Controllers\ProfileController::class, 'avatar'])->name('avatar');
    Route::get('contact',[App\Http\Controllers\Usercontroller::class, 'contact'])->name('contact');

    //make quếtion 
    Route::resource('student','\App\Http\Controllers\StudentController');
    Route::resource('answer','\App\Http\Controllers\AnswerController');
    Route::resource('result' , '\App\Http\Controllers\ResultController');

    Route::get('face-recogn-index',[App\Http\Controllers\FaceRecognModelController::class, 'index'])->name('face.index');
    Route::post('face-recogn-post',[App\Http\Controllers\FaceRecognModelController::class, 'post'])->name('face.post');
    Route::post('face-recogn-detect',[App\Http\Controllers\FaceRecognModelController::class, 'detect'])->name('face.detect');
    Route::get('face-recogn-create-person',[App\Http\Controllers\FaceRecognModelController::class, 'create_person'])->name('face.createper');
    Route::post('face-recogn-create-person-post',[App\Http\Controllers\FaceRecognModelController::class, 'create_person_post'])->name('face.postper');


    Route::middleware(['CheckisAdmin'])->group(function(){
        Route::get('account',[App\Http\Controllers\Usercontroller::class, 'list'])->name('account.list');
        Route::post('account/getphongban',[App\Http\Controllers\Usercontroller::class, 'GetPhongBanWithChucVu'])->name('account.getpb');
        Route::post('account/getchucvu',[App\Http\Controllers\Usercontroller::class, 'GetChucVu'])->name('account.getcv');
        Route::post('account/getpb',[App\Http\Controllers\Usercontroller::class, 'GetPhongBan'])->name('account.getpbid');
        Route::post('account/active',[App\Http\Controllers\Usercontroller::class, 'ActiveUser'])->name('account.activeuser');

        Route::get('chucvu',[App\Http\Controllers\ChucvuController::class, 'list'])->name('chucvu.list');
        Route::post('chucvu/add',[App\Http\Controllers\ChucvuController::class, 'add'])->name('chucvu.add');
        Route::post('chucvu/edit',[App\Http\Controllers\ChucvuController::class, 'edit'])->name('chucvu.edit');
        Route::post('chucvu/delete',[App\Http\Controllers\ChucvuController::class, 'delete'])->name('chucvu.delete');

        Route::get('phongban',[App\Http\Controllers\PhongbanController::class, 'list'])->name('phongban.list');
        Route::post('phongban/add',[App\Http\Controllers\PhongbanController::class, 'add'])->name('phongban.add');
        Route::post('phongban/edit',[App\Http\Controllers\PhongbanController::class, 'edit'])->name('phongban.edit');
        Route::post('phongban/delete',[App\Http\Controllers\PhongbanController::class, 'delete'])->name('phongban.delete');
        Route::post('phongban/getcolor',[App\Http\Controllers\PhongbanController::class, 'GetColor'])->name('phongban.getcolor');

        Route::get('salaries',[App\Http\Controllers\SalaryController::class, 'list'])->name('salaries.list');
        Route::post('salaries/add',[App\Http\Controllers\SalaryController::class, 'add'])->name('salaries.add');
        Route::post('salaries/edit',[App\Http\Controllers\SalaryController::class, 'edit'])->name('salaries.edit');
        Route::post('salaries/delete',[App\Http\Controllers\SalaryController::class, 'delete'])->name('salaries.delete');
        Route::post('salaries/NotiSalary',[App\Http\Controllers\SalaryController::class, 'NotiSalary'])->name('salaries.noti');
        Route::post('salaries/NotiSalaryPhone',[App\Http\Controllers\SalaryController::class, 'NotiSalaryPhone'])->name('salaries.notiphone');
        

        Route::get('phucap',[App\Http\Controllers\PhucapController::class, 'list'])->name('phucap.list');
        Route::post('phucap/add',[App\Http\Controllers\PhucapController::class, 'add'])->name('phucap.add');
        Route::post('phucap/edit',[App\Http\Controllers\PhucapController::class, 'edit'])->name('phucap.edit');
        Route::post('phucap/delete',[App\Http\Controllers\PhucapController::class, 'delete'])->name('phucap.delete');
        Route::post('phucap/NotiSalary',[App\Http\Controllers\PhucapController::class, 'NotiSalary'])->name('phucap.noti');
        Route::post('phucap/NotiSalaryPhone',[App\Http\Controllers\PhucapController::class, 'NotiSalaryPhone'])->name('phucap.notiphone');
        Route::post('phucap/getSalary',[App\Http\Controllers\PhucapController::class, 'GetSalary'])->name('phucap.getwithpbcv');

        Route::get('phucapother',[App\Http\Controllers\LsSalaryOtherController::class, 'list'])->name('phucapother.list');
        Route::post('phucapother/add',[App\Http\Controllers\LsSalaryOtherController::class, 'add'])->name('phucapother.add');
        Route::post('phucapother/edit',[App\Http\Controllers\LsSalaryOtherController::class, 'edit'])->name('phucapother.edit');
        Route::post('phucapother/delete',[App\Http\Controllers\LsSalaryOtherController::class, 'delete'])->name('phucapother.delete');
        // Route::post('phucapother/NotiSalary',[App\Http\Controllers\PhucapController::class, 'NotiSalary'])->name('phucapother.noti');
        // Route::post('phucap/NotiSalaryPhone',[App\Http\Controllers\PhucapController::class, 'NotiSalaryPhone'])->name('phucap.notiphone');

        //report salary
        Route::get('salary-report',[App\Http\Controllers\SalaryReportController::class, 'index'])->name('salaryreport.index');
        Route::get('salary-report-all',[App\Http\Controllers\SalaryCalculatorController::class, 'getAll'])->name('salaryreport.getAll');
        Route::get('salary-report-with-time',[App\Http\Controllers\SalaryCalculatorController::class, 'get'])->name('salaryreport.getAtTime');

        // calculator save 
        Route::post('salary-cal-save',[App\Http\Controllers\SalaryCalculatorController::class, 'save'])->name('salarycal.save');
        Route::post('salary-cal-datele',[App\Http\Controllers\SalaryCalculatorController::class, 'delete'])->name('salarycal.datele');
        Route::post('salary-cal-sms',[App\Http\Controllers\SalaryCalculatorController::class, 'sendSms'])->name('salarycal.sendSms');
        Route::post('salary-cal-email',[App\Http\Controllers\SalaryCalculatorController::class, 'sendEmail'])->name('salarycal.sendEmail');

        // Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('examinfo','\App\Http\Controllers\ExaminfoController');
        Route::resource('makequestion' , '\App\Http\Controllers\QuestionController');

        // note calendar  
        Route::post('calendar-save',[App\Http\Controllers\CalendarController::class, 'save'])->name('calendar.save');
        Route::post('calendar-dalete',[App\Http\Controllers\CalendarController::class, 'delete'])->name('calendar.delete');
        Route::post('calendar-update',[App\Http\Controllers\CalendarController::class, 'update'])->name('calendar.update');
        Route::get('calendar-list',[App\Http\Controllers\CalendarController::class, 'list'])->name('calendar.list');
        Route::get('calendar-edit',[App\Http\Controllers\CalendarController::class, 'edit'])->name('calendar.edit');


        

        Route::get('getsession', function (Request $request) {
            dd($request->session()->all());
        });
    });
});
Route::get('testcontroller' , [App\Http\Controllers\TestController::class, 'demo']);
Route::get('face/{username}' , [App\Http\Controllers\TestController::class, 'face']);