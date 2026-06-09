import { BACKEND_URL } from "../config/api.config";
import type { IPostCategory } from "../types/post";

export const postsService = {

  async getAllPostsCategories(categories: IPostCategory[]) {
    const response = await fetch(`${BACKEND_URL}/post-categories`, {
      // credentials: "include"
    });

    if (!response.ok) throw new Error("Erro ao carregar artigos")
    console.log()
    return response.json();
  }
}
