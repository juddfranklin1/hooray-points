<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Action::orderBy('id')->get()->load('assignee');
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
        $action = new Action;
        $action->name = $request->name;
        $action->description = $request->description;
        $action->value = $request->value;
        $action->assignee_id = $request->assignee_id;
        $action->save();
        return $action;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        return Action::firstOrFail($action);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $action)
    {
        $action = Action::findOrFail($action);
        // Accept request details and update the Action accordingly.
        $action->name = $request->name;
        $action->description = $request->description;
        $action->value = $request->value;
        $action->assignee_id = $request->assignee_id ?? null;
        $action->save();
        return $action;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $action - id passed into the path
     * @return \Illuminate\Http\Response
     */
    public function destroy($action)
    {
        $actionItem = Action::find($action);
        $actionItem->delete();
        return $action;
    }
}
