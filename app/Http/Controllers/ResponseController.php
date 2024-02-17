<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    //
    public function index(Request $request, $key)
    {
        $form = Form::where('key', $key)->firstOrFail();

        return view('form', compact('form'));
    }

    public function store(Request $request, Form $form)
    {
        $formFields = json_decode($form->fields->toJson(), true);
        $allowedFields = array_keys($formFields);

        $request->validate([
            'email' => 'required',
        ]);

        $response = new Response();
        $response->form_id = $form->id;
        $response->email = $request->email;
        $response->key = bin2hex(random_bytes(32));

        foreach ($allowedFields as $field) {
            $fieldName = str_replace(' ', '_', $field);
            $response->fields->$fieldName = $request->$fieldName;
        }

        $response->save();

        return view('submitted', ['key' => $form->key]);
    }
}
