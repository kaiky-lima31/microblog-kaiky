# Sobre as áreas do site
 
## Pública

Páginas que **não precisam de autenticação** para o acesso.

São as páginas na raiz do projeto: index, noticia, login, resultado.


## Administrativa

Páginas que **precisam de autenticação** para o acesso,
sendo que algumas delas tem privilégios de acesso
diferenciados.

São as páginas contidas na pasta **admin** do projeto: index, usuarios, usuario-insere, usuario-atualiza,
usuario-exclui, noticias, noticias-insere, noticia-atualizada,
noticia-exclui e nao-autorizado. 

### Privílégios de acessos 

Usuários do tipo **admin**, podem acessar/modificar **TUDO**

Usuários do tipo **editor**, podem acessar/modificar 
**somente** seus próprios dados e suas próprias notícias.

Ou seja, **não podem** por exemplo, administrar outros usuários.