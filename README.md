# Proyecto de Gestión de Pedidos en Restaurante - Microservicios

Este proyecto implementa una arquitectura de microservicios para gestionar pedidos en un restaurante. Los microservicios
se encargan de manejar las órdenes, la cocina, la bodega (almacén), y las compras. Además, 
se utiliza un API Gateway para coordinar las solicitudes entre los diferentes microservicios.

## Microservicios

### 1. **Servicio de Pedidos (Orders Service)**
Este microservicio gestiona la creación y listado de órdenes. Permite a los usuarios solicitar un plato aleatorio, el cual será preparado por el servicio de cocina si hay ingredientes disponibles.

- **Endpoints:**
    - `POST /api/v1/orders`: Crea una nueva orden.
    - `POST /api/v1/orders/{orderId}/complete`: Completa la orden.
    - `GET /api/v1/orders`: Lista y pagina las órdenes existentes.

- **Interacción:**
    - **Crea una orden:** Cuando se crea una orden, se solicita una receta aleatoria al Servicio de Cocina. 
  Este microservicio verifica la disponibilidad de los ingredientes y, si es necesario, solicita más ingredientes al Servicio de Compras.
    - **Listar órdenes:** Las órdenes se listan con paginación, utilizando el parámetro `page` para navegar entre páginas.
    - **Completar orden:** Completa la orden como finalizada.

### 2. **Servicio de Cocina (Kitchen Service)**
Este microservicio se encarga de la preparación de las recetas y la validación de la disponibilidad de los ingredientes.

- **Endpoints:**
    - `GET /api/v1/recipes`: Lista las recetas.
    - `GET /api/v1/recipes/{id}`: Obtiene una receta por su id.
    - `GET /api/v1/recipes/random`: Obtiene una receta aleatoria.
    - `POST /api/v1/orders`: Recibe la orden del Servicio de Pedidos para comenzar la preparación.
    - `GET /api/v1/orders/{order}`: Obtiene una orden por id.
    - `POST /api/v1/orders/{order}/prepare`: Completa una orden.

- **Interacción:**
    - **Preparación de recetas:** Cuando el Servicio de Pedidos solicita una receta, la Cocina verifica la disponibilidad de ingredientes en la Bodega. 
  Si faltan ingredientes, se solicita al Servicio de Compras que los adquiera.

### 3. **Servicio de Bodega (Warehouse Service)**
Este microservicio gestiona el inventario de ingredientes.

- **Endpoints:**
    - `GET /api/v1/ingredients`: Devuelve la lista de ingredientes disponibles.
    - `POST /api/v1/ingredients/order`: Reduce la cantidad de un ingrediente específico en el inventario.
    - `POST /api/v1/ingredients/add`: Añade la cantidad de un ingrediente específico en el inventario.

- **Interacción:**
    - **Inventario:** Cuando el Servicio de Cocina necesita ingredientes, verifica la disponibilidad en este servicio. 
    - Si hay suficientes ingredientes, la Cocina puede proceder; si no, el Servicio de Compras debe reponer el stock.

### 4. **Servicio de Compras (Purchase Service)**
Este microservicio gestiona la adquisición de ingredientes cuando no hay suficientes en la bodega.

- **Endpoints:**
    - `POST /api/v1/purchases`: Solicita la compra de ingredientes.
    - `GET /api/v1/purchases`: Lista y pagina las compras realizadas.
    - `GET /api/v1/purchases/{id}`: Muestra una compra realizada por ID.

- **Interacción:**
    - **Reposición de ingredientes:** Si un ingrediente no está disponible en la cantidad necesaria, el Servicio de Cocina solicita una compra a este microservicio, que luego actualiza el inventario en la Bodega.

### 5. **API Gateway**
El API Gateway se encarga de redirigir las solicitudes de los clientes hacia el microservicio correspondiente, actuando como punto de entrada único.

- **Autenticación:** Utiliza Laravel Passport para gestionar la autenticación de los microservicios.
- **Forwarding:**
    - `POST /login`: Autentica un usuario y provee un token Bearer.
    - `POST /orders`: Redirige la solicitud de creación de órdenes al Servicio de Pedidos.
    - `GET /orders`: Redirige la solicitud de listado de órdenes al Servicio de Pedidos.
    - `GET /kitchen/ramdom`: Obtiene una receta aleatoria.
    - `GET /kitchen/recipes`: Lista las recetas disponibles.
    - `GET /kitchen/recipes/{recipe}`: Obtiene una receta.
    - `GET /kitchen/orders/{order}`: Obtiene una orden en la cocina.
    - `GET /warehouse/ingredients`: Obtienes todos lso ingredientes y sus cantidades.
    - `GET /purchases`: Lista las compras realziadas al mercado.
   

## Configuración y Despliegue

### Requisitos
- Docker
- Docker Compose
- PHP 8.x
- MySQL

### Configuración Inicial

1. Clona el repositorio.
2. Configura los archivos `.env` en cada microservicio, asegurándote de definir las variables de entorno para las bases de datos, API Gateway, y servicios externos como Wompi y Stripe.
3. Construye y levanta los contenedores utilizando Docker Compose:

    ```bash
    docker-compose up -d --build
    ```

4. Ejecuta las migraciones y los seeders:

    ```bash
    docker-compose exec orders-service php artisan migrate --seed
    docker-compose exec kitchen-service php artisan migrate --seed
    docker-compose exec warehouse-service php artisan migrate --seed
    docker-compose exec purchase-service php artisan migrate --seed
    ```

### Interacción entre Microservicios

1. **Flujo de Pedido:**
    - Un usuario solicita un plato aleatorio a través del Servicio de Pedidos.
    - El Servicio de Pedidos obtiene una receta del Servicio de Cocina.
    - El Servicio de Cocina verifica los ingredientes disponibles en el Servicio de Bodega.
    - Si no hay suficientes ingredientes, el Servicio de Compras se encarga de adquirirlos.
    - El Servicio de Cocina procede a preparar la receta y completa la orden.

2. **Autenticación:**
    - El API Gateway gestiona la autenticación de todas las solicitudes utilizando Laravel Passport.

## Notas Adicionales

- Todos los microservicios están diseñados bajo una arquitectura hexagonal, lo que permite un fácil mantenimiento y escalabilidad.
- Las rutas del API Gateway están protegidas por middleware de autenticación para garantizar la seguridad de las transacciones.


