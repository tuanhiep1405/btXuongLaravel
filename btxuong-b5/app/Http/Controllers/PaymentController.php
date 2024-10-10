<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Bắt đầu giao dịch
    public function startTransaction(Request $request)
    {
        // Lưu thông tin giao dịch vào session
        session([
            'transaction_id' => uniqid(),
            'amount' => $request->input('amount'),
            'recipient_account' => $request->input('recipient_account'),
            'step' => 1 
        ]);

        // Chuyển hướng đến trang xác nhận giao dịch
        session()->flash('message', 'Giao dịch bắt đầu.');
        session()->flash('alert-class', 'alert-primary');
        return redirect()->route('transaction.show');
    }

    // Xác nhận giao dịch
    public function confirmTransaction(Request $request)
    {
        // Kiểm tra xem session có chứa dữ liệu giao dịch không
        if (!session()->has('transaction_id')) {
            return redirect()->route('transaction.start')->with('message', 'Không có giao dịch nào để xác nhận.');
        }

        // Lấy dữ liệu giao dịch từ session
        $transaction_id = session('transaction_id');
        $amount = session('amount');
        $recipient_account = session('recipient_account');

        // Lưu giao dịch vào cơ sở dữ liệu
        $transaction = Transaction::create([
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'recipient_account' => $recipient_account,
            'confirmation_code' => $request->input('confirmation_code'), // Mã xác nhận
            'step' => 2  // Bước thứ hai: xác nhận giao dịch
        ]);

        // Cập nhật bước hiện tại trong session
        session(['step' => 2]);
        session()->flash('message', 'Thanh toán thành công mời thực hiện giao dịch tiếp theo.');
        session()->flash('alert-class', 'alert-primary');
        // Chuyển hướng tới trang hoàn thành
        return redirect()->route('transaction.completed');
    }



    // Khôi phục giao dịch từ database
    public function resumeTransaction($transaction_id)
    {
        // Tìm giao dịch theo mã giao dịch
        $transaction = Transaction::where('transaction_id', $transaction_id)->first();

        if ($transaction) {
            return response()->json([
                'message' => 'Khôi phục giao dịch thành công.',
                'transaction' => $transaction
            ]);
        } else {
            return response()->json(['error' => 'Không có giao dịch nào để khôi phục.'], 404);
        }
    }



    // Hủy giao dịch
    public function cancelTransaction()
    {
        // Xóa toàn bộ dữ liệu giao dịch khỏi session
        session()->forget(['transaction_id', 'amount', 'recipient_account', 'step']);
        session()->flash('message', 'Giao dịch đã bị hủy.');
        session()->flash('alert-class', 'alert-danger');
        return redirect()->route('transaction.start');
    }

    public function showCompletedTransaction()
    {
        
        // Xóa toàn bộ dữ liệu sau khi hoàn thành
        session()->forget(['transaction_id', 'amount', 'recipient_account', 'step']);
        return view('thanhcong');
    }

    public function showStartTransactionForm()
{
    // Kiểm tra nếu có giao dịch trong session và kiểm tra bước
    if (session()->has('step')) {
        $step = session('step');

        // Nếu bước là 1, chuyển hướng tới trang xác nhận
        if ($step == 1) {
            return redirect()->route('transaction.show');
        }

        // Nếu bước là 2, chuyển hướng tới trang hoàn tất giao dịch
        if ($step == 2) {
            return redirect()->route('transaction.completed');
        }
    }

    // Nếu không có giao dịch, hiển thị form bắt đầu giao dịch
    return view('payment');
}

    public function showConfirmTransactionForm()
{
    // Kiểm tra nếu có giao dịch trong session và kiểm tra bước
    if (session()->has('step')) {
        $step = session('step');

        // Nếu bước là 2 (đã xác nhận), chuyển hướng tới trang hoàn tất
        if ($step == 2) {
            return redirect()->route('transaction.completed');
        }
    } else {
        // Nếu không có giao dịch nào, quay lại trang bắt đầu
        return redirect()->route('transaction.start')->with('message', 'Không có giao dịch nào đang diễn ra.');
    }
    return view('xacthuc');

 
}


}
