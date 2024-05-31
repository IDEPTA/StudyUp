<?php

namespace App\Http\Controllers;

use App\Models\Variant;
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
        $filePath = $file->store('files');
        $variant = new Variant();
        $variant->subject = $data['selectedSubject'];
        $variant->answers = $data['answersData'];
        $variant->file = 'storage/' . $filePath;
        $variant->save();
        return response()->json([
            'msg' => "Добавлено",
            "data" => $data,
            'file' => $file
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Variant::find($id)->delete();
        return response()->json(["msg" => "Вариант удален"]);
    }
}
