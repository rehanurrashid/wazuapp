<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePlan;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $plan = Plan::select(['id', 'name', 'duration','price','description' ,'created_at', 'updated_at']);
            return Datatables::of($plan)
                ->addColumn('action', function ($plan) {
                    return view('manage.actions.actions_plan',compact('plan'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('manage.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlan $request)
    {
        $plan = new Plan;
        $plan->name = $request->name;
        $plan->duration = $request->duration;
        $plan->price = $request->price;
        $plan->description = $request->description;
        $plan->save();

        if($plan){
            Session::flash('message', 'Plan Created Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('plans');
        }
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
        $plan = Plan::find($id);
        return view('manage.plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePlan $request, $id)
    {
        $plan = Plan::find($id);
        $plan->name = $request->name;
        $plan->duration = $request->duration;
        $plan->price = $request->price;
        $plan->description = $request->description;
        $plan->save();

        if($plan){
            Session::flash('message', 'Plan Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('plans');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $plan = Plan::find($id)->delete();
        if($plan){
            return view('manage.plan.index');
        }
    }
}
