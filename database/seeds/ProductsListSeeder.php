<?php

    use App\Models\Product;
    use Illuminate\Database\Seeder;

class ProductsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        for ($i = 1; $i <= 20; $i++) {
            try {
                $price = random_int(1, 1000)/10;
            } catch (Exception $e) {
                $price = 5.99;
            }

            Product::create([
                'title' => 'Product '.$i,
                'description' => 'Description for product '.$i,
                'price' => $price,
            ]);
        }


    }
}
