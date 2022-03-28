<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'MyWebsite'
        ];
        return view('Pages/Home', $data);
    }

    public function About()
    {
        $data = [
            'title' => 'About Page'
        ];
        return view('Pages/About', $data);
    }

    public function Contact()
    {
        $data = [
            'title' => 'About Page',
            'Alamat' => [
                [
                    'Tipe' => 'Rumah',
                    'Alamat' => 'Desa Boyabaliase',
                    'Kota' => 'Palu'
                ],
                [
                    'Tipe' => 'Kantor',
                    'Alamat' => 'Jalur Dua',
                    'Kota' => 'Palu'
                ]
            ]
        ];
        return view('Pages/Contact', $data);
    }
}
