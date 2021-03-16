<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function licence(Request $request)
    {
        $id = $request->id;
        $licences = Licence::where('licences.product_id', $id)
            ->where('licences.end_date', '>=', now())
            ->where('licences.start_date', '<=', now())
            ->join('users', 'users.id', '=', 'licences.user_id')
            ->select('users.ideal_username')->get();
        $statuscode = 423;
        if ($licences)
            $statuscode = 200;


        return response()->json(['status' => $statuscode, 'licences' => $licences]);
    }
}
