<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // use admin middleware

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
        $forms = Form::paginate(10);
        return view('admin.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'fields' => 'json|required',
            'status' => 'required',
        ]);

        $form = new Form();
        $form->name = $request->name;
        $form->description = $request->description;

        $jsonFields = json_decode($request->fields, true);

        foreach ($jsonFields as $field) {
            $key = $field['key'];
            $value = $field['value'];

            $form->fields->$key = $value;
        }

        $form->status = $request->status;
        $form->save();

        return redirect()
            ->route('admin.forms.index')
            ->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
        return view('admin.forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
        return view('admin.forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'fields' => 'json|required',
            'status' => 'required',
        ]);

        $form = Form::find($id);

        $form->name = $request->name;
        $form->description = $request->description;

        $jsonFields = json_decode($request->fields, true);

        // reset fields
        $form->fields = new \stdClass();

        foreach ($jsonFields as $field) {
            $key = $field['key'];
            $value = $field['value'];

            $form->fields->$key = $value;
        }

        $form->status = $request->status;
        $form->save();

        return redirect()
            ->route('admin.forms.index')
            ->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
        $form->delete();
        return redirect()
            ->route('admin.forms.index')
            ->with('success', 'Form deleted successfully.');
    }
}
