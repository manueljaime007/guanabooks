import { BACKEND_URL } from "../config/api.config";
import type { IPost, IPostCategory, PostsResponse, PostCategoriesResponse } from "../types/post";

export const postsService = {
  async getAllPostsCategories(): Promise<IPostCategory[]> {
    try {
      const response = await $fetch<PostCategoriesResponse>(
        `${BACKEND_URL}/post-categories`
      );
      return response.data;
    } catch (error) {
      console.error("Erro ao carregar categorias:", error);
      throw error;
    }
  },

  async getAllPosts(categoryId?: string): Promise<IPost[]> {
    try {
      const query = categoryId ? `?category_id=${categoryId}` : "";
      const response = await $fetch<PostsResponse>(
        `${BACKEND_URL}/posts${query}`
      );
      return response.data;
    } catch (error) {
      console.error("Erro ao carregar posts:", error);
      throw error;
    }
  },

  async getPostBySlug(slug: string): Promise<IPost> {
    try {
      const response = await $fetch<{ data: IPost }>(
        `${BACKEND_URL}/posts/${slug}`
      );
      return response.data;
    } catch (error) {
      console.error("Erro ao carregar post:", error);
      throw error;
    }
  },
};
