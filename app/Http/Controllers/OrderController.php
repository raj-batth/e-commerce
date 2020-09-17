<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function __construct()
    {
        //? Redirect unauthorized to login page
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        try {
            $order = Product::where('id', request()->id)->get();
            $tax = 13;
            $total = number_format(($order[0]->price * 13 / 100) + $order[0]->price, 2, '.', '');
            return view('ordersummary')->with(['order' => $order, 'total' => $total, 'tax' => $tax]);
        } catch (Exception $exception) {
            return view('thankyou')->with(['type' => 'error', 'message' => 'Something went wrong, please try again!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Order\OrderStoreRequest $request
     * @return 
     */
    public function store(OrderStoreRequest $request)
    {
        try {
            $orderInfo = [
                'user_id'      => Auth::user()->id,
                'product_id'   => $request->product_id,
                'price'        => $request->price,
                'tax'          => $request->tax,
                'total_amount' => $request->total_amount,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];

            $shippingDetail = [
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'address'       => $request->address,
                'city'          => $request->city,
                'state'         => $request->state,
                'postal_code'   => $request->postal_code,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];
            DB::transaction(function () use ($orderInfo, $request, $shippingDetail) {
                $orderId = Order::insertGetId($orderInfo);
                $shippingDetail['order_id'] = $orderId;
                ShippingDetail::insert($shippingDetail);
                $productUpdate = Product::find($request->product_id)->decrement('quantity');
            }, 5);
            return view('thankyou')->with(['type' => 'success', 'message' => 'Thank you for shopping with us']);
        } catch (Exception $exception) {
            return view('thankyou')->with(['type' => 'error', 'message' => 'Something went wrong, please try again!']);
        }
    }
}
