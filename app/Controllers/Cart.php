<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
    protected $transactionModel;
    protected $productModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $cartItems = $this->transactionModel->getCartItems($userId);

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $data = [
            'title' => 'Shopping Cart - Rhys Firearms',
            'cart_items' => $cartItems,
            'total' => $total
        ];

        return view('cart/index', $data);
    }

    public function add($productId)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $quantity = $this->request->getPost('quantity') ?? 1;

        // Validate product exists
        $product = $this->productModel->find($productId);
        if (!$product) {
            session()->setFlashdata('error', 'Product not found');
            return redirect()->back();
        }

        if ($this->transactionModel->addToCart($userId, $productId, $quantity)) {
            session()->setFlashdata('success', 'Product added to cart successfully');
        } else {
            session()->setFlashdata('error', 'Failed to add product to cart');
        }

        return redirect()->back();
    }

    public function remove($productId)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        if ($this->transactionModel->removeFromCart($userId, $productId)) {
            session()->setFlashdata('success', 'Product removed from cart');
        } else {
            session()->setFlashdata('error', 'Failed to remove product from cart');
        }

        return redirect()->to('/cart');
    }

    public function update()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $quantities = $this->request->getPost('quantities');

        if ($quantities) {
            foreach ($quantities as $productId => $quantity) {
                if ($quantity <= 0) {
                    $this->transactionModel->removeFromCart($userId, $productId);
                } else {
                    // Update quantity in cart
                    $this->transactionModel->where('user_id', $userId)
                                          ->where('product_id', $productId)
                                          ->where('status', 'cart')
                                          ->set(['quantity' => $quantity])
                                          ->update();
                }
            }
        }

        session()->setFlashdata('success', 'Cart updated successfully');
        return redirect()->to('/cart');
    }

    public function clear()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        if ($this->transactionModel->clearCart($userId)) {
            session()->setFlashdata('success', 'Cart cleared successfully');
        } else {
            session()->setFlashdata('error', 'Failed to clear cart');
        }

        return redirect()->to('/cart');
    }
}