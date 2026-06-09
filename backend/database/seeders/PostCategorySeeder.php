<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post_categories')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Programação Web',
                'slug' => Str::slug('Programação Web'),
                'description' => 'Tudo sobre programação mobile',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'UI/UX Desing',
                'slug' => Str::slug('UI/UX Desing'),
                'description' => 'Tudo sobre UI/UX Desing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Desenvolvimento Mobile',
                'slug' => Str::slug('Desenvolvimento Mobile'),
                'description' => 'Tudo sobre desenvolvimento mobile',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
