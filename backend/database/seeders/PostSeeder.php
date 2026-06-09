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
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'id' => Str::uuid(),
                'user_id' => '019eac19-5165-70ac-940b-3a62b5c830bd',
                'post_category_id' => '2877e70a-de23-4cd0-ae5b-d6ef2fad81f5',
                'title' => 'React Native ou Flutter? Qual a melhor opção para 2026',
                'slug' => Str::slug('React Native ou Flutter? Qual a melhor opção para 2026'),
                'resume' => 'Hoje em dia, escolher uma ferramenta para criação de software envolve muito mais do que a preferência do mercado',
                'content' => 'Hoje em dia, escolher uma ferramenta para criação de software envolve muito mais do que a preferência do mercado bla bla bla',
                'thumbnail_url' => '',
                'reading_time' => 5,
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

/**
 return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'resume' => $this->resume,
            'content' => $this->content,
            'thumbnail_url' => $this->thumbnail_url,
            'reading_time' => $this->reading_time,
            'views' => $this->views,
            'shares' => $this->shares,
            'status' => $this->status,
            'is_highlight' => $this->is_highlight,
            // 'published_at' => $this->published_at->isoFormat('DD-MM-YYYY h:m:s'),
            'published_at' => $this->published_at->format('d/m/Y H:i'),
            // 'updated_at' => $this->updated_at->isoFormat('DD-MM-YYYY h:m:s'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'author' => new UserResource($this->whenLoaded('author')),
            'user_id' => $this->user_id,
            'post_category_id' => $this->post_category_id,
        ];

 */
