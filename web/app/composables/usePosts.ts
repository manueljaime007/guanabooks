import { postsService } from "~/shared/services/posts.service";
import type { IPost, IPostCategory } from "~/shared/types/post";

export const usePosts = () => {
  const posts = ref<IPost[]>([]);
  const postCategories = ref<IPostCategory[]>([]);
  const loading = ref(false);
  const error = ref<string | null>(null);

  const fetchAllPostsCategories = async () => {
    loading.value = true;
    error.value = null;

    try {
      postCategories.value = await postsService.getAllPostsCategories();
    } catch (e) {
      error.value = "Erro ao carregar categorias";
      console.error(e);
    } finally {
      loading.value = false;
    }
  };

  const fetchAllPosts = async (categoryId?: string) => {
    loading.value = true;
    error.value = null;

    try {
      posts.value = await postsService.getAllPosts(categoryId);
    } catch (e) {
      error.value = "Erro ao carregar posts";
      console.error(e);
    } finally {
      loading.value = false;
    }
  };

  const fetchPostBySlug = async (slug: string): Promise<IPost | null> => {
    loading.value = true;
    error.value = null;

    try {
      return await postsService.getPostBySlug(slug);
    } catch (e) {
      error.value = "Erro ao carregar post";
      console.error(e);
      return null;
    } finally {
      loading.value = false;
    }
  };

  return {
    posts,
    postCategories,
    loading,
    error,
    fetchAllPostsCategories,
    fetchAllPosts,
    fetchPostBySlug,
  };
};
