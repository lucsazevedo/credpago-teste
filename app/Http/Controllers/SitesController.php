<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Sites::select('sites.url', 'sites.id', DB::raw('count(sites.id) as total'), DB::raw('max(sites_logs.created_at) as last_request'), DB::raw(('max(sites_logs.id) as log_id')))
            ->leftJoin('sites_logs', 'sites_logs.site_id', '=', 'sites.id')
            ->groupBy('sites.url', 'sites.id')
            ->get();

        return view('sites.list', ['sites' => $sites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required'
        ]);

        $sites = new Sites([
            'url' => $request->get('url')
        ]);

        $sites->save();
        return redirect('/sites')->with('success', 'Site cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Sites $sites
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        ;
        $sites = Sites::find($id);
        return view('sites.edit', compact('sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sites $sites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required'
        ]);

        $site = Sites::find($id);
        $site->url = $request->get('url');

        $site->update();

        return redirect('/sites')->with('success', 'Site atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Sites $sites
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sites = Sites::find($id);
        $sites->delete();
        return redirect('/sites')->with('success', 'Site excluido com sucesso!');
    }
}
