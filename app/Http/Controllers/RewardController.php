<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{ User, Reward, RewardUser };

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reward::orderBy('id')->get()->load('assignee');
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
        $reward = new Reward;
        $reward->cost = $request->cost;
        $reward->title = $request->title;
        $reward->description = $request->description;
        $reward->assignee_id = $request->assignee_id;
        $reward->save();
        return $reward->load('assignee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        return Reward::firstOrFail($reward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reward)
    {
        $reward = Reward::findOrFail($reward);
        // Accept request details and update the Reward accordingly.
        $reward->title = $request->title;
        $reward->description = $request->description;
        $reward->cost = $request->cost;
        $reward->assignee_id = $request->assignee_id ?? null;
        $reward->save();
        return $reward;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy($reward)
    {
        $rewardItem = Reward::find($reward);
        $rewardItem->delete();
        return $reward;
    }

    /**
     * Generate Voucher PDF for a given Reward
     */
    public function generateVoucher($id) {
        $rewardUser = RewardUser::find($id);
        // share data to view
        $user = $rewardUser->user;
        $reward = $rewardUser->reward;

        // test view in browser
        // return view('voucher', compact('reward', 'user', 'rewardUser'));

        if($rewardUser->voucher_printed === FALSE){
            $pdf = PDF::loadView('voucher', compact('reward', 'user', 'rewardUser'));

            $rewardUser->voucher_printed = TRUE;
            $rewardUser->save();
            // download PDF file with download method
            $time = \Carbon\Carbon::now()->toDayDateTimeString();
            $time = str_replace(',,', ',', $time);
            $filename = Str::snake($user->name . ' ' . $time . ' voucher.pdf');
            return $pdf->setPaper('a4', 'landscape')->download($filename);
        } else {
            return redirect()->back()->with('error', 'The voucher for this reward has already been printed.');
        }

    }
}
