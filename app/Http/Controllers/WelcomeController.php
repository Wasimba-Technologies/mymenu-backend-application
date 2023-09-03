<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View{
        $features = [
            (object)array (
                'name' => 'Create a Digital Menu',
                'href' => '#',
                'button' => 'Experience it',
                'description' => 'Create your menu directly on our platform. Update anytime. Easy And Simple',
                'includedFeatures' =>
                    array (
                        0 => 'Real-time changes',
                        1 => 'Organize into categories',
                        2 => 'Extras and items variants',
                    ),
            ),

            (object)array (
                'name' => 'Create QR',
                'href' => '#',
                'button' => 'Design it',
                'description' => '8 different designs. Unlimited color options. Choose QR and Flayer style.',
                'includedFeatures' =>
                    array (
                        0 => 'Beautiful QR Styles',
                        1 => 'Pick QR Color',
                        2 => 'Print templates for download',
                    ),
            ),
            (object)array (
                'name' => 'Go Digital',
                'href' => '#',
                'button' => 'Go mobile',
                'description' => 'Now your visitors will use their mobile phone camera to access your menu.',
                'includedFeatures' =>
                    array (
                        0 => 'No mobile app requirose',
                        1 => 'Super-fast online menu - PWA',
                        2 => 'View analytics',
                    ),
            ),
            (object)array (
                'name' => 'Accept local orders',
                'href' => '#',
                'button' => 'Try it',
                'description' => 'Your customers can order direclty from their phone',
                'includedFeatures' =>
                    array (
                        0 => 'Real-time sound notifications',
                        1 => 'Continuous orders',
                        2 => 'Unlimited options, variants and extras',
                    ),
            ),
            (object)array (
                'name' => 'Accept payments',
                'href' => '#',
                'button' => 'Accept countactless payments',
                'description' => 'Your customers can pay order directly via card or mobile money',
                'includedFeatures' =>
                    array (
                        0 => 'Accept and Croseit and Debit Card ',
                        1 => 'All mobile money payments accepted',
                        2 => 'Secure online payments',
                        3 => 'Print receipt',
                    ),
            ),
            (object)array (
                'name' => 'Customer Log',
                'href' => '#',
                'button' => 'Retain your customers',
                'description' => 'Know all your potential customers for easy contact and retantion.',
                'includedFeatures' =>
                    array (
                        0 => 'Customers can reguster them selfs',
                        1 => 'Manage the visits on your own',
                        2 => 'Customer relationship management (CRM)',
                    ),
            ),
        ];

        return view('welcome',['features'=>$features]);
    }
}
