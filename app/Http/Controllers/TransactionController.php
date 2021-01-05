<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\HeaderTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function viewSuccess() {
        return view('success');
    }

    public function view() {
        $user = Auth::user();
        $transactions = $user->transactions;
        $totals = [];
        foreach ($transactions as $transaction) {
            $total = 0;
            foreach ($transaction->details as $detail) {
                $total += $detail->product->price * $detail->quantity;
            }
            $totals[] = $total;
        }

        return view('transactions', [
            'transactions' => $transactions,
            'totals' => $totals
        ]);
    }

    public function checkout() {
        $user = Auth::user();
        $carts = $user->carts;

        $transaction = new HeaderTransaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_date = Carbon::now();
        $transaction->save();

        foreach ($carts as $cart) {
            $detail = new DetailTransaction();
            $detail->quantity = $cart->quantity;
            $detail->header_transaction_id = $transaction->id;
            $detail->product_id = $cart->product_id;
            $detail->save();
            $cart->delete();
        }

        return redirect()->route('success');
    }
}
