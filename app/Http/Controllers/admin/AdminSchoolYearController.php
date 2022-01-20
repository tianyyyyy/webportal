<?php

namespace App\Http\Controllers\admin;

use App\Models\Schlyr;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSchoolYearController extends Controller
{



    public function store(Request $request)
    {
        Schlyr::create([
            'schlyr' => $request->schlyr
        ]);

        return back()->with('message', 'School Year succesfully added');
    }
}
