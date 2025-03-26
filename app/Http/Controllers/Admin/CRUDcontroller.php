<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



class CRUDcontroller extends Controller
{
    public function index(Request $request)
    {
        $query = CRUD::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('date')) {
            $query->where('date', 'like', '%' . $request->date . '%');
        }
        $crud = $query->orderBy('name', 'asc')->paginate(10);
        $crud = $query->orderBy('name', 'asc')->paginate(10);
        $parent_nav = 'item';
        $child_nav = 'crud';
        return view("admin.crud.index",compact("parent_nav","child_nav","crud"));
    }

    public function add()
    {
        $parent_nav = 'item';
        $child_nav = 'crud';
        return view("admin.crud.add",compact('parent_nav','child_nav'));   
     }

     public function store(Request $request)
     {

         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'date' => 'required|integer',
             'meta_description' => 'nullable|string|max:500',
             'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|',
         ], [
             'main_image.dimensions' => "The image size must be larger than 1280px x 685px.",
         ]);
         $main_image = null;
 
         // Handle Main Image Upload
         if ($request->hasFile('main_image')) {
             $main_image = $request->file('main_image');
             $filename_to_store = time() . '_' . $main_image->getClientOriginalName();
             $path = public_path('storage/uploads/crud/main_image/');
             if (!File::isDirectory($path)) {
                 File::makeDirectory($path, 0777, true, true);
             }
             $main_image->move($path, $filename_to_store); // Store the main image
         }
         CRUD::create([
             'name' => $validatedData['name'] ?? '',
             'date' => $validatedData['date'] ?? '',
             'description' => $validatedData['description'] ?? '',
             'meta_description' => $validatedData['meta_description'] ?? '',
             'main_image' => $main_image ?  $filename_to_store : null,
         ]);
         return redirect()->route('admin.crud.index')->with('success', 'crud added successfully!');
     }

     public function edit($id)
     {
         $parent_nav = 'item';
         $child_nav = 'crud';
         $crud = CRUD::findOrFail($id);
         return view("admin.crud.edit",compact('parent_nav','child_nav','crud'));    
     }

     public function update(Request $request, $id)
     {
         $crud = CRUD::findOrFail($id);
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'date' => 'required|string|max:255,', 
             'meta_description' => 'nullable|string|max:500',
             'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
         ], [
             'main_image.dimensions' => "The image size must be larger than 1280px x 685px.",
         ]);
         // Handle Main Image Upload
         $main_image = $crud->main_image; // Keep existing main_image if no new image is uploaded
         if ($request->hasFile('main_image')) {
             // Remove old main image if it exists
             if (File::exists(public_path('storage/uploads/crud/main_image/' . $main_image))) {
                 File::delete(public_path('storage/uploads/crud/main_image/' . $main_image));
             }
 
             // Upload new main image
             $main_image_file = $request->file('main_image');
             $filename_to_store = time() . '_' . $main_image_file->getClientOriginalName();
             $path = public_path('storage/uploads/crud/main_image/');
             
             if (!File::isDirectory($path)) {
                 File::makeDirectory($path, 0777, true, true);
             }
 
             $main_image_file->move($path, $filename_to_store);
             $main_image = $filename_to_store;
         }
 
         // Update crud details
         $crud->update([
             'name' => $validatedData['name'],
             'date' => Str::slug($validatedData['date']),
             'meta_description' => $validatedData['meta_description'] ?? '',
             'main_image' => $main_image, // Updated or kept existing image
         ]);
 
         return redirect()->route('admin.crud.index')->with('success', 'crud updated successfully!');
     }
     
     public function destroy($id)
     {
         $crud = CRUD::findOrFail($id);
 
         if ($crud->main_image) {
             $main_image_path = public_path('storage/uploads/crud/main_image/' . $crud->main_image);
             if (File::exists($main_image_path)) {
                 File::delete($main_image_path);
             }
         }
 
         if ($crud->mobile_image) {
             $mobile_image_path = public_path('storage/uploads/crud/mobile_image/' . $crud->mobile_image);
             if (File::exists($mobile_image_path)) {
                 File::delete($mobile_image_path);
             }
         }
 
         $crud->delete();
 
         return redirect()->route('admin.crud.index')->with('success', 'crud deleted successfully!');
     }
}
