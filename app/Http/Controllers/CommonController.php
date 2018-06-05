<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use Config;
use Log;

class CommonController extends Controller
{
    public function contactUs(Request $request) {
        $validator = Validator::make( $request->all(), [
            'fullname'          => 'required',
            'email'             => 'required|email',
            'content'           => 'required',
        ], []);
        
        if ($validator->fails()) {
            return response()->json([ 'error' => $validator->errors()->all() ], Config::get('app.http.validation'));
        } else {
            try {
                Log::debug('Name: '.$request->get('fullname').' Email: '.$request->get('email').' Phone: '.$request->get('phone').' Message: '.$request->get('content'));
                // Ultimate Guide on Sending Email in Laravel
                // https://scotch.io/tutorials/ultimate-guide-on-sending-email-in-laravel
                Mail::send( 'contact', [ 'phone' => $request->get('phone'), 'contentMessage' => $request->get('content') ], function($mail) use($request) {
                    $mail->from( $request->get('email'), $request->get('fullname') );
                    $mail->to( env('MAIL_FROM_ADDRESS', 'it.help@okcc.ca'), env('MAIL_FROM_NAME', 'OKCC Admin') );
                    $mail->subject( 'Contact Message from OKCC Home' );
                });
                return response()->json([ 'message' => 'Thank you for your message.' ], Config::get('app.http.success'));
            } catch (Exception $e) {
                return response()->json([ 'error' => $e->getMessage() ], $e->getCode());
            }
        }
    }

    public function getMenu() {
        $menu = [
            [ 'title' => trans('messages.menu.welcome'), 'url' => '', 'anchor' => '#', 
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#services' ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#portfolio' ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location' ],
                    [ 'title' => trans('messages.menu.facility'), 'url' => route('/'), 'anchor' => '#team' ],
                    [ 'title' => trans('messages.menu.school'), 'url' => route('/'), 'anchor' => '#client' ],
                    [ 'title' => trans('messages.menu.contact'), 'url' => route('/'), 'anchor' => '#contact' ],
                ]
            ],
            [ 'title' => trans('messages.menu.intro'), 'url' => '', 'anchor' => '#',  
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#contact' ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#portfolio' ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location' ],
                    [ 'title' => trans('messages.menu.facility'), 'url' => route('/'), 'anchor' => '#facility' ],
                    [ 'title' => trans('messages.menu.school'), 'url' => route('/'), 'anchor' => '#school' ]
                ]
            ],
            [ 'title' => trans('messages.menu.discipline'), 'url' => '', 'anchor' => '#',  
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#newcomer' ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#event' ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location' ],
                    [ 'title' => trans('messages.menu.facility'), 'url' => route('/'), 'anchor' => '#facility' ],
                    [ 'title' => trans('messages.menu.school'), 'url' => route('/'), 'anchor' => '#school' ]
                ]
            ],
            [ 'title' => trans('messages.menu.mission'), 'url' => '', 'anchor' => '#', 
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#newcomer' ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#event' ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location' ],
                    [ 'title' => trans('messages.menu.facility'), 'url' => route('/'), 'anchor' => '#facility' ],
                    [ 'title' => trans('messages.menu.school'), 'url' => route('/'), 'anchor' => '#school' ]
                ]
            ],
            [ 'title' => trans('messages.menu.koinonia'), 'url' => '', 'anchor' => '#',  
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#newcomer' ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#event' ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location' ],
                    [ 'title' => trans('messages.menu.facility'), 'url' => route('/'), 'anchor' => '#facility' ],
                    [ 'title' => trans('messages.menu.school'), 'url' => route('/'), 'anchor' => '#school' ]
                ]
            ]
        ];
        $result = array( "menu" => json_decode( json_encode($menu), true ) );
        return response()->json( $result );
    }
}
