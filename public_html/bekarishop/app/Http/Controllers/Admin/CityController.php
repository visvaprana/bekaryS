<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CityImport;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();
        $countries = Country::where('status', 1)->get();
        return view('admin.city.index', compact('cities', 'countries'));
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
        $validatedData = $request->validate([
            'country_id' => 'required',
            'name' => 'required|unique:cities',
            'status' => 'required',
        ]);

        $city = new City();
        $city->country_id = $request->country_id;
        $city->name = $request->name;
        $city->slug = Str::slug($request->name);
        $city->status = $request->status;
        $city->save();

        $notification=array(
            'message' => 'City Saved Successfully !!',
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
        $countries = Country::where('status', 1)->get();
        $data = City::findorfail($id);
        return view('admin.city.edit', compact( 'countries', 'data'));
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
        $city = City::findorfail($id);
        $city->country_id = $request->country_id;
        $city->name = $request->name;
        $city->slug = Str::slug($request->name);
        $city->status = $request->status;
        $city->save();

        $notification=array(
            'message' => 'City Updated Successfully !!',
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
        $city = City::findorfail($id);
        $city->delete();
        $notification=array(
            'message' => 'City Deleted Successfully !!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function import_city()
    {
        return view('admin.city.import_city');
    }

    public function import_city_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = request()->file('file')->store('import');
            $import = new CityImport;
            $import->import($file);

            session()->flash('notif', "Imported Done ...");
            return redirect()->back();
        }
    }


}
