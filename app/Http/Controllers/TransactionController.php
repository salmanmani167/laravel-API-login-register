<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with(['user', 'stock'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::find($request->stock_id);
        $price = $stock->close; // Assuming buying at closing price

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'stock_id' => $request->stock_id,
            'quantity' => $request->quantity,
            'price' => $price,
        ]);

        return response()->json($transaction, 201);
    }
}

