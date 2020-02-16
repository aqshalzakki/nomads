<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;

use App\Transaction;
use App\TransactionStatus as Status;

class TransactionController extends Controller
{
    /**
     * create empty instance of transaction model
     *
     * @return object
     */
    protected $transaction;
    public function __construct()
    {
        $this->transaction = new Transaction;
    }

    public function index()
    {
        $transactions = $this->transaction->withRelationships();

        return request()->isJson() ? view('admin.transactions.card', compact('transactions'))
                                   : view('admin.transactions.index', compact('transactions')) ;
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.detail', [
            'transaction' => $transaction
        ]);
    }

    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', [
            'transaction' => $transaction,
            'statuses'    => Status::all()
        ]);
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->toArray());

        return redirect()->route('admin.transactions.index')->withMessage("Transaction status for {$transaction->user->username} has been changed!");
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')->withMessage("Transaction has been deleted!");
    }
}
