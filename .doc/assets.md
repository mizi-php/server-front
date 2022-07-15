### Assets
Abre acesso a arquivos do projeto para a URL

    use Mizi\Assets;

---
Envia um arquivo assets requisitado via URL

    Assets::send(array $path, array $allowTypes): never

---

Realiza o download de um arquivo assets requisitado via URL

    Assets::download(array $path, array $allowTypes): never
    
--- 
### Exemplo
No exemplo abaixo, a rota **assets** vai retornar um arquivo de dentro do diretório **public/assets**

    Router::get('assets...', fn () => Assets::send('library/assets'));

No exemplo abaixo, a rota **favicon.ico** vai retornar o arquivo **library/favicon.ico**

    Router::get('assets...', fn () => Assets::send(../library/favicon.ico));

No exemplo abaixo, a rota **download** vai fazer o download de um arquivo **.zip** dentro do diretório **library/download**

    Router::get('download...', fn () => Assets::send('library/download', ['zip']));