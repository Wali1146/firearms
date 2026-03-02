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

        if ($this->request->getMethod() === 'post') {
            $rules = $this->productModel->validationRules;

            if ($this->validate($rules)) {
                $productData = [
                    'name' => $this->request->getPost('name'),
                    'type' => $this->request->getPost('type'),
                    'category_id' => $this->request->getPost('category_id'),
                    'team_id' => $this->request->getPost('team_id'),
                    'price' => $this->request->getPost('price'),
                    'description' => $this->request->getPost('description')
                ];

                if ($this->productModel->insert($productData)) {
                    session()->setFlashdata('success', 'Product created successfully');
                    return redirect()->to('/admin/products');
                } else {
                    session()->setFlashdata('error', 'Failed to create product');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/products', $data);
    }

    public function editProduct($id)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $product = $this->productModel->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Product - Rhys Firearms',
            'product' => $product,
            'categories' => $this->categoryModel->findAll(),
            'teams' => $this->teamModel->findAll()
        ];

        if ($this->request->getMethod() === 'post') {
            $rules = $this->productModel->validationRules;

            if ($this->validate($rules)) {
                $productData = [
                    'name' => $this->request->getPost('name'),
                    'type' => $this->request->getPost('type'),
                    'category_id' => $this->request->getPost('category_id'),
                    'team_id' => $this->request->getPost('team_id'),
                    'price' => $this->request->getPost('price'),
                    'description' => $this->request->getPost('description')
                ];

                if ($this->productModel->update($id, $productData)) {
                    session()->setFlashdata('success', 'Product updated successfully');
                    return redirect()->to('/admin/products');
                } else {
                    session()->setFlashdata('error', 'Failed to update product');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/edit_product', $data);
    }

    public function deleteProduct($id)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        if ($this->productModel->delete($id)) {
            session()->setFlashdata('success', 'Product deleted successfully');
        } else {
            session()->setFlashdata('error', 'Failed to delete product');
        }

        return redirect()->to('/admin/products');
    }

    public function setupImages()
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();
        $result = [];

        try {
            // Check if image column exists
            $fields = $db->getFieldData('products');
            $columnExists = false;
            
            foreach ($fields as $field) {
                if ($field->name === 'image') {
                    $columnExists = true;
                    break;
                }
            }

            if (!$columnExists) {
                // Add image column
                $db->query("ALTER TABLE products ADD COLUMN image VARCHAR(255) NULL DEFAULT NULL AFTER description");
                $result['column_added'] = true;
            } else {
                $result['column_exists'] = true;
            }

            // Mapping of product names to image filenames
            $imageMap = [
                'R-15 Tactical Rifle' => 'r15-tactical-rifle.jpg',
                'R-10 Compact Rifle' => 'r10-compact-rifle.jpg',
                'R-700 Bolt Action' => 'r700-bolt-action.jpg',
                'RS-12 Shotgun' => 'rs12-shotgun.jpg',
                'RP-9 Pistol' => 'rp9-pistol.jpg',
                'RP-45 Pistol' => 'rp45-pistol.jpg',
                'Basic Firearms Training' => 'basic-firearms-training.jpg',
                'Advanced Tactical Training' => 'advanced-tactical-training.jpg',
                'Concealed Carry Certification' => 'concealed-carry-certification.jpg',
                'Annual Range Membership' => 'annual-range-membership.jpg',
                'Premium Gunsmith Service' => 'premium-gunsmith-service.jpg',
            ];

            // Update products with image filenames
            $updated = 0;
            foreach ($imageMap as $productName => $imageName) {
                $db->query("UPDATE products SET image = ? WHERE name = ? AND (image IS NULL OR image = '')", 
                         [$imageName, $productName]);
                $updated += $db->affectedRows();
            }

            $result['success'] = true;
            $result['products_updated'] = $updated;
            session()->setFlashdata('success', "Image setup complete! Updated $updated products with image filenames.");

        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            session()->setFlashdata('error', 'Error during setup: ' . $e->getMessage());
        }

        return redirect()->to('/admin')->with('setup_result', $result);
    }
}