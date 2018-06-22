<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ProductTagsTableSeeder::class);
        $this->call(ProductReviewsTableSeeder::class);
        $this->call(UserWishListsTableSeeder::class);
        $this->call(UserCartsTableSeeder::class);
    }
}
