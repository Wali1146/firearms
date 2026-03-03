<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\TeamModel;
use App\Models\OrderModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $categoryModel;
    protected $teamModel;
    protected $orderModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->teamModel = new TeamModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Admin Dashboard - Rhys Firearms',
            'total_users' => $this->userModel->countAll(),
            'total_products' => $this->productModel->countAll(),
            'total_orders' => $this->orderModel->countAll(),
            'pending_orders' => $this->orderModel->where('status', 'pending')->countAllResults(),
            'recent_orders' => $this->orderModel->getOrdersWithUser(null, 5)
        ];

        return view('admin/dashboard', $data);
    }

    public function users()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'User Management - Rhys Firearms',
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users', $data);
    }

    public function products()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Product Management - Rhys Firearms',
            'products' => $this->productModel->getProductsWithDetails(),
            'categories' => $this->categoryModel->findAll(),
            'teams' => $this->teamModel->findAll()
        ];

        return view('admin/products', $data);
    }

    public function orders()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Order Management - Rhys Firearms',
            'orders' => $this->orderModel->getOrdersWithUser()
        ];

        return view('admin/orders', $data);
    }

    public function createProduct()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Create Product - Rhys Firearms',
            'categories' => $this->categoryModel->findAll(),
            'teams' => $this->teamModel->findAll()
        ];

        return view('admin/createProducts', $data);
    }

    public function saveProduct()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'category_id' => $this->request->getPost('category_id'),
            'team_id' => $this->request->getPost('team_id'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        // dd($data);

        if (!$this->productModel->save($data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to create product. Please check the input and try again.');
        }

        return redirect()->to('/admin/products')->with('success', 'Product created successfully.');
    }

    public function editProduct($id)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $product = $this->productModel->getProductWithDetails($id);
        if (!$product) {
            return redirect()->to('/admin/products')->with('error', 'Product not found.');
        }

        $data = [
            'title' => 'Edit Product - Rhys Firearms',
            'product' => $product,
            'categories' => $this->categoryModel->findAll(),
            'teams' => $this->teamModel->findAll()
        ];

        return view('admin/editProduct', $data);
    }

    public function updateProduct($id)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'category_id' => $this->request->getPost('category_id'),
            'team_id' => $this->request->getPost('team_id'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description')
        ];

        if (!$this->productModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update product. Please check the input and try again.');
        }

        return redirect()->to('/admin/products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        if (!$this->productModel->delete($id)) {
            return redirect()->to('/admin/products')->with('error', 'Failed to delete product. Please try again.');
        }

        return redirect()->to('/admin/products')->with('success', 'Product deleted successfully.');
    }
}