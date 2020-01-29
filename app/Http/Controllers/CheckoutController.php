<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\TransactionDetailRequest;

use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;
use App\User;

// use Carbon\Carbon;

class CheckoutController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = rememberUserCache();
    }

    public function index($id)
    {
        $transaction = Transaction::with('user')
        ->where([
            'id'                    => $id,
            'user_id'               => $this->user->id,
            'transaction_status_id' => 1
        ])->firstOrFail();

        return view('user.checkout.index', compact('transaction'));
    }

    public function process(TravelPackage $travelPackage)
    {
        // create transaction (that uses travel package relations) 
    	$transaction = $travelPackage->transactions()->create([
    		'user_id' 				=> $this->user->id,
    		'additional_visa'		=> 0,
    		'total' 	            => $travelPackage->price,
    		'transaction_status_id'	=> 1,
    	]);

        /**  
         *
         *  after transaction is created,
         *  "created" method on transaction observer will be fire...
         *  on App\Observers\TransactionObserver;
         */

        return redirect()->route('checkout.index', $transaction->id);
    }

    /**
     * Destroy transaction model
     *
     * @return redirect
     * @author aqshalzakki
     **/
    public function cancel(Transaction $transaction)
    {
        // set to 4(cancel)
        $transaction->transaction_status_id = 4;
        $transaction->save();

        return redirect()->route('travel-packages.show', $transaction->travel_package->slug);
    }

    /**
     * create a new transaction detail
     *
     * @return redirect
     * @author aqshalzakki 
     **/
    public function create(TransactionDetailRequest $request, Transaction $transaction)
    {
        // create details of transaction from user relationship
        $user = User::whereUsername($request->username)->first();
        $data = [
            'transaction_id' => $transaction->id,
            'nationality'    => $request->nationality,
            'is_visa'        => $request->is_visa,
            'doe_passport'   => $request->doe_passport
        ];
        $user->transaction_details()->create($data);

        // if user input a visa
        if ($request->is_visa)
        {
            // update a transaction total and addtional visa
            $transaction->total += 190;
            $transaction->additional_visa += 190;
        }

        // update a transaction total 
        $transaction->total += 
            $transaction->travel_package->price;

        $transaction->save();
        
        return redirect()->route('checkout.index', $transaction->id)->withSuccess('A new member has been added successfuly!');
    }

    /**
     * remove a transaction detail
     *
     * @return redirect
     * @author aqshalzakki 
     **/
    public function remove(TransactionDetail $transactionDetail)
    {
        // get the transaction with their relations
        $transaction = $transactionDetail->transaction()
                                         ->with(['travel_package', 'details'])
                                         ->firstOrFail();
        
        if ($transactionDetail->is_visa)
        {
            $transaction->total -= 190;
            $transaction->additional_visa -= 190;
        }

        // update the transaction total 
        $transaction->total -= $transaction->travel_package->price;
        $transaction->save();

        // and then delete the detail transaction 
        $transactionDetail->delete();

        return redirect()->route('checkout.index', $transaction->id);
    }

    public function success($id)
    {
        $transaction = Transaction::where([
            'id'      => $id,
            'user_id' => $this->user->id,
        ])->firstOrFail();
        
        // update transaction status to pending
        $transaction->transaction_status_id = 2;
        $transaction->save();

        return view('user.checkout.success');
    }
}
