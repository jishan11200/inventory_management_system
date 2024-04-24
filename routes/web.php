<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Employee Routes are here.......
Route::get('/add-employee',[App\Http\Controllers\EmployeeController::class, 'index'])->name('add.employee');
Route::post('/insert-employee',[App\Http\Controllers\EmployeeController::class, 'store']);
Route::get('/all-employees',[App\Http\Controllers\EmployeeController::class, 'employees'])->name('all.employee');
Route::get('/view-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'viewEmployee']);
Route::get('/delete-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'deleteEmployee']);
Route::get('/edit-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'editEmployee']);
Route::post('/update-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'updateEmployee']);


//Customer Routes are here.......
Route::get('/add-customer',[App\Http\Controllers\CustomerController::class, 'index'])->name('add.customer');
Route::post('/insert-customer',[App\Http\Controllers\CustomerController::class, 'store']);
Route::get('/all-customer',[App\Http\Controllers\CustomerController::class, 'customers'])->name('all.customer');
Route::get('/view-customer/{id}',[App\Http\Controllers\CustomerController::class, 'viewCustomer']);
Route::get('/delete-customer/{id}',[App\Http\Controllers\CustomerController::class, 'deleteCustomer']);
Route::get('/edit-customer/{id}',[App\Http\Controllers\CustomerController::class, 'editCustomer']);
Route::post('/update-customer/{id}',[App\Http\Controllers\CustomerController::class, 'updateCustomer']);



//Supplier Routes are Here......
Route::get('/add-supplier',[App\Http\Controllers\SupplierController::class, 'index'])->name('add.supplier');
Route::post('/insert-supplier',[App\Http\Controllers\SupplierController::class, 'store']);
Route::get('/all-supplier',[App\Http\Controllers\SupplierController::class, 'suppliers'])->name('all.supplier');
Route::get('/view-supplier/{id}',[App\Http\Controllers\SupplierController::class, 'viewSupplier']);
Route::get('/delete-supplier/{id}',[App\Http\Controllers\SupplierController::class, 'deleteSupplier']);
Route::get('/edit-supplier/{id}',[App\Http\Controllers\SupplierController::class, 'editSupplier']);
Route::post('/update-supplier/{id}',[App\Http\Controllers\SupplierController::class, 'updateSupplier']);


//Salary Routes are here........
Route::get('/add-advanced-salary',[App\Http\Controllers\SalaryController::class, 'advancedSalary'])->name('add.advancedSalary');
Route::post('/insert-advanced-salary',[App\Http\Controllers\SalaryController::class, 'insertAdvanced']);
Route::get('/all-advanced-salary',[App\Http\Controllers\SalaryController::class, 'allAdvancedSalary'])->name('all.advancedSalary');
Route::get('/pay-salary',[App\Http\Controllers\SalaryController::class, 'paySalary'])->name('pay.salary');

//Category Routes are here......
Route::get('/add-category',[App\Http\Controllers\SalaryController::class, 'addCategory'])->name('add.category');
Route::post('/insert-category',[App\Http\Controllers\SalaryController::class, 'insertCategory']);
Route::get('/all-category',[App\Http\Controllers\SalaryController::class, 'allCategory'])->name('all.category');
Route::get('/delete-category/{id}',[App\Http\Controllers\SalaryController::class, 'deleteCategory']);
Route::get('/edit-category/{id}',[App\Http\Controllers\SalaryController::class, 'editCategory']);
Route::post('/update-category/{id}',[App\Http\Controllers\SalaryController::class, 'updateCategory']);


//Product Routes are here......
Route::get('/add-product',[App\Http\Controllers\ProductController::class, 'addProduct'])->name('add.product');
Route::post('/insert-product',[App\Http\Controllers\ProductController::class, 'insertProduct']);
Route::get('/all-product',[App\Http\Controllers\ProductController::class, 'allProduct'])->name('all.product');
Route::get('/view-product/{id}',[App\Http\Controllers\ProductController::class, 'viewProduct']);
Route::get('/delete-product/{id}',[App\Http\Controllers\ProductController::class, 'deleteProduct']);
Route::get('/edit-product/{id}',[App\Http\Controllers\ProductController::class, 'editProduct']);
Route::post('/update-product/{id}',[App\Http\Controllers\ProductController::class, 'updateProduct']);


//Expenses Routes are here......
Route::get('/add-expense',[App\Http\Controllers\ExpenseController::class, 'addExpense'])->name('add.expense');
Route::post('/insert-expense',[App\Http\Controllers\ExpenseController::class, 'insertExpense']);
Route::get('/today-expense',[App\Http\Controllers\ExpenseController::class, 'todayExpense'])->name('today.expense');
Route::get('/delete-expense/{id}',[App\Http\Controllers\ExpenseController::class, 'deleteExpense']);
Route::get('/edit-today/{id}',[App\Http\Controllers\ExpenseController::class, 'editToday']);
Route::post('/update-today/{id}',[App\Http\Controllers\ExpenseController::class, 'updateToday']);
Route::get('/monthly-expense',[App\Http\Controllers\ExpenseController::class, 'monthlyExpense'])->name('month.expense');
Route::get('/yearly-expense',[App\Http\Controllers\ExpenseController::class, 'yearlyExpense'])->name('year.expense');

//Monlthly More Expenses
Route::get('/january-expense',[App\Http\Controllers\ExpenseController::class, 'januaryExpense'])->name('january.expense');
Route::get('/february-expense',[App\Http\Controllers\ExpenseController::class, 'februaryExpense'])->name('february.expense');
Route::get('/march-expense',[App\Http\Controllers\ExpenseController::class, 'marchExpense'])->name('march.expense');
Route::get('/april-expense',[App\Http\Controllers\ExpenseController::class, 'aprilExpense'])->name('april.expense');
Route::get('/may-expense',[App\Http\Controllers\ExpenseController::class, 'mayExpense'])->name('may.expense');
Route::get('/june-expense',[App\Http\Controllers\ExpenseController::class, 'juneExpense'])->name('june.expense');
Route::get('/july-expense',[App\Http\Controllers\ExpenseController::class, 'julyExpense'])->name('july.expense');
Route::get('/august-expense',[App\Http\Controllers\ExpenseController::class, 'augustExpense'])->name('august.expense');
Route::get('/september-expense',[App\Http\Controllers\ExpenseController::class, 'septemberExpense'])->name('september.expense');
Route::get('/october-expense',[App\Http\Controllers\ExpenseController::class, 'octoberExpense'])->name('october.expense');
Route::get('/november-expense',[App\Http\Controllers\ExpenseController::class, 'novemberExpense'])->name('november.expense');
Route::get('/december-expense',[App\Http\Controllers\ExpenseController::class, 'decemberExpense'])->name('december.expense');


//Attendance routes are here.......
Route::get('/take-attendance',[App\Http\Controllers\AttendanceController::class, 'takeAttendance'])->name('take.attendance');
Route::post('/insert-attendance',[App\Http\Controllers\AttendanceController::class, 'insertAttendance']);
Route::get('/all-attendance',[App\Http\Controllers\AttendanceController::class, 'allAttendance'])->name('all.attendance');
