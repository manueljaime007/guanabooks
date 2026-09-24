<script setup lang="ts">
import { usePosts } from '~/composables/usePosts';

const { postCategories, posts, loading, error, fetchAllPostsCategories, fetchAllPosts } = usePosts();

onMounted(() => {
  fetchAllPostsCategories();
  fetchAllPosts();
});
</script>

<template>
  <div class="posts-container">
    <h1>Posts</h1>

    <!-- Categorias -->
    <section class="categories">
      <h2>Categorias</h2>
      <div v-if="loading" class="loading">Carregando...</div>
      <div v-else-if="error" class="error">{{ error }}</div>
      <div v-else class="categories-grid">
        <div
          v-for="category in postCategories"
          :key="category.id"
          class="category-card"
        >
          {{ category.name }}
        </div>
      </div>
    </section>

    <!-- Posts -->
    <section class="posts">
      <h2>Artigos Recentes</h2>
      <div v-if="loading" class="loading">Carregando...</div>
      <div v-else-if="error" class="error">{{ error }}</div>
      <div v-else class="posts-grid">
        <article
          v-for="post in posts"
          :key="post.id"
          class="post-card"
        >
          <h3>{{ post.title }}</h3>
          <p class="resume">{{ post.resume }}</p>
          <div class="meta">
            <span class="reading-time">{{ post.reading_time }} min</span>
            <span class="status">{{ post.status }}</span>
          </div>
          <NuxtLink :to="`/posts/${post.slug}`" class="read-more">
            Ler mais →
          </NuxtLink>
        </article>
      </div>
    </section>
  </div>
</template>

<style scoped>
.posts-container {
  padding: 2rem;
}

.categories-grid,
.posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1rem;
  margin-top: 1rem;
}

.category-card,
.post-card {
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.category-card:hover,
.post-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.post-card {
  display: flex;
  flex-direction: column;
}

.post-card h3 {
  margin-top: 0;
}

.resume {
  flex-grow: 1;
  color: #666;
  font-size: 0.9rem;
  line-height: 1.5;
}

.meta {
  display: flex;
  gap: 1rem;
  margin: 1rem 0;
  font-size: 0.85rem;
}

.meta span {
  display: inline-block;
  padding: 0.25rem 0.5rem;
  background-color: #f0f0f0;
  border-radius: 4px;
}

.read-more {
  color: #0066cc;
  text-decoration: none;
  font-weight: 500;
}

.read-more:hover {
  text-decoration: underline;
}

.loading,
.error {
  padding: 2rem;
  text-align: center;
}

.error {
  color: #d32f2f;
  background-color: #ffebee;
  border-radius: 4px;
}
</style>
