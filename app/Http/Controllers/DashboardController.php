<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $forms_count = Form::all()->count();
        $responses_count = Response::all()->count();

        $responses = Response::latest()->paginate(10);
        return view(
            'dashboard',
            compact('forms_count', 'responses_count', 'responses')
        );
    }
}
