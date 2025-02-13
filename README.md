# Reto Técnico - Ricardo Alama

Para instalar el proyecto primer debe tener instalado docker en su máquina.
Luego de eso deberá ejecutar el siguiente comando para construir los contenedores
```
docker-compose build
```

Luego que haya finalizado de construir el contenedor. Ingresará al contenedor de Laravel para dar permisos a la carpeta storage
```
docker exec -it project-backend sh
```
Luego se sitúa en la carpeta raíz del proyecto y da los permisos necesarios
```
cd project
chmod -R 775 storage/
```

Seguiamente instalamos las dependencias del proyecto
```
composer install
```
Creamos el .env a partir del .env.example y generamos nuestra clave de encriptación
```
cp .env.example
php artisan key:gen
```
FInalmente corremos las migraciones y los seeders
```
php artisan migrate --seed
```

El contenedor de docker ya tiene alojado nuestro proyecto en un servidor nginx y se puede acceder al mismo mediante http://localhost. Para el uso de las APIs vamos a utilizar postman o culquier cliente Http.

Las siguientes son las Api existentes:
- Registrar Usuario http://localhost/api/register POST
```
{
	"name": "Ricardo",
	"lastname": "Alama",
	"email": "ricardo@gmail.com",
	"password": "admin123", 
	"role": "Super Admin"
}
```
- Login http://localhost/api/login POST
```
{
	"email": "ricardo@gmail.com",
	"password": "admin123"
}
```
Y la respuesta es la siguiente
```
{
	"message": "Bienvenido Nara Alama.",
	"access_token": "2|F0S9gk0Q31zBgyENgpRHrHwlSOrUI5VnosuwmnJQ0f019efc"
}
```
A los endpoints siguientes se les debe agregar un header a la petición. Que es el token que devuelve el endpoint de login anteriormente mencionado
```
Authorization: Bearer 2|F0S9gk0Q31zBgyENgpRHrHwlSOrUI5VnosuwmnJQ0f019efc
```
- Crear Producto http://localhost/api/products POST
```
{
	"name": "Vinifan",
	"sku": "VG657GF",
	"unit_price": 100,
	"stock": 400
}
```
- Actualizar Producto http://localhost/api/products/1 PUT
```
{
	"sku": "BYT549D"
}
```
- Listar Productos http://localhost/api/products GET
```
{ }
```
- Buscar Producto http://localhost/api/products/1 GET
```
{ }
```
- ELiminar Producto http://localhost/api/products/1 POST
```
{ }
```
- Registrar Venta http://localhost/api/register-sale POST
```
{
	"datetime": "2025-01-01 23:45:23",
	"client_id": 1,
	"products": [
		{
			"product_id": 2,
			"quantity": 200
		},
		{
			"product_id": 4,
			"quantity": 300
		}
	]
}
```
- Exportar en Excel http://localhost/api/sales-export-xlsx POST
```
{
	"filter_from": "2024-01-01 23:45:23",
	"filter_to": "2025-01-01 23:45:23"
}
```
- Exportar en Json http://localhost/api/sales-export-json POST
```
{
	"filter_from": "2024-01-01 23:45:23",
	"filter_to": "2025-01-01 23:45:23"
}
```

## Infrasetructura
 El proyecto utiliza principalmente para la gestión de los datos el patrón Repository para separar la lógica 
 de Base de datos en una capa distinta a la de negocio. EL uso de contenedores de docker simplifica mucho 
 el despliegue de la aplicación, tanto en producción como en desarrollo, de esa manera se evitan problemas
 de compatibilidad y versiones en el la máquina en la que se desea trabajar.

 La versión de laravel que estamos usando en la 11 y la versión de PHP es la 8.3 por un tema de compatibilidad.
 Los paquetes extra que instalamos fuerons los siguientes:
 - laravel spatie para los permisos y roles
 - laravel excel para la exportación en .xlsx
 - laravel sanctum para la autenticación

 El uso de nginx en vez de apache es debido a su fácil configuración initial y sintaxis sencilla y enetendible.
 