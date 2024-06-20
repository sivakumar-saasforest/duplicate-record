<?php

namespace App\Livewire;

use Livewire\Component;
use RzqApplication\Plugin\Store\Product;
use Illuminate\Support\Str;
use RzqApplication\Plugin\Store\Coupon;
use RzqApplication\Plugin\Store\ProductCategory;

class Home extends Component
{
    public $data = [];
    public $status;

    public function updated($property, $value)
    {
        if ($property == 'status') {
            switch ($value) {
                case 'products';
                    $product = new Product();
                    $result = (object) json_decode($product->all(), true);
                    $this->data =  $result->data;
                    break;
                case 'categories';
                    $productCategory = new ProductCategory();
                    $result = (object) json_decode($productCategory->all(), true);
                    $this->data =  $result->data;
                    break;
                case 'coupons';
                    $coupon = new Coupon();
                    $result = (object) json_decode($coupon->all(), true);
                    $this->data =  $result->data;
                    break;
            }
        }
    }

    public function duplicateRecord($id)
    {
        switch ($this->status) {
            case 'products';
                self::duplicateProduct($id);
                break;
            case 'categories';
                self::duplicateProductCategory($id);
                break;
            case 'coupons';
                self::duplicateCoupon($id);
                break;
        }
    }

    public function duplicateProduct($productId)
    {
        $product = new Product();
        $productResult = (object) json_decode($product->show($productId), true);
        $oldData = $productResult->data;

        $data = [
            "name" => $oldData['name']['en'] . '-duplicate',
            "price" => (int) $oldData['price'],
            "discounted_price" => $oldData['discounted_price'],
            "description" => $oldData['description']['en'],
            "sku" => ($oldData['inventory']['sku'] ?? 'SKU') . Str::random(5),
            "total_quantity" => $oldData['inventory']['total_quantity'] ?? 1,
            "shipping_tax" => [
                "weight" => $oldData['shipping_tax']['weight'] ?? 1,
                "unit" => $oldData['shipping_tax']['unit'] ?? 1,
                "hsn_product_code" => $oldData['shipping_tax']['hsn_product_code'] ?? 'null',
                "tax_percentage" => $oldData['shipping_tax']['tax_percentage'] ?? 1
            ]
        ];

        $categories = [];
        foreach ($oldData['categories'] as $category) {
            $categories[] = $category['productable']['id'];
        }

        count($categories) > 0 ? $data['categories'] = $categories : '';

        $variants = [];
        foreach ($oldData['variants'] as $variant) {

            $variants[] = [
                "name" => $variant['name'],
                "price" => $variant['price'],
                "discounted_price" => $variant['discounted_price'],
                "weight" => $variant['weight'],
                "unit" => $variant['unit'],
                "gtin" => $variant['gtin'],
                "google_product_category" => $variant['google_product_category'],
                "sku" => $oldData['inventory']['sku'] . Str::random(5),
                "total_quantity" => $oldData['inventory']['total_quantity']
            ];
        }

        count($variants) > 0 ? $data['variants'] = $variants : '';

        $newProductResult = (object) json_decode($product->create($data, $oldData['has_variants'] ? 'variant' : 'single'), true);

        $result = (object) json_decode($product->all(), true);
        $this->data =  $result->data;
    }

    public function duplicateProductCategory($categoryId)
    {
        $productCategory = new ProductCategory();
        $productCategoryResult = (object) json_decode($productCategory->show($categoryId), true);
        $oldData = $productCategoryResult->data;

        $data = [
            "name" => $oldData['name']['en'] . '-duplicate',
            "slug" => Str::slug($oldData['name']['en'] . '-duplicate-' . Str::random(3)),
            "description" => $oldData['description']['en'],
        ];

        $productCategory->create($data);

        $result = (object) json_decode($productCategory->all(), true);
        $this->data =  $result->data;
    }

    public function duplicateCoupon($couponId)
    {
        $coupon = new Coupon();
        $productCategoryResult = (object) json_decode($coupon->show((int) $couponId), true);
        $oldData = $productCategoryResult->data;

        $data = [
            "coupon_type_id" => $oldData['coupon_type_id'],
            "coupon_code" => $oldData['coupon_code'] . '-COPY-' . Str::random(2),
            "usage_limit_per_customer" => $oldData['usage_limit_per_customer'],
            "usage_limit_value" => $oldData['usage_limit_value'],
            "discount_percent" => $oldData['discount_percent'] ? $oldData['discount_percent'] : 1,
            "discount_amount" => $oldData['discount_amount'] ? $oldData['discount_amount'] : 1,
            "minimum_order_condition" => $oldData['minimum_order_condition'],
            "minimum_order_value" => $oldData['minimum_order_value'],
            "minimum_order_quantity" => $oldData['minimum_order_quantity'],
            "maximum_discount_amount" => $oldData['maximum_discount_amount'] ? $oldData['maximum_discount_amount'] : 1,
            "buy_item" => $oldData['buy_item'],
            "get_free_item" => $oldData['get_free_item'],
            "is_show_coupon_to_customer" => $oldData['is_show_coupon_to_customer'],
            "is_valid_only_for_online_payments" => $oldData['is_valid_only_for_online_payments'],
            "is_valid_only_for_new_customers" => $oldData['is_valid_only_for_new_customers'],
            "is_auto_apply_coupon" => $oldData['is_auto_apply_coupon'],
            "validity_from" => $oldData['validity_from'],
            "validity_from_time" => $oldData['validity_from_time'],
            "validity_end" => $oldData['validity_end'],
            "validity_end_time" => $oldData['validity_end_time'],
            "apply_coupon_on" => $oldData['apply_coupon_on'],
        ];

        $applyOn = [];
        foreach ($oldData['coupon_apply_ons'] as $apply) {
            $applyOn[] = $apply['model_id'];
        }

        if (count($applyOn)) {
            $data[$oldData['apply_coupon_on'] == 'specific_products' ? 'selected_products' : 'selected_categories'] = $applyOn;
        }

        $coupon->create($data);

        $result = (object) json_decode($coupon->all(), true);
        $this->data =  $result->data;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
