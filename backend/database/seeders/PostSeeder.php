<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // PostSeeder.php
    public function run(): void
    {
        DB::table('posts')->truncate();

        DB::table('posts')->insert([
            [
                'id' => Str::uuid(),
                'user_id' => '019ee172-45d4-70c6-b0a5-4fe716e6571e', // ✅ Este ID deve existir na tabela users
                'post_category_id' => '11111111-1111-1111-1111-111111111111', // ✅ Usando o ID fixo
                'title' => 'React Native ou Flutter? Qual a melhor opção para 2026',
                'slug' => Str::slug('React Native ou Flutter? Qual a melhor opção para 2026'),
                'resume' => 'Hoje em dia, escolher uma ferramenta para criação de software envolve muito mais do que a preferência do mercado',
                'content' => 'Hoje em dia, escolher uma ferramenta para criação de software envolve muito mais do que a preferência do mercado bla bla bla',
                'thumbnail_url' => null, // ✅ Melhor usar null do que string vazia
                'reading_time' => 5,
                'status' => 'published', // ✅ Adicionei status
                'is_highlight' => false, // ✅ Adicionei is_highlight
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
