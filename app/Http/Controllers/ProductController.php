<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $product = $this->product->orderByDesc('created_at')->get();
        return response()->json($product, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $dataProduct = $request->all();

        $image = $dataProduct['image'];

        $path = $image->store('products', 'public');

        $dataProduct['image'] = $path;

        $product = $this->product->create($dataProduct);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['erro' => 'Não foi possível atualizar. Recurso solicitado não existe'], 404);
        }

        $dataProduct = $request->all();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $image = $dataProduct['image'];

            $path = $image->store('products', 'public');

            $dataProduct['image'] = $path;
        }


        $product->update($dataProduct);

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['erro' => 'Não foi possível deletar. Recurso solicitado não existe'], 404);
        }

        Storage::disk('public')->delete($product->image);
        $product->delete();

        return response()->json(['msg' => 'Deletado com sucesso!'], 200);
    }
}
