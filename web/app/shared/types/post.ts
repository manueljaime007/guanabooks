export interface IPost {
  id: string;
  title: string;
  slug: string;
  resume: string;
  content: string;
  thumbnail_url: string;
  reading_time: number;
  views: number;
  shares: number;
  status: "draft" | "published" | "archived";
  is_highlight: boolean;
  published_at: string;
  updated_at: string;
  user_id: string;
  post_category_id: string;
}

export interface PostsResponse {
  data: IPost[];
  meta?: {
    total: number;
    page: number;
    limit: number;
  };
}

export interface IPostCategory {
  id: string;
  name: string;
  slug: string;
  description: string;
}

export interface PostCategoriesResponse {
  data: IPostCategory[];
}
