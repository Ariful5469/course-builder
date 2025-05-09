<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;


class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $modules = Module::with('contents') // Eager load contents
            ->when($query, function($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%'.$query.'%');
            })
            ->get();

        return view('modules.index', compact('modules'));
    }
}


