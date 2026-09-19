<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function show(string $invoiceId)
    {
        $transaction = Transaction::where('invoice_id', $invoiceId)->firstOrFail();

        return Inertia::render('Transaction/Show', compact('transaction'));
    }
}
