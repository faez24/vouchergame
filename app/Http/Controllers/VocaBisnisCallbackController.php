<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VocaBisnisCallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->header('X-Callback-Key') !== config('services.vocabisnis.callback_key')) {
            return response()->json(['message' => 'Invalid callback key'], Response::HTTP_UNAUTHORIZED);
        }

        $payload = $request->validate([
            'reference' => ['required', 'string'],
            'status' => ['required', 'string'],
            'productName' => ['nullable', 'string'],
            'productItemName' => ['nullable', 'string'],
            'data' => ['nullable', 'array'],
            'sn' => ['nullable', 'string'],
        ]);

        $transaction = Transaction::where('reference', $payload['reference'])->first();

        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }

        $transaction->update([
            'status' => $payload['status'],
            'product_name' => $payload['productName'] ?? $transaction->product_name,
            'product_item_name' => $payload['productItemName'] ?? $transaction->product_item_name,
            'data' => $payload['data'] ?? $transaction->data,
            'sn' => $payload['sn'] ?? $transaction->sn,
        ]);

        return response()->json(['message' => 'OK']);
    }
}
