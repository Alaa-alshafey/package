<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class contactController extends Controller
{
    use ApiResponses;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'message' => 'required|string',
        ];
        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) return $validation;
                $request['user_id'] = auth()->id();
                Contact::create($request->all());
            return $this->apiResponse(__('messages.success_msg_sent'));
    }

}
