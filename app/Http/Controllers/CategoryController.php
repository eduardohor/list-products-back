<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function upload(Request $request)
    {
        Excel::import(new CategoriesImport, $request->file);

        $category = $this->category->all();

        return response()->json([
            'msg' => 'Arquivo importado com sucesso!',
            'data' => $category
        ], 201);
    }

    public function download()
    {

       $file = Storage::get('categories.csv');

       $fileData = mb_convert_encoding($file, "UTF-8" , "ISO-8859-1");

       return $fileData;

    }
}
