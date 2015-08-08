<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input, Redirect;
use App\Job_def;
use App\Job_schedule;
use App\Job_log;

class JobController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('job.create'); 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request, [
            'name' => 'required|max:255',
            'command' => 'required|unique:job_def,command|max:1024',
            'type' => 'required|in:0,1',
            'priority' => 'required|digits_between:0,65536',
            'concurrent' => 'required|digits_between:0,10',
            'period' => 'required_if:type,0|max:1024',
            'maxtime' => 'required|digits_between:0,65536',
        ]);
        $job = new Job_def;
        $job->name = Input::get('name');
        $job->command = Input::get('command');
        $job->type = Input::get('type');
        $job->priority = Input::get('priority');
        $job->concurrent = Input::get('concurrent');
        $job->period = Input::get('period');
        $job->maxtime = Input::get('maxtime');
        $job->gmt_create = time();
        $job->gmt_modified = time();
        if ($job->save()) {
            return Redirect::to('/');
        } else {
            return Redirect::back()->withInput()->withErrors('添加失败，请稍后再试！');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
    {
        $job = Job_def::find($id);
        if (!$job) {
            return view('errors.404');
        }
		return view('job.edit')->with('job', $job);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'name' => 'required|max:255',
            'command' => 'required|max:1024',
            'type' => 'required|in:0,1',
            'priority' => 'required|digits_between:0,65536',
            'concurrent' => 'required|digits_between:0,10',
            'period' => 'required_if:type,0|max:1024',
            'maxtime' => 'required|digits_between:0,65536',
        ]);
        $job = Job_def::find($id);
        if (!$job) {
            return view('errors.404');
        }
        if ($job->update(Input::except(['_token']))) {
            return Redirect::to('/');
        } else {
            return Redirect::to('job.edit')->with('job', $job)->withErrors('更新失败！');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $job = Job_def::find($id);
        if ($job) {
            $job->delete();
        }
        return Redirect::to('/');
    }

    public function schedule($id)
    {
        $job = Job_def::find($id);
        if (!$job) {
            return view('errors.404');
        }
        $job_schedules = Job_schedule::where('job_id', $id)->get();
        return view('job.schedule')->with('job', $job)->with('schedules', $job_schedules);
    }

    public function log($schedule_id) {
        $schedule = Job_schedule::find($schedule_id);
        if (!$schedule) {
            return view('errors.404');
        }
        $job = Job_def::find($schedule->job_id);
        $logs = Job_log::where('schedule_id', $schedule_id)->get();
        return view('job.log')->with('job', $job)->with('schedule', $schedule)->with('logs', $logs);
    }

}
