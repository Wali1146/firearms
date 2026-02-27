<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\TeamModel;

class Home extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $teamModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Rhys Firearms | Premium Firearms & Accessories',
            'featured_products' => $this->productModel->limit(6)->findAll(),
            'categories' => $this->categoryModel->getOrdered(),
            'teams' => $this->teamModel->findAll()
        ];

        return view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us - Rhys Firearms',
            'teams' => $this->teamModel->findAll()
        ];

        return view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us - Rhys Firearms'
        ];

        if ($this->request->getMethod() === 'post') {
            // Handle contact form submission
            $rules = [
                'name' => 'required|min_length[2]|max_length[100]',
                'email' => 'required|valid_email',
                'subject' => 'required|min_length[5]|max_length[200]',
                'message' => 'required|min_length[10]|max_length[1000]'
            ];

            if ($this->validate($rules)) {
                // Process contact form (you would typically send email here)
                session()->setFlashdata('success', 'Thank you for your message. We will get back to you soon!');
                return redirect()->to('/contact');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('home/contact', $data);
    }

    public function services()
    {
        $data = [
            'title' => 'Our Services - Rhys Firearms',
            'services' => $this->productModel->getByType('course'),
            'subscriptions' => $this->productModel->getByType('subscription')
        ];

        return view('home/index', $data);
    }
}