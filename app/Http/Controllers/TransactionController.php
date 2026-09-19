<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function show(string $invoiceId)
    {
        $transaction = Transaction::where('invoice_id', $invoiceId)->firstOrFail();

        return view('transaction.show', compact('transaction'));
    }
}
