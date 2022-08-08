<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Traits\Revolut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    use Revolut;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = config('constants.CURRENCIES');
        return view('orders.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            // CREATE ORDER IN REVOLUT
            $order = $this->createOrder($request->amount, $request->currency, $request->email);

            // FETCHING ORDER_ID AND STATE FROM REVOLUT API
            $request->merge([
                'order_id' => $order['id'],
                'status' => $order['state'],
            ]);
            // SAVE ORDER DETAILS IN DATABASE
            Order::create($request->all());

            // SEND MAIL TO CUSTOMER
            Mail::to($request->email)->send(new OrderMail($request->amount, $request->currency));

            // ON SUCCESS // SHOW MSG AND REDIRECT BACK TO HISTORY PAGE
            Session::flash('success', 'Order Created Successfully');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            // EXCEPTION // RETURN BACK WITH ERROR MESSAGE
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
}
