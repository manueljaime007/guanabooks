# 1. Primeiro, faça login como admin
curl -X POST http://localhost:9010/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"manueljaime0020@gmail.com","password":"admin123"}'

# 2. Use o token para criar um post (com form-data)
curl -X POST http://localhost:9010/api/v1/admin/posts \
  -H "Authorization: Bearer 12|UJ5UZ7o7xYkT8ZBkid4VhXbbVOGFYr9JaC8oqGka5ae08ead" \
  -F "title=Meu Novo Post" \
  -F "content=Conteúdo completo do post..." \
  -F "resume=Resumo do post..." \
  -F "post_category_id=11111111-1111-1111-1111-111111111111" \
  -F "status=published" \
  -F "thumbnail=@\"C:\Users\Manuel Jaime\Desktop\720846556_122179994018885107_5398417961376903768_n.jpg\""

# 3. Verifique se o post foi criado
curl http://localhost:9010/api/v1/posts



curl -X POST http://localhost:9010/api/v1/admin/posts \
  -H "Authorization: Bearer 12|UJ5UZ7o7xYkT8ZBkid4VhXbbVOGFYr9JaC8oqGka5ae08ead" \
  -F "title=Meu Post com Imagem" \
  -F "content=Conteúdo completo do post..." \
  -F "resume=Resumo do post..." \
  -F "post_category_id=11111111-1111-1111-1111-111111111111" \
  -F "status=published" \
  -F "thumbnail=@/c/Users/Manuel Jaime/Desktop/720846556_122179994018885107_5398417961376903768_n.jpg"