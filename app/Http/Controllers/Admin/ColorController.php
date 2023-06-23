<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index(){

        $colors = Color::all();
        return view('admin.color.index', compact('colors'));
    }

    public function create(){

        return view('admin.color.create');
    }

    public function store(ColorFormRequest $request){

        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::create($validatedData);

        return redirect('admin/colors')->with('message', 'Color Added Successfully');
        
    }

    public function edit($id){
        $color = Color::where('id', $id)->first();
        return view('admin.color.edit', compact('color'));
        
    }

    public function update(ColorFormRequest $request, $color_id){

        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::find($color_id)->update($validatedData);

        return redirect('admin/colors')->with('message', 'Color Updated Successfully');
    }

    public function destroy(int $color_id){
        $color = Color::findOrFail($color_id);

        $color->delete();

        return redirect('admin/colors')->with('message', 'Color Deleted Successfully');
    }

}



