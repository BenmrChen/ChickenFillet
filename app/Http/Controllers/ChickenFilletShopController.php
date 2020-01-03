<?php

namespace App\Http\Controllers;

use App\ChickenFilletShop;
use App\Http\Resources\ChickenFilletShopResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChickenFilletShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $chickenFilletShop = ChickenFilletShop::get();
//        return response($chickenFilletShop, Response::HTTP_OK);
//        return response(['chickFilletShop' => $chickenFilletShop], Response::HTTP_OK);
        // 設定預設值
        $marker = $request->marker == null ? 1 : $request->marker; // marker 預設為0
        $limit  = $request->limit  == null ? 10: $request->limit; // limit 預設顯示10筆

//        $chickenFilletShop = ChickenFilletShop::orderBy('id', 'asc')
//            ->where('id', '>=', $marker)
////            ->limit($limit)
//            ->paginate($limit);
////            ->get();

        $chickenFilletShop = ChickenFilletShop::query(); // 如果user都沒有走filters或sorts來key in 做查詢的話 下面的$chickenFilletShop就會抓不到 所以還是要加這一行
        // 如果不用query 而是用get()的話，會出現"paginate does not exist."的提示 dd後會發現用get()出來會拿到collection; 但用query()的話會是個query builder，

        dd($chickenFilletShop);

        // 設定篩選條件
        if (isset($request->filters)) {
            $filters = explode(',', $request->filters);
            foreach ($filters as $filter) {
                list($criteria, $value) = explode(':', $filter); // assign 一個變數叫$criteria, 其值是explode出來的第一個; 再assign一個變數叫$value, 其值是explode出來的第二個
                $chickenFilletShop = ChickenFilletShop::where($criteria, 'like', "%$value%"); // 把上面的條件限制用where這個方法塞進去
            }
        }

//        $chickenFilletShop = $chickenFilletShop->where('id', '>=', $marker)->paginate($limit); // 最後再加上 marker 和 paginate 的條件

//        $query = ChickenFilletShop::query(); // 感覺上是先把model裡的東西全部都拿出來，塞在$query變數裡然後後面再處理
//
//        if (isset($request->filters)) {
//            $filters = explode(',', $request->filters);
//            foreach ($filters as $filter) {
//                list($criteria, $value) = explode(':', $filter);
//                $query->where($criteria, 'like', "%$value%");
//            }
//        }

//        $chickenFilletShop = $query->where('id', '>=', $marker)->paginate($limit);

        // 設定排序條件
        if (isset($request->sorts)) {
            $sorts = explode(',', $request->sorts);
            foreach ($sorts as $sort) {
                list($criteria, $value) = explode(':', $sort);
                if ($value == 'arc' || $value == 'desc') {
                    $chickenFilletShop = ChickenFilletShop::orderBy($criteria, $value);
                }
            }
        }
        $chickenFilletShop = $chickenFilletShop->where('id', '>=', $marker)->paginate($limit); // 最後再加上 marker 和 paginate 的條件

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
        $this->validate($request,[
            'type_id'     => 'required',
            'chain_store' => 'required|boolean'
            ]
        );
//        $validatedData = $request->validate([
//            'type_id' => 'required|unique:posts|max:255',
//            'chain_store' => 'required',
//        ]);
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
//        return response($chickenFilletShop, Response::HTTP_OK);
        // show 傳入的物件 Laravel 會自動利用 Model 設定的主鍵去找出資料(主鍵預設id)

        return response(new ChickenFilletShopResource($chickenFilletShop), Response::HTTP_OK);
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
        return response($chickenFilletShop, Response::HTTP_OK);
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
