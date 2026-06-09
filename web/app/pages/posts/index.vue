<script setup lang="ts">
import { postsService } from "~/shared/services/posts.service";
import type { IPostCategory } from "~/shared/types/post";


const state = reactive({
  postCategories : [],
})
onMounted(() => {
  postsService.getAllPostsCategories(state.postCategories);
});
</script>

<template>
  <h1>Post Categories</h1>
</template>
