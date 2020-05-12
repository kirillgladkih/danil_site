<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductList;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\json_decode;

session_start();

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ses       = $_SESSION;
        $data      = [];
        $tmp_model = null;
        $model     = new ProductList();


        foreach($ses as $key=>$value){
            $key       = preg_replace('/\'/','' ,$key);

            $tmp_model        = $model->find($key);
            $tmp_model->count = $value;
            
            $data[] = $tmp_model;
        }

        return view('home.basket', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::firstOrCreate(['name' => $request->name, 
        'phone' => $request->phone]);

        $id = $user->id;

        $products = $request->products;

        $message = [];
        
        foreach ($products as $value) {
 
            $product = ProductList::find($value['id']);

            $message[] = 'артикул : '.$value['id'].', наименование: '. 
            $product->name . ', кол-во : ' . $value['count'];
 
        }

        $sum = 'сумма заказа : ' . $request->sum . ' Руб.';

        $data = [
            'products' => json_encode($message),
            'user_id'  => $id,
            'sum'      => $request->sum
        ];

        Order::firstOrCreate($data);

        MailController::sendOrders($user->name, $user->phone, $message, $sum);

        session_destroy();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        unset($_SESSION["'" . $id ."'"]);

        return $_SESSION;
    }
}
