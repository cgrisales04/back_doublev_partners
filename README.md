## Prueba tecnica - *Double v Partners*

Proyecto backend en el cual esta compuesto de varios servicios los cuales son:

URL BASE - http://127.0.0.1:8000
POST - /api/tickets - Creacion de tikects
GET - /api/tickets - Selección de todos los tikects
GET - /api/tickets/1 - Selección de tickect en especifico
GET - /api/tickets/pagination?page=3&page_size=1 - Paginación
DELETE - /api/tickets/5 - Borrado de ticket
PUT - /api/tickets/3?user_name=Dayana&status=cerrado - Edición de tickets

Tecnologias usadas:

-   Laravel 7
-   PHP 7.4.25

Para realizar la descarga del proyecto debes ejecutar desde la consola. 

-   Ejecutar los comandos
    ```
    git clone https://github.com/cgrisales04/project_doublev_partners_test_techinal.git
    ```

- Crear una base de datos MySQL llamada: doublev_partners_db 
- Ejecutar comando para crear las migraciones (Tablas)
    ```
    php artisan migrate
     ```
- Ejecutar el proyecto con el comando
    ```
    php artisan serve
    ```
👶🏽 Dev. Cristian Grisales
🎓 Engineer in process
