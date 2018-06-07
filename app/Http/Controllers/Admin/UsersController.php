<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SystemLog;
use Validator;
use Config;
use Log;

use App\User;
class UsersController extends Controller
{
    private $TABLE_NAME = "USERS";

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        $result = array("data" => json_decode(json_encode($users),true));

        return response()->json($result);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $targetUpdate  = User::findOrFail( $id );
        $input = $request->all();

        $validator = Validator::make( $input, [
            'name'              => 'required',
            'email'             => 'required|email',
            'privilege'         => 'required',
        ], []);
        
        if ($validator->fails()) {
            return response()->json([ 'error' => $validator->errors()->all() ], Config::get('app.http.validation'));
        } else {
            try {
                SystemLog::createLogForUpdate($this->TABLE_NAME, $id, $targetUpdate, $input, null);
                $resultRecord = $targetUpdate->fill($input)->save();
                return response()->json([ 'result' => $resultRecord ], Config::get('app.http.success'));
            } catch (Exception $e) {
                return response()->json([ 'error' => $e->getMessage() ], $e->getCode());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $targetDelete  = User::findOrFail( $id );
            SystemLog::createLogForDelete($this->TABLE_NAME, $targetDelete);
            $targetDelete->delete();
            return response()->json([ 'message' => 'DELETED!' ], Config::get('app.http.success'));
        } catch (Exception $e) {
            return response()->json([ 'error' => $e->getMessage() ], $e->getCode());
        }
    }
}
