<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\PostModel;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(3)->create();

        User::create([
            "name" => "Laskar Jihad",
            "username" => "laskar",
            "email" => "laskar@gmail.com",
            "password" => bcrypt("laskar")
        ]);

        User::create([
            "name" => "Nurul",
            "username" => "nurul",
            "email" => "nurul@gmail.com",
            "password" => bcrypt("nurul")
        ]);

        PostModel::factory(20)->create();

        // PostModel::create([
        //     "title" => "Judul Pertama",
        //     "category_id" => 1,
        //     "user_id" => 1,
        //     "slug" => "judul-pertama",
        //     "excerpt" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic exercitationem a impedit, tempore animi dolor corrupti dolorum accusamus eligendi? Delectus, tempore omnis! Quo, quaerat suscipit quod consectetur quam quidem voluptatum eum quisquam quasi nemo distinctio enim eveniet vel velit dolorem nulla.",
        //     "body" => "<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic exercitationem a impedit, tempore animi dolor corrupti dolorum accusamus eligendi? Delectus, tempore omnis! Quo, quaerat suscipit quod consectetur quam quidem voluptatum eum quisquam quasi nemo distinctio enim eveniet vel velit dolorem nulla. Deleniti repudiandae cupiditate maxime corrupti dicta, nisi vel voluptas a in minima sequi natus distinctio, explicabo itaque iure illum reiciendis, commodi totam nulla debitis eaque mollitia enim aliquid exercitationem.</p> <p> Beatae laborum harum in soluta suscipit alias corrupti maxime, assumenda consequuntur consectetur, dolore explicabo velit ex nobis, voluptate neque odio. Accusamus, accusantium. Saepe laudantium ratione sunt porro id est qui non ducimus, dolorem voluptate sequi et autem rem. Minima nihil est at alias quis amet, provident magni obcaecati adipisci animi quaerat blanditiis expedita dignissimos in ut nam tempora quo totam consectetur molestias vel, quidem harum nobis consequatur! Vero porro laudantium libero quidem harum repellendus qui rerum beatae iste aliquam nihil sunt, illum, excepturi pariatur est magnam distinctio, numquam sequi error nostrum hic et ut odit eum? Aliquam, blanditiis labore, facilis odio quo at exercitationem enim velit aliquid esse odit iste illum praesentium, autem quam provident! Quo optio cupiditate aspernatur possimus iste sequi non necessitatibus totam, recusandae nesciunt debitis a veritatis.</p>"
        // ]);

        Category::create([
            "name" => "Web Programming",
            "slug" => "web-programming",
        ]);
        Category::create([
            "name" => "Web Design",
            "slug" => "web-design",
        ]);
        Category::create([
            "name" => "Personal",
            "slug" => "personal",
        ]);
    }
}
