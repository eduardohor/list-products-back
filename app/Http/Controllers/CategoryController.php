<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function categoriesUsers(Request $request)
    {
        Excel::import(new CategoriesImport, $request->file);

        $category = $this->category->all();

        return response()->json([
            'msg' => 'Arquivo importado com sucesso!',
            'data' => $category
        ], 201);
    }
}
