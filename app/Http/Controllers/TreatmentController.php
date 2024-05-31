<?php

namespace App\Http\Controllers;

use App\Http\Requests\answersValidation;
use App\Models\SchoolItems;
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

    public function getSolvedsVariants()
    {
        $solvedVariants = Solved::with(['user', 'variant'])->orderBy("created_at", "desc")->get();
        return response()->json(['msg' => "Получены данные", "data" => $solvedVariants]);
    }

    public function getSolvedsVariantForSchool()
    {
        $schoolItems = SchoolItems::join('users', 'users.id', '=', 'school_items.user_id')
            ->join('solveds', 'solveds.user_id', '=', 'users.id')
            ->join('schools', 'schools.id', '=', 'school_items.school_id')
            ->join('variants', 'variants.id', '=', 'solveds.variant_id')
            ->get([
                'users.id as userId',
                'users.name as username',
                'users.lastname',
                'schools.id as schoolId',
                'schools.name',
                'schools.city',
                'solveds.result',
                'variants.subject',
                'variants.created_at'
            ]);
        return response()->json(['data' => $schoolItems]);
    }
    public function getSolvedsVariantForConcreteSchool($id)
    {
        $schoolData = SchoolItems::with(['user', 'school'])->where("user_id", $id)->get();
        return response()->json(["data" => $schoolData]);
    }
}
