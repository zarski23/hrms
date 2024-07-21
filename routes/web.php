<?php

use App\Http\Controllers\Activity;
use App\Http\Controllers\AdminControllerEmployeeAccess;
use App\Http\Controllers\AdminControllerEmployeeCommunityTax;
use App\Http\Controllers\AdminControllerEmployeeProfile;
use App\Http\Controllers\AdminControllerEmployeeSalary;
use App\Http\Controllers\AdminControllerLeaveCredits;
use App\Http\Controllers\AdminControllerTravelOrder;
use App\Http\Controllers\AdminControllerOvertime;
use App\Http\Controllers\AdminControllerLeaveApplication;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminControllerHRForms;
use App\Http\Controllers\AdminControllerUserPermission;
use App\Http\Controllers\Signatories;
use App\Http\Controllers\PositionList;
use App\Http\Controllers\DepartmentList;
use App\Http\Controllers\DesignationList;
use App\Http\Controllers\Departments;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveCredits;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ShiftandSchedule;
use App\Http\Controllers\UserControllerDTR;
use App\Http\Controllers\UserControllerTravelOrder;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserManual;
use App\Http\Controllers\WorkingScheduleList;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('post',[HomeController::class,'post'])->middleware(['auth', 'admin']);


/** for side bar menu active */
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home',[HomeController::class,'index'])->middleware(['auth'])->name('home');


Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('post',[HomeController::class,'post']);
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------------- Employee Profile Information ------------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('profile_user', 'profile')->middleware('auth')->name('profile_user');
    Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');
    Route::post('employee/information/save', 'employeeInformationSave')->name('employee/information/save');
});

// ----------------------------- User userManagement -----------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('userManagement', 'index')->middleware('auth')->name('userManagement');   
    Route::post('add/new/employee', 'addNewEmployee')->middleware('auth')->name('add/new/employee');   
});

// ----------------------------- User Controller / My DTR -----------------------//
Route::controller(UserControllerDTR::class)->group(function () {
    Route::get('user/view/dtr', 'viewDTR')->middleware('auth')->name('user/view/dtr');   
    
});

// ----------------------------- User Controller / Travel Order -----------------------//
Route::controller(UserControllerTravelOrder::class)->group(function () {
    Route::get('user/travel/order', 'viewTravelOrder')->middleware('auth')->name('user/travel/order');   
    
});

// ----------------------------- Admin View / Employee Profile ------------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee/profile/{user_id}', 'profileEmployee')->middleware('auth')->name('employee/profile');
    
});

// ----------------------------- Admin Controller / Employee Profile ------------------------------//
Route::controller(AdminControllerEmployeeProfile::class)->group(function () {
    Route::get('all/employee/profile', 'viewAllEmployee')->middleware('auth')->name('all/employee/profile');
    Route::post('admin/employee/information/save', 'adminSaveEmployeeInformation')->middleware('auth')->name('admin/employee/information/save');
    Route::post('admin/employee/profile/information/save', 'adminSaveEmployeeProfile')->name('admin/employee/profile/information/save');
    Route::post('admin/edit/employee/profile', 'adminEditEmployeeProfile')->middleware('auth')->name('admin/edit/employee/profile');
});

// ----------------------------- Admin Controller / Employee Salary ------------------------------//
Route::controller(AdminControllerEmployeeSalary::class)->group(function () {
    Route::post('admin/employee/salary/save', 'adminSaveEmployeeSalary')->middleware('auth')->name('admin/employee/salary/save');
});

// ----------------------------- Admin Controller / Employee Community Tax ------------------------------//
Route::controller(AdminControllerEmployeeCommunityTax::class)->group(function () {
    Route::post('admin/employee/communityTax/save', 'adminSaveEmployeeCommunityTax')->middleware('auth')->name('admin/employee/communityTax/save');
});

// ----------------------------- Admin Controller / User Permission ------------------------------//
Route::controller(AdminControllerUserPermission::class)->group(function () {
    Route::get('all/user/permission', 'viewAllPermission')->middleware('auth')->name('all/user/permission');
    Route::post('all/user/permission/save', 'saveUserPermission')->middleware('auth')->name('all/user/permission/save');
    Route::get('employee/user/permission/delete/{user_id}', 'deleteUserPermission')->middleware('auth');
    Route::get('employee/user/permission/view/edit/{user_id}', 'viewEditUserPermission')->middleware('auth');
    Route::post('employee/user/permission/update', 'updateUserPermission')->middleware('auth')->name('employee/user/permission/update');
});

// ----------------------------- Admin Controller / Employee Accesss ------------------------------//
Route::controller(AdminControllerEmployeeAccess::class)->group(function () {
    Route::get('all/employee/access', 'accessAllEmployee')->middleware('auth')->name('all/employee/access');
    Route::post('all/access/save', 'saveAccess')->middleware('auth')->name('all/access/save');
    Route::get('employee/access/delete/{user_id}', 'deleteAccessRecord')->middleware('auth');
});


// ----------------------------- Admin Controller / Attendance ------------------------------//
Route::controller(AttendanceController::class)->group(function () {
    Route::get('attendance/report/page', 'viewAttendanceReport')->middleware('auth')->name('attendance/report/page');
    Route::post('upload/attendance/report', 'uploadAttendanceReport')->middleware('auth')->name('upload/attendance/report');
    Route::post('admin/edit/employee/attendance', 'editEmployeeAttendance')->middleware('auth')->name('admin/edit/employee/attendance');
});

// ----------------------------- Admin Controller / Payrol  ------------------------------//
Route::controller(PayrollController::class)->group(function () {
    Route::get('payroll/report/page', 'viewPayrollReport')->middleware('auth')->name('payroll/report/page');
    Route::post('generate/payroll', 'generatePayroll')->middleware('auth')->name('generate/payroll');
    Route::get('form/payroll/download/{date_from}/{date_to}', 'downloadPayrollReport')->middleware('auth');
    Route::get('payroll/records/page', 'viewPayrollRecord')->middleware('auth')->name('payroll/records/page');
});

// ----------------------------- Admin Controller / Travel Order -----------------------//
Route::controller(AdminControllerTravelOrder::class)->group(function () {
    Route::get('admin/travel/order', 'adminViewTravelOrder')->middleware('auth')->name('admin/travel/order');   
    
});

// ----------------------------- Admin Controller / Overtime -----------------------//
Route::controller(AdminControllerOvertime::class)->group(function () {
    Route::get('admin/overtime', 'adminViewOvertime')->middleware('auth')->name('admin/overtime');   
    
});

// ----------------------------- Admin Controller / Leave Application -----------------------//
Route::controller(AdminControllerLeaveApplication::class)->group(function () {
    Route::get('admin/leave/applications', 'adminViewLeaveApplication')->middleware('auth')->name('admin/leave/applications');   
    
});

// ----------------------------- Activity Logs / User Activities -----------------------//
Route::controller(Activity::class)->group(function () {
    Route::get('user/log', 'userLog')->middleware('auth')->name('user/log');
    Route::get('user/activity', 'activityLog')->middleware('auth')->name('user/activity');
});

// ----------------------------- Admin Controller / HR Forms -----------------------//
Route::controller(AdminControllerHRForms::class)->group(function () {
    Route::get('admin/travelorder/form', 'adminOvertimeForm')->middleware('auth')->name('admin/travelorder/form');   
    Route::get('form/travel/order/print', 'adminOvertimeFormPrint')->middleware('auth')->name('form/travel/order/print');   
});

// ----------------------------- Signatories List -----------------------//
Route::controller(Signatories::class)->group(function () {
    Route::get('view/signatories', 'viewSignatories')->middleware('auth')->name('view/signatories');
    Route::post('admin/add/signatories', 'addSignatories')->middleware('auth')->name('admin/add/signatories');
    Route::post('admin/edit/signatories', 'editSignatories')->middleware('auth')->name('admin/edit/signatories');
}); 

// ----------------------------- Position List -----------------------//
Route::controller(PositionList::class)->group(function () {
    Route::get('view/positions', 'viewPositions')->middleware('auth')->name('view/positions');
    Route::post('admin/add/position', 'addPositions')->middleware('auth')->name('admin/add/position');
    Route::post('admin/edit/position', 'editPositions')->middleware('auth')->name('admin/edit/position');
}); 

// ----------------------------- Department List -----------------------//
Route::controller(DepartmentList::class)->group(function () {
    Route::get('view/departments', 'viewDepartments')->middleware('auth')->name('view/departments');
    Route::post('admin/add/department', 'addDepartments')->middleware('auth')->name('admin/add/department');
    Route::post('admin/edit/department', 'editDepartments')->middleware('auth')->name('admin/edit/department');
}); 

// ----------------------------- Designation List -----------------------//
Route::controller(DesignationList::class)->group(function () {
    Route::get('view/designations', 'viewDesignations')->middleware('auth')->name('view/designations');
    Route::post('admin/add/designation', 'addDesignations')->middleware('auth')->name('admin/add/designation');
    Route::post('admin/edit/designation', 'editDesignations')->middleware('auth')->name('admin/edit/designation');
}); 

// ----------------------------- Working Schedule List -----------------------//
Route::controller(WorkingScheduleList::class)->group(function () {
    Route::get('view/working/schedule', 'viewWorkingSchedules')->middleware('auth')->name('view/working/schedule');
    Route::post('admin/add/work/schedule/list', 'addWorkScheduleList')->middleware('auth')->name('admin/add/work/schedule/list');
}); 


// ----------------------------- Shift and Schedule -----------------------//
Route::controller(ShiftandSchedule::class)->group(function () {
    Route::get('view/schedules', 'viewSchedules')->middleware('auth')->name('view/schedules');
    Route::post('admin/update/work/schedule', 'updateWorkSchedule')->middleware('auth')->name('admin/update/work/schedule');
});

// ----------------------------- Leave Credits -----------------------//
Route::controller(AdminControllerLeaveCredits::class)->group(function () {
    Route::get('view/leave/credits', 'leaveCredits_getNames')->middleware('auth')->name('view/leave/credits');
    Route::get('view/employee/leave/credits/{employeeid}', 'viewEmployeeLeaveCredits')->middleware('auth')->name('view/employee/leave/credits');
    Route::post('admin/add/table/row', 'adminAddTableRow')->middleware('auth')->name('admin/add/table/row');
    Route::post('admin/add/leave/credits/beginning/balance', 'adminAddLeaveCreditsBeginningBalance')->middleware('auth')->name('admin/add/leave/credits/beginning/balance');
});

// ----------------------------- Leave Credits -----------------------//
// Route::controller(LeaveCredits::class)->group(function () {
//     Route::get('view/leave/credits', 'viewLeaveCredits')->middleware('auth')->name('view/leave/credits');
// });


// ----------------------------- Help | User Manual -----------------------//
Route::controller(UserManual::class)->group(function () {
    Route::get('help/user/manual', 'viewUserManual')->name('help/user/manual');
});


require __DIR__.'/auth.php'; //passing thru routes/auth
