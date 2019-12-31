<?php

namespace App\Http\Controllers;

use App\ChickenFilletShop;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChickenFilletShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chickenFilletShop = ChickenFilletShop::get();
//        return response($chickenFilletShop, Response::HTTP_OK);
        return response(['chickFilletShop' => $chickenFilletShop], Response::HTTP_OK);

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
     * @param  \Illuminate\Http\Request  $requestx
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chickenFilletShop = ChickenFilletShop::create($request->all());
        return response($chickenFilletShop, Response::HTTP_CREATED); //import class?
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return \Illuminate\Http\Response
     */
    public function show(ChickenFilletShop $chickenFilletShop)
    {
        return \response($chickenFilletShop, Response::HTTP_OK);
        // show 傳入的物件 Laravel 會自動利用 Model 設定的主鍵去找出資料(主鍵預設id)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return \Illuminate\Http\Response
     */
    public function edit(ChickenFilletShop $chickenFilletShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChickenFilletShop $chickenFilletShop)
    {
        $chickenFilletShop->update($request->all());
        return \response($chickenFilletShop, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChickenFilletShop $chickenFilletShop)
    {
        $chickenFilletShop->delete();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}
