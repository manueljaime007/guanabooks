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
                'id' => '11111111-1111-1111-1111-111111111111', // ID fixo
                'name' => 'Programação Web',
                'slug' => Str::slug('Programação Web'),
                'description' => 'Tudo sobre programação web', // ✅ Corrigi a descrição
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '22222222-2222-2222-2222-222222222222', // ID fixo
                'name' => 'UI/UX Design', // ✅ Corrigi o typo (Design, não Desing)
                'slug' => Str::slug('UI/UX Design'),
                'description' => 'Tudo sobre UI/UX Design',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '33333333-3333-3333-3333-333333333333', // ID fixo
                'name' => 'Desenvolvimento Mobile',
                'slug' => Str::slug('Desenvolvimento Mobile'),
                'description' => 'Tudo sobre desenvolvimento mobile',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
