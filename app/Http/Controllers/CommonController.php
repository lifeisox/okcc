<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use Config;
use Log;

class CommonController extends Controller
{
    /**
     * Send a contact email for an incoming request.
     * @param Request $request
     * @return \Illuminate\Http\Response Set the Content-Type header to application/json, Convert the array to JSON using the PHP json_encode
     */
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

    /**
     * Get top menu for the Website
     * @return \Illuminate\Http\Response Set the Content-Type header to application/json, Convert the array to JSON using the PHP json_encode
     */
    public function getMenu() {
        $menu = [
            [ 'title' => trans('messages.menu.welcome'), 'url' => '', 'anchor' => '#', 'roles' => ['ALL'],
                'submenus' => [
                    [ 'title' => trans('messages.menu.newcomer'), 'url' => route('/'), 'anchor' => '#newcomer', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#event', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.parking'), 'url' => route('/'), 'anchor' => '#parking', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.contact'), 'url' => route('/'), 'anchor' => '#contact', 'roles' => ['ALL'] ],
                ]
            ],
            [ 'title' => trans('messages.menu.intro'), 'url' => '', 'anchor' => '#', 'roles' => ['ALL'],
                'submenus' => [
                    [ 'title' => trans('messages.menu.greeting'), 'url' => route('/'), 'anchor' => '#greeting', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.vision'), 'url' => route('/'), 'anchor' => '#vision', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.team'), 'url' => route('/'), 'anchor' => '#team', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.history'), 'url' => route('/'), 'anchor' => '#history', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.event'), 'url' => route('/'), 'anchor' => '#event', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.location'), 'url' => route('/'), 'anchor' => '#location', 'roles' => ['ALL'] ]
                ]
            ],
            [ 'title' => trans('messages.menu.service'), 'url' => '', 'anchor' => '#', 'roles' => ['ALL'],  
                'submenus' => [
                    [ 'title' => trans('messages.menu.bulletin'), 'url' => route('/'), 'anchor' => '#bulletin', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.sermon1'), 'url' => route('/'), 'anchor' => '#sermon1', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.sermon2'), 'url' => route('/'), 'anchor' => '#sermon2', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.blog'), 'url' => route('/'), 'anchor' => '#blog', 'roles' => ['ALL'] ]
                ]
            ],
            [ 'title' => trans('messages.menu.school'), 'url' => '', 'anchor' => '#', 'roles' => ['ALL'], 
                'submenus' => [
                    [ 'title' => trans('messages.menu.ainos'), 'url' => route('/'), 'anchor' => '#ainos', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.pilloy'), 'url' => route('/'), 'anchor' => '#pilloy', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.youth'), 'url' => route('/'), 'anchor' => '#youth', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.bahurim'), 'url' => route('/'), 'anchor' => '#bahurim', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.mosaic'), 'url' => route('/'), 'anchor' => '#mosaic', 'roles' => ['ALL'] ]
                ]
            ],
            [ 'title' => trans('messages.menu.mission'), 'url' => '', 'anchor' => '#', 'roles' => ['ALL'],  
                'submenus' => [
                    [ 'title' => trans('messages.menu.aboriginal'), 'url' => route('/'), 'anchor' => '#aboriginal', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.nicaragua'), 'url' => route('/'), 'anchor' => '#nicaragua', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.haiti'), 'url' => route('/'), 'anchor' => '#haiti', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.homeless'), 'url' => route('/'), 'anchor' => '#homeless', 'roles' => ['ALL'] ],
                    [ 'title' => trans('messages.menu.farm'), 'url' => route('/'), 'anchor' => '#farm', 'roles' => ['ALL'] ]
                ]
            ],
            [ 'title' => trans('messages.menu.koinonia'), 'url' => '', 'anchor' => '#', 'roles' => ['0', '1', '10'],  
                'submenus' => [
                    [ 'title' => trans('messages.menu.law'), 'url' => route('/'), 'anchor' => '#law', 'roles' => ['0', '1', '10'] ],
                    [ 'title' => trans('messages.menu.notice'), 'url' => route('/'), 'anchor' => '#notice', 'roles' => ['0', '1', '10'] ],
                    [ 'title' => trans('messages.menu.album'), 'url' => route('/'), 'anchor' => '#album', 'roles' => ['0', '1', '10'] ],
                    [ 'title' => trans('messages.menu.storage'), 'url' => route('/'), 'anchor' => '#storage', 'roles' => ['0', '1', '10'] ]
                ]
            ]
        ];
        $result = array( "menu" => json_decode( json_encode($menu), true ) );
        return response()->json( $result );
    }

    /**
     * Get Admin menu (top, side) for the Website
     * @return \Illuminate\Http\Response Set the Content-Type header to application/json, Convert the array to JSON using the PHP json_encode
     */
    public function getAdminMenu() {
        $menu = array(
            [ 'key' => 'officer', 'data' => $this->getOfficerMenu(), ],
            [ 'key' => 'super', 'data' => $this->getSuperAdminMenu(), ],
        );
        $result = array( "menu" => json_decode( json_encode($menu), true ) );
        return response()->json( $result );
    }

    /**
     * Get Officer menu (top, side) of Admin for the Website
     * @return \Illuminate\Http\Response Set the Content-Type header to application/json, Convert the array to JSON using the PHP json_encode
     */
    private function getOfficerMenu() {
        return array([
            'icon' => 'fa-chess-queen',
            'text' => trans('admin.menu.officer'),
            'route' => route('admin.officer'),
            'isOpened' => true,
            'roles' => ['0', '1'],
            'sub_menu' => array(
                [
                    'icon' => 'fa-user-cog',
                    'text' =>  trans('admin.menu.user'),
                    'route' => route('admin.users.start'),
                    'isOpened' => false,
                    'roles' => ['0', '1'],
                    'sub_menu' => null,
                ],
            ),
        ]);
    }
    
    /**
     * Get Super Admin menu (top, side) of Admin for the Website
     * @return \Illuminate\Http\Response Set the Content-Type header to application/json, Convert the array to JSON using the PHP json_encode
     */
    private function getSuperAdminMenu() {
        return array([
            'icon' => 'fa-chess-king',
            'text' => trans('admin.menu.super'),
            'route' => route('admin.super'),
            'isOpened' => false,
            'roles' => ['0'],
            'sub_menu' => null,
        ]);
    }
}
