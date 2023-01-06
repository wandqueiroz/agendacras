<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SetorPessoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function orderData(Request $request){ // This is the function which I want to call from ajax
            //do something awesome with that post data
           // $data = $request->all();
        #create or update your data here
/*

        $users = BeneficiarioSopa::where('id_beneficiario', $id)->where('data', $now/* date('Y-m-d' ))->first();


        Carbon::createFromFormat('d/m/Y', $request->stockupdate)->format('Y-m-d'); */

        $dia = $request->get('dia');


        $horarios = array('08:00', '08:40', '09:00', '15:40', '16:00', '11:20', '13:40', '14:20');

        return response()->json(['success'=> $dia]);
    }

    public function requerimento()
    {

    }

    public function aviso_ferias()
    {
        return view('forms.aviso_ferias');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
