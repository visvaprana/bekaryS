<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AreaImport;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('city_id', 1)->where('status', 1)->get();
        $cities = City::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        return view('admin.area.index', compact('cities', 'countries', 'areas'));
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
        $validatedData = $request->validate([
            'country_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|unique:areas',
            'postcode' => 'required|unique:areas',
            'shipping_charge' => 'required',
            'urgent_charge' => 'required',
            'status' => 'required',
        ]);

        $area = new Area();
        $area->country_id = $request->country_id;
        $area->city_id = $request->city_id;
        $area->name = $request->name;
        $area->slug = Str::slug($request->name);
        $area->postcode = $request->postcode;
        $area->shipping_charge = $request->shipping_charge;
        $area->urgent_charge = $request->urgent_charge;
        $area->status = $request->status;
        $area->save();

        $notification=array(
            'message' => 'Area Saved Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
        $data = Area::findorfail($id);
        $countries = Country::where('status', 1)->get();
        $cities = City::where('country_id', $data->country_id)->where('status', 1)->get();
        return view('admin.area.edit', compact( 'countries', 'data', 'cities'));
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
        $area = Area::findorfail($id);
        $area->country_id = $request->country_id;
        $area->city_id = $request->city_id;
        $area->name = $request->name;
        $area->slug = Str::slug($request->name);
        $area->postcode = $request->postcode;
        $area->shipping_charge = $request->shipping_charge;
        $area->urgent_charge = $request->urgent_charge;
        $area->status = $request->status;
        $area->save();

        $notification=array(
            'message' => 'Area Updated Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findorfail($id);
        $area->delete();
        $notification=array(
            'message' => 'Area Deleted Successfully !!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }


    public function get_city(Request $request){
        $cities = City::where('country_id', $request->country_id)->get();
        return view('admin.area.get_city',compact('cities'));
    }

    public function get_area(Request $request){
        $areas = Area::where('city_id', $request->city_id)->get();
        return view('admin.area.get_area',compact('areas'));
    }

    public function import_area()
    {
        return view('admin.area.import_area');
    }

    public function import_area_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = request()->file('file')->store('import');
            $import = new AreaImport;
            $import->import($file);

            session()->flash('notif', "Imported Done ...");
            return redirect()->back();
        }
    }
    
    public function delete_all_area()
    {

        
        Area::query()->delete();

        
        $notification=array(
            'message' => 'Area Deleted Successfully !!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }    
    

}
