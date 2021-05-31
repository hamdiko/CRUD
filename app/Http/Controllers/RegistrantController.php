<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use Illuminate\Http\Request;
use App\Registrant;
use Illuminate\Support\Facades\Mail;

class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrants = Registrant::all();

        return view('registrants.index', compact('registrants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registrants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Registrant $registrant)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email'
        ]);
        

        $new_rigstrant = $registrant->create(request(['first_name','last_name','email','job_title','city','country']));
        /*$registrant = new Registrant([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'city' => $request->get('city'),
            'country' => $request->get('country')
        ]);
        $registrant->save();*/
        Mail::to($new_rigstrant->email)->send(new UserCreated($new_rigstrant));
        return redirect('/registrants')->with('success', 'Registrant saved!')->with('flash','Registrant saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrant $registrant)
    {
        return view('registrants.edit', compact('registrant'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrant $registrant)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email'
        ]);

        $registrant->update(request(['first_name','last_name','email','job_title','city','country']));

        /*$registrant->first_name =  $request->get('first_name');
        $registrant->last_name = $request->get('last_name');
        $registrant->email = $request->get('email');
        $registrant->job_title = $request->get('job_title');
        $registrant->city = $request->get('city');
        $registrant->country = $request->get('country');
        $registrant->save();*/

        return redirect('/registrants')->with('success', 'Registrant updated!')->with('flash','Registrant updated!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrant $registrant)
    {
        $registrant->delete();

        return redirect('/registrants')->with('success', 'Registrant deleted!');
    }
}
