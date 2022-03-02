<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Consignee;
use App\Country;
use App\Manifest;
use App\Product;
use App\Shipper;
use Carbon\Carbon;
use Auth;
use DB;
/* Export data */
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class ManifestController extends Controller
{
    protected const MSG_NO_AUTH = 'Lo sentimos, no está autorizado para visualizar la información solicitada. En caso lo necesite, contacte al equipo de Fresh Fruit® Perú.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    
    public function charts()
    {
        $maxDate = Manifest::max('departured_at');
        $evolDia = $evolSem = $evolMes = $ptosCmp = [];
        $prodNm = $subtitle = $product_id = $country_id = $shipper_id = $consignee_id = '';
        return view('manifests.charts', compact('evolDia','evolSem','evolMes','ptosCmp','prodNm','maxDate','subtitle','product_id','country_id','shipper_id','consignee_id'));
    }

    public function dataEvol(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1'
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return back()->with('error',self::MSG_NO_AUTH);

        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        $consignee_id = $request->consignee_id;

        $ptosCmp = Campaign::select([
            DB::raw('concat(year(current_date),"/",date_format(start_at,"%m/%d")) as start_at'),
            DB::raw('concat(year(current_date),"/",date_format(end_at,"%m/%d")) as end_at')
        ])
        ->where('product_id',$product_id)
        ->get();

        $evolDia = Manifest::select([
            DB::raw('date_format(departured_at,"%Y/%m/%d") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            /*DB::raw('date_sub(current_date, interval '.$numDia.' day)'),*/
            DB::raw('2020-01-01'),
            DB::raw('date_sub(current_date, interval 1 day)')
        ])
        ->groupBy(
            DB::raw('departured_at')
        )
        ->orderBy(
            DB::raw('departured_at')
        )
        ->get();

        $evolSem = Manifest::select([
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            /*DB::raw('date_sub(date_sub(current_date, interval weekday(current_date)+1 day), interval '.$numSem.' week)'),*/
            DB::raw('2020-01-01'),
            DB::raw('date_sub(current_date, interval weekday(current_date)+1 day)')
        ])
        ->groupBy(
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d")')
        )
        ->orderBy(
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d")')
        )
        ->get();

        $evolMes = Manifest::select([
            DB::raw('date_format(departured_at,"%Y/%m/01") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            /*DB::raw('date_sub(date_sub(current_date, interval day(current_date)-1 day), interval '.$numMes.' month)'),*/
            DB::raw('2020-01-01'),
            DB::raw('date_sub(current_date, interval day(current_date) day)')
        ])
        ->groupBy(
            DB::raw('date_format(departured_at,"%Y/%m/01")')
        )
        ->orderBy(
            DB::raw('date_format(departured_at,"%Y/%m/01")')
        )
        ->get();

        $prodNm = Product::find($product_id)->name;
        $maxDate = Manifest::max('departured_at');
        $country = $country_id !== null ? Country::find($country_id)->name : 'Todos';
        $shipper = $shipper_id !== null ? Shipper::find($shipper_id)->name : 'Todos';
        $consignee = $consignee_id !== null ? Consignee::find($consignee_id)->name : 'Todos';
        $subtitle = 'Destino: '.$country.' - Exportador: '.$shipper.' - Consignatario: '.$consignee.' - Actualizado al '.Carbon::parse($maxDate ?? '')->format('d/m/Y');
        return view(Auth::check() ? 'manifests.charts' : 'index', compact('evolDia','evolSem','evolMes','ptosCmp','prodNm','maxDate','subtitle','product_id','country_id','shipper_id','consignee_id'));
    }

    public function dataEvolDia(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'numMes' => 'required|numeric|min:201901'
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return json_encode([]);

        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        $consignee_id = $request->consignee_id;
        $numMes = $request->numMes;

        $evolDia = Manifest::select([
            DB::raw('date_format(departured_at,"%Y/%m/%d") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            DB::raw('"'.substr($numMes,0,4).'-'.substr($numMes,4,2).'-01"'),
            DB::raw('date_sub(current_date, interval 1 day)')
        ])
        ->groupBy(
            DB::raw('departured_at')
        )
        ->orderBy(
            DB::raw('departured_at')
        )
        ->get();

        return json_encode($evolDia);
    }

    public function dataEvolSem(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'numMes' => 'required|numeric|min:201901'
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return json_encode([]);

        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        $consignee_id = $request->consignee_id;
        $numMes = $request->numMes;

        $evolSem = Manifest::select([
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            DB::raw('"'.substr($numMes,0,4).'-'.substr($numMes,4,2).'-01"'),
            DB::raw('date_sub(current_date, interval weekday(current_date)+1 day)')
        ])
        ->groupBy(
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d")')
        )
        ->orderBy(
            DB::raw('date_format(date_add(departured_at, interval 6-weekday(departured_at) day),"%Y/%m/%d")')
        )
        ->get();

        return json_encode($evolSem);
    }
    
    public function dataEvolMes(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'numMes' => 'required|numeric|min:201901'
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return json_encode([]);

        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        $consignee_id = $request->consignee_id;
        $numMes = $request->numMes;

        $evolMes = Manifest::select([
            DB::raw('date_format(departured_at,"%Y/%m/01") as departured_at'),
            //DB::raw('round(sum(ifnull(gross_weight,0))/1000,0) as weight')
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->whereBetween('departured_at',[
            DB::raw('"'.substr($numMes,0,4).'-'.substr($numMes,4,2).'-01"'),
            DB::raw('date_sub(current_date, interval day(current_date) day)')
        ])
        ->groupBy(
            DB::raw('date_format(departured_at,"%Y/%m/01")')
        )
        ->orderBy(
            DB::raw('date_format(departured_at,"%Y/%m/01")')
        )
        ->get();

        return json_encode($evolMes);
    }

    public function dataPais(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'mesIni' => 'required|numeric|min:1',
            'mesFin' => 'required|numeric|min:1',
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return json_encode([]);

        $product_id = $request->product_id;
        $mesIni = $request->mesIni;
        $mesFin = $request->mesFin;
        $topRnk = 5;

        $items = Manifest::select([
            DB::raw('countries.name as country'),
            DB::raw('sum(ifnull(manifests.gross_weight,0)) as weight')
        ])
        ->leftJoin('countries','countries.id','manifests.country_id')
        ->where('manifests.product_id',$product_id)
        ->whereNotNull('countries.name')
        ->whereBetween(
            DB::raw('date_format(manifests.departured_at,"%Y%m")'),[$mesIni,$mesFin]
        )
        ->groupBy(
            DB::raw('countries.name')
        )
        ->orderByDesc(
            DB::raw('sum(ifnull(manifests.gross_weight,0))')
        )
        ->get();

        $total = Manifest::select([
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('manifests.product_id',$product_id)
        ->whereBetween(
            DB::raw('date_format(manifests.departured_at,"%Y%m")'),[$mesIni,$mesFin]
        )
        ->get();

        $tot_weight = $total->first()->weight;
        $ranking = array();
        foreach ($items->slice(0, $topRnk) as $item) {
            $ranking[] = array(
                'country' => $item->country,
                'weight' => round($item->weight/1000,0),
                'participation' => round($item->weight*100/$tot_weight,2)
            );
        }

        $otr_countr = $items->count() - $topRnk;
        if ($otr_countr > 0) {
            $otr_weight = 0;
            foreach ($items->slice($topRnk, $otr_countr) as $item) {
                $otr_weight += $item->weight;
            }
            $ranking[] = array(
                'country' => 'Otros',
                'weight' => round($otr_weight/1000,0),
                'participation' => round($otr_weight*100/$tot_weight,2)
            );
        }
        return json_encode($ranking);
    }

    public function dataExpo(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'mesIni' => 'required|numeric|min:1',
            'mesFin' => 'required|numeric|min:1',
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return json_encode([]);

        $product_id = $request->product_id;
        $mesIni = $request->mesIni;
        $mesFin = $request->mesFin;
        $topRnk = 6;

        $items = Manifest::select([
            DB::raw('shippers.name as shipper'),
            DB::raw('sum(ifnull(manifests.gross_weight,0)) as weight')
        ])
        ->leftJoin('shippers','shippers.id','manifests.shipper_id')
        ->where('manifests.product_id',$product_id)
        ->whereNotNull('shippers.name')
        ->whereBetween(
            DB::raw('date_format(manifests.departured_at,"%Y%m")'),[$mesIni,$mesFin]
        )
        ->groupBy(
            DB::raw('shippers.name')
        )
        ->orderByDesc(
            DB::raw('sum(ifnull(manifests.gross_weight,0))')
        )
        ->get();

        $total = Manifest::select([
            DB::raw('sum(ifnull(gross_weight,0)) as weight')
        ])
        ->where('manifests.product_id',$product_id)
        ->whereBetween(
            DB::raw('date_format(manifests.departured_at,"%Y%m")'),[$mesIni,$mesFin]
        )
        ->get();

        $tot_weight = $total->first()->weight;
        $ranking = array();
        foreach ($items->slice(0, $topRnk) as $item) {
            $ranking[] = array(
                'shipper' => $item->shipper,
                'weight' => round($item->weight/1000,0),
                'participation' => round($item->weight*100/$tot_weight,2)
            );
        }

        $otr_countr = $items->count() - $topRnk;
        if ($otr_countr > 0) {
            $otr_weight = 0;
            foreach ($items->slice($topRnk, $otr_countr) as $item) {
                $otr_weight += $item->weight;
            }
            $ranking[] = array(
                'shipper' => 'Otros',
                'weight' => round($otr_weight/1000,0),
                'participation' => round($otr_weight*100/$tot_weight,2)
            );
        }
        return json_encode($ranking);
    }

    public function countries(Request $request)
    {
        $product_id = $request->product_id;
        if ($this->verifyAuth($product_id)) return json_encode([]);
        
        $countries = Manifest::distinct()
        ->select(['countries.id','countries.name'])
        ->leftJoin('countries','countries.id','manifests.country_id')
        ->where('manifests.country_id','!=',null)
        ->where('manifests.product_id',$product_id)
        ->orderBy('countries.name')
        ->get();

        $array = array();
        foreach ($countries as $country) {
            $array[] = array(
                'id' => $country->id,
                'name' => $country->name
            );
        }
        return json_encode($array);
    }

    public function shippers(Request $request)
    {
        $product_id = $request->product_id;
        $country_id = $request->country_id;
        if ($this->verifyAuth($product_id)) return json_encode([]);

        $shippers = Manifest::distinct()
        ->select(['shippers.id','shippers.name'])
        ->leftJoin('shippers','shippers.id','manifests.shipper_id')
        ->where('manifests.shipper_id','!=',null)
        ->where('manifests.product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->orderBy('shippers.name')
        ->get();

        $array = array();
        foreach ($shippers as $shipper) {
            $array[] = array(
                'id' => $shipper->id,
                'name' => $shipper->name
            );
        }
        return json_encode($array);
    }

    public function consignees(Request $request)
    {
        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        if ($this->verifyAuth($product_id)) return json_encode([]);

        $consignees = Manifest::distinct()
        ->select(['consignees.id','consignees.name'])
        ->leftJoin('consignees','consignees.id','manifests.consignee_id')
        ->where('manifests.consignee_id','!=',null)
        ->where('manifests.product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->orderBy('consignees.name')
        ->get();

        $array = array();
        foreach ($consignees as $consignee) {
            $array[] = array(
                'id' => $consignee->id,
                'name' => $consignee->name
            );
        }
        return json_encode($array);
    }

    public function report()
    {
        $start_at = $minDate = Manifest::min('departured_at');
        $end_at = $maxDate = Manifest::max('departured_at');
        $product_id = $country_id = $shipper_id = $consignee_id = $title = '';
        $items = $dates = [];
        $detail = 'Diario';
        $download = false;

        return view('manifests.report', compact('items','dates','title','minDate','maxDate','download','product_id','country_id','shipper_id','consignee_id','detail','start_at','end_at'));
    }

    public function generate(Request $request)
    {
        $this->allslots = array('Diario','Semanal','Mensual','Anual');
        $this->validate($request, [
            'product_id' => 'required|numeric|min:1',
            'start_at' => 'required|date|before_or_equal:end_at',
            'end_at' => 'required|date|before_or_equal:today',
            'detail' => 'required|in:'.implode(',', $this->allslots),
        ], $this->validationErrorMessages());

        if ($this->verifyAuth($request->product_id)) return back()->with('error',self::MSG_NO_AUTH);

        ini_set('memory_limit','128M');
        $minDate = Manifest::min('departured_at');
        $maxDate = Manifest::max('departured_at');
        $product_id = $request->product_id;
        $country_id = $request->country_id;
        $shipper_id = $request->shipper_id;
        $consignee_id = $request->consignee_id;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $detail = $request->detail;
        $title = 'Exportación '.lcfirst($detail).' de '.Product::find($product_id)->name.' desde '.Carbon::parse($start_at)->format('d/m/Y').' hasta '.Carbon::parse($end_at)->format('d/m/Y').' (en kg)';
        $download = false;

        $manifests = Manifest::select([
            DB::raw('ifnull(countries.name,"[PAÍS DESTINO INDEFINIDO]") as country'),
            DB::raw('ifnull(shippers.name,"[EXPORTADOR INDEFINIDO]") as shipper'),
            DB::raw('ifnull(consignees.name,"[EMBARCADOR INDEFINIDO]") as consignee'),
            DB::raw('case 
                        when "'.$detail.'" = "Diario" then date_format(departured_at,"%Y/%m/%d")
                        when "'.$detail.'" = "Semanal" then date_format(departured_at,"%x%v")
                        when "'.$detail.'" = "Mensual" then date_format(departured_at,"%Y/%m/01")
                        when "'.$detail.'" = "Anual" then date_format(departured_at,"%Y")
                    end as detail'),
            DB::raw('sum(gross_weight) as weight')
        ])
        ->leftJoin('countries','countries.id','manifests.country_id')
        ->leftJoin('shippers','shippers.id','manifests.shipper_id')
        ->leftJoin('consignees','consignees.id','manifests.consignee_id')
        ->where('product_id',$product_id)
        ->where(function ($query) use ($country_id) {
            if ($country_id !== null)
                $query->where('country_id',$country_id);
            return $query;
        })
        ->where(function ($query) use ($shipper_id) {
            if ($shipper_id !== null)
                $query->where('shipper_id',$shipper_id);
            return $query;
        })
        ->where(function ($query) use ($consignee_id) {
            if ($consignee_id !== null)
                $query->where('consignee_id',$consignee_id);
            return $query;
        })
        ->where(function ($query) use ($start_at) {
            if ($start_at !== null)
                $query->where('departured_at','>=',$start_at);
            return $query;
        })
        ->where(function ($query) use ($end_at) {
            if ($end_at !== null)
                $query->where('departured_at','<=',$end_at);
            return $query;
        })
        ->groupBy([
            DB::raw('ifnull(countries.name,"[PAÍS DESTINO INDEFINIDO]")'),
            DB::raw('ifnull(shippers.name,"[EXPORTADOR INDEFINIDO]")'),
            DB::raw('ifnull(consignees.name,"[EMBARCADOR INDEFINIDO]")'),
            DB::raw('case 
                        when "'.$detail.'" = "Diario" then date_format(departured_at,"%Y/%m/%d")
                        when "'.$detail.'" = "Semanal" then date_format(departured_at,"%x%v")
                        when "'.$detail.'" = "Mensual" then date_format(departured_at,"%Y/%m/01")
                        when "'.$detail.'" = "Anual" then date_format(departured_at,"%Y")
                    end')
        ])
        ->orderByRaw(
            DB::raw('ifnull(countries.name,"[PAÍS DESTINO INDEFINIDO]")'),
            DB::raw('ifnull(shippers.name,"[EXPORTADOR INDEFINIDO]")'),
            DB::raw('ifnull(consignees.name,"[EMBARCADOR INDEFINIDO]")'),
            DB::raw('case 
                        when "'.$detail.'" = "Diario" then date_format(departured_at,"%Y/%m/%d")
                        when "'.$detail.'" = "Semanal" then date_format(departured_at,"%x%v")
                        when "'.$detail.'" = "Mensual" then date_format(departured_at,"%Y/%m/01")
                        when "'.$detail.'" = "Anual" then date_format(departured_at,"%Y")
                    end')
        )->get();
        /* obtenemos las fechas que serán cabecera de tabla */
        $dates = collect($manifests)->map->only(['detail'])->unique('detail')->sortBy('detail')->all();
        /* creamos un nuevo arreglo resumen */
        $items = array();
        /* procesamos cada manifiesto obtenido en la consulta SQL */
        foreach ($manifests as $manifest) {
            /* buscamos el manifiesto en el nuevo arreglo */
            if (!count($items) ||
                last($items)['country'] !== $manifest->country || 
                last($items)['shipper'] !== $manifest->shipper || 
                last($items)['consignee'] !== $manifest->consignee) {
                /* si no fue encontrado, lo agregamos */
                $item = array(
                    'country' => $manifest->country,
                    'shipper' => $manifest->shipper,
                    'consignee' => $manifest->consignee
                );
                foreach ($dates as $date)
                    $item[$date['detail']] = 0;
                $item['total'] = 0;
                $items[] = $item;
            }
            $ult = count($items) - 1;
            /* agregamos su peso en la fecha correspondiente */
            $items[$ult][$manifest->detail] += $manifest->weight;
            $items[$ult]['total'] += $manifest->weight;
        }

        if (count($dates) > 30) {
            session(['items' => $items]);
            session(['dates' => $dates]);
            session(['product_id' => $product_id]);
            session(['country_id' => $country_id]);
            session(['shipper_id' => $shipper_id]);
            session(['consignee_id' => $consignee_id]);
            session(['start_at' => $start_at]);
            session(['end_at' => $end_at]);
            session(['detail' => $detail]);
            $items = $dates = [];
            $download = true;
        }
        return view('manifests.report', compact('items','dates','title','minDate','maxDate','download','product_id','country_id','shipper_id','consignee_id','detail','start_at','end_at'));
    }

    public function download(Request $request)
    {
        $items = session('items', []);
        $dates = session('dates', []);
        $product_id = session('product_id', null);
        $country_id = session('country_id', null);
        $shipper_id = session('shipper_id', null);
        $consignee_id = session('consignee_id', null);
        $start_at = session('start_at', null);
        $end_at = session('end_at', null);
        $detail = session('detail', 'Sin definir');

        session()->flush();

        $product = Product::find($product_id)->name;
        $country = $country_id !== null ? Country::find($country_id)->name : 'Todos';
        $shipper = $shipper_id !== null ? Shipper::find($shipper_id)->name : 'Todos';
        $consignee = $consignee_id !== null ? Consignee::find($consignee_id)->name : 'Todos';
        $start_at = $request->start_at !== null ? Carbon::parse($request->start_at)->format('d/m/Y') : 'Sin definir';
        $end_at = $request->end_at !== null ? Carbon::parse($request->end_at)->format('d/m/Y') : 'Sin definir';

        $export = new InvoicesExport($items, $dates, $product, $country, $shipper, $consignee, $detail, $start_at, $end_at);
        return Excel::download($export, $product.'_reporte_'.Carbon::now()->format('d-m-Y').'.xlsx');
    }

    protected function verifyAuth($product_id)
    {
        return Auth::check() && !Auth::user()->products()->where('product_id',$product_id)->count();
    }

    protected function validationErrorMessages()
    {
        return [
            'product_id.required' => 'Debe ingresar el ID de producto.',
            'product_id.numeric' => 'El ID de producto ingresado no tiene un formato válido.',
            'product_id.min' => 'El ID de producto ingresado no es válido.',
            'numMes.required' => 'Debe ingresar un mes de inicio.',
            'numMes.numeric' => 'El mes de inicio ingresado no tiene un formato válido.',
            'numMes.min' => 'El mes de inicio ingresado debe está fuera del rango permitido.',
            'mesIni.required' => 'Debe ingresar el mes inicial.',
            'mesIni.numeric' => 'El mes inicial ingresado no tiene un formato válido.',
            'mesIni.min' => 'El mes de inicial ingresado no es válido.',
            'mesFin.required' => 'Debe ingresar el mes final.',
            'mesFin.numeric' => 'El mes final ingresado no tiene un formato válido.',
            'mesFin.min' => 'El mes final ingresado no es válido.',
            'topRnk.required' => 'Debe ingresar el top de ranking.',
            'topRnk.numeric' => 'El top de ranking ingresado no tiene un formato válido.',
            'topRnk.min' => 'El top de ranking ingresado no es válido.',
            'detail.required' => 'Debe ingresar un detalle.',
            'detail.in' => 'El detalle ingresado no es válido.',
            'start_at.required' => 'Debe ingresar una fecha inicial.',
            'start_at.before_or_equal' => 'La fecha inicial no puede ser posterior a la fecha final.',
            'end_at.required' => 'Debe ingresar una fecha final.',
            'end_at.before_or_equal' => 'La fecha final no puede ser posterior a la fecha actual.'
        ];
    }
}