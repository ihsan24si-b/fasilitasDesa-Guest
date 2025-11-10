<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Jika perlu authentication, bisa ditambahkan seperti di DashboardController
        // if (!session('admin_logged_in')) {
        //     return redirect()->route('auth.index')
        //                    ->with('error', 'Silakan login terlebih dahulu!');
        // }

        return view('layouts.guest.homepage');
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        return view('pages.about'); // atau return view('about');
    }

    /**
     * Show the services page.
     */
    public function services()
    {
        return view('homepage.services'); // atau return view('services');
    }

    /**
     * Show the projects page.
     */
    public function projects()
    {
        return view('homepage.projects'); // atau return view('projects');
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('homepage.contact'); // atau return view('contact');
    }

    /**
     * Show the team page.
     */
    public function team()
    {
        return view('homepage.team'); // atau return view('team');
    }

    /**
     * Show the testimonial page.
     */
    public function testimonial()
    {
        return view('homepage.testimonial'); // atau return view('testimonial');
    }

    /**
     * Handle newsletter subscription.
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Logic untuk menyimpan email newsletter
        // Contoh: Newsletter::create(['email' => $request->email]);

        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }

    /**
     * Show the features page.
     */
    public function features()
    {
        return view('homepage.features'); // atau return view('features');
    }

    /**
     * Show the 404 page.
     */
    public function notFound()
    {
        return view('homepage.404'); // atau return view('404');
    }
}
