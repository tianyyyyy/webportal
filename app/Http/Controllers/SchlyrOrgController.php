<?php

namespace App\Http\Controllers;

use App\Models\Schlyr;
use Illuminate\Http\Request;

class SchlyrOrgController extends Controller
{
    public function show(Schlyr $schlyr)
    {

        $organizations = $schlyr->organization()->latest()->paginate(10);

        return view('admin.organizations.show', [
            'schlyr' => $schlyr,
            'organizations' => $organizations
        ]);
    }
}
