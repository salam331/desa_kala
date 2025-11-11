<?php

namespace App\Http\Controllers;

use App\Models\WelcomeElement;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Mengambil semua elements yang aktif
        $elements = WelcomeElement::active()->get()->keyBy(function ($item) {
            return $item->element_type . '.' . $item->element_key;
        });

        // Mengelompokkan berdasarkan type
        $welcomeElements = [
            'navbar' => WelcomeElement::getElementsByType('navbar'),
            'hero' => WelcomeElement::getElementsByType('hero'),
            'profile' => WelcomeElement::getElementsByType('profile'),
            'location' => WelcomeElement::getElementsByType('location'),
            'agriculture' => WelcomeElement::getElementsByType('agriculture'),
            'culture' => WelcomeElement::getElementsByType('culture'),
            'footer' => WelcomeElement::getElementsByType('footer'),
        ];

        return view('welcome', compact('welcomeElements'));
    }
}
