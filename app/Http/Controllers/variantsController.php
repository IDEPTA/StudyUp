<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Requests\addVariantValidation;

class variantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
        $variants = Variant::all();
         return response()->json(['msg' => "Вывод", "data" => $variants]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addVariantValidation $request)
    {
        $data = $request->validated();
        $file = $request->file("file");
        $filePath = $file->store('storage/files');
        $variant = new Variant();
        $variant->subject = $data['selectedSubject'];
        $variant->answers = $data['answersData'];
        $variant->file = $filePath;
        $variant->save();
        return response()->json(['msg' => "Добавлено", "data" => $data, 'file' => $file]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
