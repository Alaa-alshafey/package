<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\SingleScheduleResource;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\ScheduleOperation;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    use ApiResponses,ScheduleOperation;


    public function index()
    {
        $schedules = Schedule::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        $schedules = new ScheduleResource($schedules);
        return $this->apiResponse($schedules);
    }



    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return $this->notFoundResponse();
        $schedules = Schedule::where('user_id',$id)->paginate($this->paginateNumber);
        $schedules = new ScheduleResource($schedules);
        return $this->apiResponse($schedules);
    }

    public function store(Request $request)
    {
        $request['user_id'] =auth()->user()->id;
        $rules = [
            'date'    =>'required|string',
            'from'  =>'required|string',
            'to'  =>'required|string',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $schedule =$this->RegisterSchedule($request);
        $schedule = new SingleScheduleResource($schedule);

        if ($schedule) {return $this->createdResponse($schedule);}
        $this->unKnowError();
    }

    public function update(Request $request,$id)
    {
        $schedule = Schedule::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$schedule) return $this->notFoundResponse();

        $rules = [
            'date'    =>'required|string',
            'from'  =>'required|string',
            'to'  =>'required|string',
            ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $this->UpdateSchedule($schedule,$request);
        $schedule = new SingleScheduleResource($schedule);
        if ($schedule) {return $this->apiResponse($schedule);}
        $this->unKnowError();
    }

    public function destroy($id)
    {
        $schedule = Schedule::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if (!$schedule) return $this->notFoundResponse();
        $schedule->delete();
        return $this->apiResponse(__('messages.success_delete'));
        }
}
