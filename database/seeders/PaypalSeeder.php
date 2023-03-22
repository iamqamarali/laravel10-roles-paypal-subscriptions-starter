<?php

namespace Database\Seeders;

use App\Models\Product;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaypalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paypalProduct = $this->createPaypalProduct();
        if(!isset($paypalProduct['id']))
            throw new Exception('Could not create paypal PRODUCT');

        $paypalPlan = $this->createPaypalPlan($paypalProduct['id'], '97');

        if(!isset($paypalPlan['id']))
            throw new Exception('Could not create paypal PLAN');


        $product = new Product([
            'name' => 'Online arbitrage leads',
            'description' => 'Amazon online arbitrage leads',
            'price' => 97,
            'paypal_product_id' => $paypalProduct['id'],
            'paypal_plan_id' => $paypalPlan['id'],
        ]);
        $product->save();
    }


    public function createPaypalProduct()
    {
        $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));    
        $provider->getAccessToken();
            
        $data =  json_decode('{
            "name": "Online arbitrage leads",
            "description": "Amazon online arbitrage leads",
            "type": "SERVICE",
            "category": "SOFTWARE"
          }', true);
    
        $request_id = 'create-product-'.time();
        $product = $provider->createProduct($data, $request_id);    
        
        return $product;
    }


    public function createPaypalplan($product_id, $price)
    {    
        $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));    
        $provider->getAccessToken();

        $data = json_decode('{
            "product_id": "'.$product_id.'",
            "name": "Amazon online arbitrage leads Plan",
            "description": "Amazon online arbitrage leads basic Plan",
            "status": "ACTIVE",
            "billing_cycles": [
                {
                  "frequency": {
                    "interval_unit": "MONTH",
                    "interval_count": 1
                  },
                  "tenure_type": "REGULAR",
                  "sequence": 1,
                  "total_cycles": 0,
                  "pricing_scheme": {
                    "fixed_price": {
                      "value": "'.$price.'",
                      "currency_code": "USD"
                    }
                  }
                }
              ],
              "payment_preferences": {
                "auto_bill_outstanding": true,
                "setup_fee_failure_action": "CANCEL",
                "payment_failure_threshold": 3
              }
            }', true);
    
    
        $request_id = 'create-plan-'.time();
        $plan = $provider->createPlan($data, $request_id);
        return $plan;
    }


}
