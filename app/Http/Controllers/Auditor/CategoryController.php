<?php

namespace App\Http\Controllers\Auditor;

use App\Auditor\Categories\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auditor.categories.index', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auditor.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( ! $request->has('name')) {
            return back()->with('error', 'Please give your category a name');
        }

        $cat = Category::where('name', $request->get('name'))->first();

        if ( ! $cat) {
            Category::create([
                'name' => ucwords($request->get('name')),
                'color' => $request->get('color'),
            ]);

            return redirect()->route('auditor.categories.index')
                             ->with('success', 'You have successfully added a new category');
        }

        if (strtolower($cat->name) == strtolower($request->get('name'))) {
            return back()->with('error', 'A category already exists with that name');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('auditor.categories.edit', [
            'category' => Category::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ( ! $request->has('name')) {
            return back()->with('error', 'Please give your category a name');
        }

        $cat = Category::findOrFail($id);
        $cat->update($request->only('name', 'color'));

        return redirect()->route('auditor.categories.index')
                         ->with('success', 'You have successfully added a new category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
