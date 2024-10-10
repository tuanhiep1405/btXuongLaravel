<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTransactionStep
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra nếu người dùng có giao dịch trong session
        if (Session::has('step')) {
            $step = Session::get('step');

            // Nếu bước là 1, chuyển hướng đến trang xác nhận giao dịch
            if ($step == 1) {
                return redirect()->route('thanhtoan');

            }

            // Nếu bước là 2, chuyển hướng đến trang hoàn tất giao dịch
            if ($step == 2) {
                return redirect()->route('xacthuc');

            }
        }

        return $next($request);
    }
}
