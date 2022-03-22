<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\SitesLogs;
use Illuminate\Http\Request;

class SitesLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sites = Sites::all();
        foreach ($sites as $site) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $site->url);
            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

            $output = curl_exec($ch);
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $log = new SitesLogs([
                'site_id' => $site->id,
                'data' => $output,
                'resposta' => $info
            ]);
            $log->save();
            curl_close($ch);
        }

        if (!empty($request->input('site_id'))) {
            $logs = SitesLogs::where('site_id', $request->input('site_id'))->orderByDesc('created_at')->get();
        }else{
            $logs = SitesLogs::orderByDesc('created_at')->get();
        }

        return view('sites_logs.list', compact('logs', 'logs'));
    }

}
