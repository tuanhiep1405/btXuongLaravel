<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

//CÂU 1
Route::get('cau1', function () {
    $sale = DB::table('sales')
        ->select(
            DB::raw('SUM(total) as total_sales'),
            DB::raw('MONTH(sale_date) as month'),
            DB::raw('YEAR(sale_date) as year')

        )
        ->groupBy(
            DB::raw('MONTH(sale_date)'),
            DB::raw('YEAR(sale_date)')
        )
        ->get();
    dd($sale);
});

//Câu 2

Route::get('cau2', function () {

    $expense = DB::table('expenses')
        ->select(
            DB::raw('SUM(amount) as total_expenses'),
            DB::raw('MONTH(expense_date) as month'),
            DB::raw('YEAR(expense_date) as year')
        )
        ->groupBy(
            DB::raw('MONTH(expense_date) '),
            DB::raw('YEAR(expense_date) ')
        )
        ->get();
    dd($expense);
});

//cau 3

Route::get('cau3', function () {
    //tính tổng doanh thu cho tháng 9 năm 2024.
    $totalSales = DB::table('sales')
        ->whereMonth('sale_date', 9) //cái này là lọc theo thánh 9 
        ->whereYear('sale_date', 2024) //cái này là lọc theo năm 2024
        ->sum('total');

    //cái này là để tính tổng chi phí amount trong tháng 9 -2024
    $totalExpenses = DB::table('expenses')
        ->whereMonth('expense_date', 9)
        ->whereYear('expense_date', 2024)
        ->sum('amount');

    // truy vấn bảng taxes với điều kiện tên thuế là VAT
    $taxRate = DB::table('taxes')
        ->where('tax_name', 'VAT')
        ->value('rate');

    $profitBeforeTax = $totalSales * $taxRate; // lợi nhuận trước thuế 
    $taxAmount = $profitBeforeTax * 0.1; //  số thuế phải trả 
    $profitAfterTax = $profitBeforeTax - $taxAmount; // lợi nhuận sau thuế

    // dd($profitAfterTax);

    // Thực hiện insert với các giá trị đã tính toán
    DB::table('financial_reports')->insert([
        'month' => 9,
        'year' => 2024,
        'total_sales' => $totalSales,
        'total_expenses' => $totalExpenses,
        'profit_before_tax' => $profitBeforeTax, //giá trị e tính ra to hơn so với decimal(10,2) nên em thay thành decimal(15,2)
        'tax_amount' => $taxAmount,
        'profit_after_tax' => $profitAfterTax, //giá trị e tính ra to hơn so với decimal(10,2) nên em thay thành decimal(15,2)
    ]);
});

Route::resource('employees', EmployeeController::class);

Route::delete('emloyees/{emloyee}/forceDestroy', [EmployeeController::class, 'forceDestroy'])
    ->name('emloyees.forceDestroy');


    //Bài 1
Route::get('/movies', function () {

    echo 'Mời bạn chải nghiệm';
})->middleware(middleware: 'check.age');


//bài 2
// Route dành cho admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Quyền truy cập của admin đã được cấp';
    });
});

// Route dành cho nhân viên
Route::middleware(['role:nhanvien'])->group(function () {
    Route::get('/orders', function () {
        return 'Đã cấp quyền truy cập quản lý orders';
    });
});

// Route dành cho khách hàng
Route::middleware(['role:khachhang'])->group(function () {
    Route::get('/profile', function () {
        return 'Đã cấp quyền Customer truy cập hồ sơ';
    });
});

//bài 3

//route đăng kí

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);


//route đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        
        return view('auth.dashboard');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
