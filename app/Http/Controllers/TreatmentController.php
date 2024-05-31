<?php

namespace App\Http\Controllers;

use App\Http\Requests\answersValidation;
use App\Models\Solved;
use App\Models\Variant;
use Illuminate\Support\Facades\Auth;

class TreatmentController extends Controller
{
    public function examination(answersValidation $req)
    {
        $data = $req->validated();
        $result = [];
        $variant = Variant::find($data['variantId']);
        $answers_array = json_decode($variant->answers);
        foreach ($data['answersData'] as $key => $value) {
            if ($value === $answers_array[$key]) {
                $result[] += 1;
            } else {
                $result[] += 0;
            }
        }
        Solved::create([
            "user_id" => $data['userId'],
            "result" => json_encode($result),
            "variant_id" => $data['variantId']
        ]);
        return response()->json(['msg' => "отправлено на проверку", "data" => $data]);
    }
    public function getSolvedVariants($id)
    {
        $solvedVariants = Solved::with('user', 'variant')->where('user_id', "=", $id)->orderBy("created_at", "desc")->get();
        return response()->json(['msg' => "Получены данные", "data" => $solvedVariants]);
    }
}
