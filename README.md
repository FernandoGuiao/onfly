## Informações e lembretes

- Configurar Database e SMTP no .env
- Executar: 'php artisan migrate' e 'php artisan db:seed' ( Seed dos 2 usuários para teste ) 
- A collection do postman, com rotas e exemplos de body, está na pasta Postman na root do projeto
- A aplicação usa autenticação por Bearer Token. É retornado na rota de login.
- O envio de emails funciona de forma assíncrona em fila, então deve executar 'php artisan queue:work'

##     ---
