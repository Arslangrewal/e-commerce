<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return  view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {

        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads/slider'), $filename);
            $validateData['image'] = "uploads/slider/$filename";
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $validateData['status'],
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.edit', compact('slider'));
    }

    
    public function update(SliderFormRequest $request, $id)
    {
        // return $request;
        // dd($request->all());
        $validateData = $request->validated();


        if ($request->hasFile('image')) {

            // $destination = $slider->image;
            // if(File::exists($destination)){
            //     File::delete($destination);
            // }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads/slider/'), $filename);
            $validateData['image'] = "uploads/slider/$filename";
            
        } else {
            $file = Slider::where('id', $id)->first();
            $filename = $file->image;
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id', $id)->update([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => "uploads/slider/".$filename,
            'status' => $validateData['status'],
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully');
    }


    public function destroy(int $slider_id)
    {
        // dd($slider);
        $slider = Slider::findOrFail($slider_id);
        
        $slider->delete();
        return redirect('admin/sliders')->with('message', 'Slider Deleted Successfully');
    }
}
