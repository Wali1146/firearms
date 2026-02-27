<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $category = $this->request->getGet('category');
        $type = $this->request->getGet('type');

        $products = $this->productModel->getProductsWithDetails();

        // Filter by category if specified
        if ($category) {
            $products = array_filter($products, function($product) use ($category) {
                return $product['category_id'] == $category;
            });
        }

        // Filter by type if specified
        if ($type) {
            $products = array_filter($products, function($product) use ($type) {
                return $product['type'] == $type;
            });
        }

        $data = [
            'title' => 'Products - Rhys Firearms',
            'products' => $products,
            'categories' => $this->categoryModel->getOrdered(),
            'current_category' => $category,
            'current_type' => $type
        ];

        return view('products/index', $data);
    }

    public function show($id)
    {
        $product = $this->productModel->getProductWithDetails($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $product['name'] . ' - Rhys Firearms',
            'product' => $product
        ];

        return view('products/show', $data);
    }
}