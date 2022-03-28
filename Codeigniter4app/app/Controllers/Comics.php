<?php

namespace App\Controllers;

use App\Models\ComicsModel;

class Comics extends BaseController
{
    public function __construct()
    {
        $this->ComicsModel = new ComicsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Comic List',
            'Comics' => $this->ComicsModel->getComic()
        ];
        // $ComicsModel = new \app\Models\ComicsModel();   
        return view('Comics/index', $data);
    }

    public function details($slug)
    {
        $data = [
            'title' => 'Details Comic',
            'Comics' => $this->ComicsModel->getComic($slug)
        ];

        if (empty($data['Comics'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data ' . $slug . 'Tidak Ditemukan.');
        }

        return view('Comics/Details', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Add Data',
            'validation' => \Config\Services::validation()
        ];
        return view('Comics/Create', $data);
    }

    public function save()
    {
        //Validation
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[Comics.title]',
                'errors' => [
                    'required' => '{field} comic must be filled.',
                    'is_unique' => 'this comic already exists.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Comics/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->ComicsModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $this->request->getVar('cover')
        ]);

        session()->setFlashdata('Message', 'data added successfully');

        return redirect()->to('/Comics');
    }

    public function delete($id)
    {
        $this->ComicsModel->delete($id);
        session()->setFlashdata('Message', 'data deleted successfully');
        return redirect()->to('/Comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Data',
            'validation' => \Config\Services::validation(),
            'Comics' => $this->ComicsModel->getComic($slug)
        ];
        return view('Comics/edit', $data);
    }

    public function update($id)
    {
        $pastdatacomic = $this->ComicsModel->getComic($this->request->getVar('slug'));
        if ($pastdatacomic['title'] == $this->request->getVar('title')) {
            $title_rule = 'required';
        } else {
            $title_rule = 'required|is_unique[Comics.title]';
        }

        //Validation
        if (!$this->validate([
            'title' => [
                'rules' => $title_rule,
                'errors' => [
                    'required' => '{field} comic must be filled.',
                    'is_unique' => 'this comic already exists.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Comics/edit' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->ComicsModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $this->request->getVar('cover')
        ]);

        session()->setFlashdata('Message', 'data edited successfully');

        return redirect()->to('/Comics');
    }
}
