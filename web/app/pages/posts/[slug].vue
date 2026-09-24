<script setup lang="ts">
import { usePosts } from "~/composables/usePosts";
import type { IPost } from "~/shared/types/post";

const route = useRoute();
const { fetchPostBySlug, loading, error } = usePosts();

const post = ref<IPost | null>(null);

onMounted(async () => {
  const slug = route.params.slug as string;
  post.value = await fetchPostBySlug(slug);
});
</script>

<template>
  <div class="post-container">
    <div v-if="loading" class="loading">Carregando...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <article v-else-if="post" class="post">
      <header class="post-header">
        <h1>{{ post.title }}</h1>
        <div class="post-meta">
          <span>{{ post.reading_time }} min de leitura</span>
          <span>{{ post.published_at }}</span>
          <span class="status">{{ post.status }}</span>
        </div>
      </header>

      <img
        v-if="post.thumbnail_url"
        :src="post.thumbnail_url"
        :alt="post.title"
        class="thumbnail"
      />

      <div class="post-content">
        {{ post.content }}
      </div>

      <footer class="post-footer">
        <div class="stats">
          <span>👁️ {{ post.views }} visualizações</span>
          <span>🔗 {{ post.shares }} partilhas</span>
        </div>
      </footer>
    </article>
  </div>
</template>

<style scoped>
.post-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
}

.post-header {
  margin-bottom: 2rem;
}

.post-header h1 {
  margin: 0 0 1rem 0;
  font-size: 2.5rem;
}

.post-meta {
  display: flex;
  gap: 1.5rem;
  color: #666;
  font-size: 0.9rem;
}

.status {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  background-color: #f0f0f0;
  border-radius: 4px;
  text-transform: capitalize;
}

.thumbnail {
  width: 100%;
  height: 400px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 2rem;
}

.post-content {
  line-height: 1.8;
  font-size: 1.1rem;
  color: #333;
  margin-bottom: 2rem;
}

.post-footer {
  padding-top: 2rem;
  border-top: 1px solid #ddd;
}

.stats {
  display: flex;
  gap: 2rem;
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
