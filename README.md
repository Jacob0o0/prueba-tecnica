# Prueba técnica para la vacante de Desarrollo Full Stack Jr

Este repositorio y aplicación fue creado con el propósito de realizar la prueba técnica asignada por "PruebaT" para el proceso de contratación por la vacante de Desarrollo Full Stack Jr.

## A realizar:

Realizar un sistema usando el framework CodeIgniter y MySQL para la gestión y despliegue de "contenido educativo". 

Implementar los servicios REST detallados más adelante en un controlador llamado Contenidos usando seguridad básica.

## Requerimientos:

1. Pantalla Principal: 
    * Despliega los seis últimos artículos ordenados por fecha mostrando una imagen previa (thumbnail), el título del contenido y una breve descripción.
	* Al dar click en alguno de los contenidos se dirige a otra pantalla que lo despliega completo (pantalla 2).
	* El listado se hace con los datos recibidos del servicio REST - JSON Contenidos/listaContenidosPortada
	* Botón hacia la pantalla de administración (pantalla 3)
2. Pantalla para mostrar contenido:
    * Debe mostrar un encabezado: texto del título del contenido e imagen de portada.
	* Desplegar el texto de la descripción del contenido en la parte inferior respetando los estilos previamente capturados (pantalla 4).
3. Pantalla de administración con listado de contenidos:
    * Tabla que presenta los contenidos por nombre en orden alfabético con la opción de editar y eliminar.
    * Al dar click en eliminar, borrará el contenido (imágenes, pdf, videos y datos del contenido)  en el servidor.
    * Al dar click en editar, mostrará el formulario para edición precargado con los datos de la BD (imágenes, pdf, videos y datos del contenido).
	* Un botón fuera de la tabla que muestra el formulario para crear un nuevo artículo (pantalla 4).
	* El listado se hace con los datos recibidos del servicio REST - JSON Contenidos/listaContenidos
4.  Formulario para inserción/edición de contenidos:
	* Campos:
		- Título (text-max 150 caracteres [a-z,A-Z,0-9,.!?¿¡])
		- Palabras clave (textarea, 200 caracteres, [a-z,A-Z,0-9,.!?¿¡-/])
		- Área de Conocimiento (text[0-9])
		- Tipo de Contenido (text[0-9])
		- Imagen portada (file)
		- Imagen previa, thumbnail, (file)
		- Descripción (textarea, 200 caracteres, [a-z,A-Z,0-9,.!?¿¡-/])
		- Contenido "html" con estilos predefinidos usando editor TinyMCE.
		      Deshabilitar las funciones de formato, habilitando únicamente: negritas, cursivas, alineación y viñetas. 
		- Botón guardar.
	* Si está en modo edición al dar en el botón de guardar se realizará la actualización del contenido. En caso de que se esté en modo de nuevo contenido hará la inserción de un nuevo contenido. Se registra en la base de datos la fecha y hora de la operación.
	* La carga de los datos se realiza a través del servicio REST - JSON implementado en el controlador Contenidos/verContenido/<id>
	* La inserción se hace a través del servicio REST - JSON implementado en el controlador Contenidos/nuevoContenido que recibe datos por post.
	* La actualización se hace a través del servicio REST - JSON implementado en el controlador Contenidos/actualizarContenido que recibe datos por post.
5. MINIJUEGO:  Depósitos y retiros:  
    Juego Drag and Drop en el que se arrastrarán billetes y monedas de las denominaciones mostradas arriba de un recuadro imitando visualmente un cajero electrónico. Debe contar con botones que permitan eliminar los billetes y monedas agregados al recuadro, también un botón para salir (sugerido por mi), un botón de reinicio, uno para el siguiente nivel (una vez que el usuario haya completado el nivel) y un botón de "listo" para comprobar el dinero entregado. Cada nivel debe tener las siguientes características:

    * Nivel 1: 
        - Se muestra una cantidad aleatoria entre $1 y $999. 
        - Se muestran billetes y monedas para completar la cantidad indicada.
        - Indicadores con sonido para la comprobación de la cantidad de dinero entregada (menor, mayor o igual).
        - En caso de completar 5 ejercicios, se activa el botón para ir al siguiente nivel o reiniciar el ejercicio.
    * Nivel 2: 
        - Se muestra una cantidad aleatoria entre $1 y $999. 
        - Se muestran billetes y monedas para completar la cantidad indicada.
        - **En el recuadro de entrega de dinero ya deben existir billetes y monedas** (cantidad menor a la que se tiene que entregar).
        - El **dinero que ya estaba en la bandeja de entrega no puede ser eliminado**.
        - Indicadores con sonido para la comprobación de la cantidad de dinero entregada (menor, mayor o igual).
        - En caso de completar 5 ejercicios, se activa el botón para ir al siguiente nivel o reiniciar el ejercicio.
    * Nivel 3: 
        - Se muestra una cantidad aleatoria entre $1 y $999. 
        - Se muestran billetes y monedas para completar la cantidad indicada.
        - **En el recuadro de entrega de dinero ya deben existir billetes y monedas** (cada denominación debe estar **entre 0 y 9**).
        - **Agregar función que permita eliminar el dinero que ya estaban en el recuadro de entrega.**
        - Indicadores con sonido para la comprobación de la cantidad de dinero entregada (menor, mayor o igual).
        - En caso de completar 5 ejercicios, se activa el botón para ir al siguiente nivel o reiniciar el ejercicio.
    * Nivel 4:
        - Se muestra una cantidad aleatoria entre $1 y $9,999. 
        - Se muestran billetes y monedas para completar la cantidad indicada.
        - **En el recuadro de entrega de dinero ya deben existir billetes y monedas** (cada denominación debe estar **entre 0 y 9**).
        - **Agregar función que permita eliminar el dinero que ya estaban en el recuadro de entrega.**
        - Indicadores con sonido para la comprobación de la cantidad de dinero entregada (menor, mayor o igual).
        - En caso de completar 5 ejercicios, se activa el botón para reiniciar el juego y devuelve a la pantalla inicial del juego.

### Controladores:
- Contenidos/listaContenidosPortada
- Contenidos/listaContenidos
- Contenidos/verContenido
- Contenidos/nuevoContenido
- Contenidos/actualizarContenido


## Proceso de desarrollo:
Se analizaron los requerimientos y se diseñaron las páginas solicitadas en **Figma**, creando solo los wireframes para agilizar el proceso de desarrollo. Seguido de esto, se determinó que el uso del framework de React sería el adecuado para lo que se necesita hacer en la parte del Front-End. Para el backend se utilizará CodeIgniter como se solicita.

Para propósitos de desarrollo, se creará una empresa ficticia con el nombre de "Educa-Tech" para darle una mejor apariencia a la página y a su vez crear una imagen de marca para crear una página integra y visualmente atractiva.

### Database:
Los requisitos contienen exactamente los campos que se requieren crear para las publicaciones del contenido educativo:

- Título (text-max 150 caracteres [a-z,A-Z,0-9,.!?¿¡])
- Palabras clave (textarea, 200 caracteres, [a-z,A-Z,0-9,.!?¿¡-/])
- Área de Conocimiento (text[0-9])
- Tipo de Contenido (text[0-9])
- Imagen portada (file)
- Imagen previa, thumbnail, (file)
- Descripción (textarea, 200 caracteres, [a-z,A-Z,0-9,.!?¿¡-/])
- Contenido "html" con estilos predefinidos usando editor TinyMCE.

Tomando esto en cuenta y que no se nos pide la creación de usuarios o algún otro "objeto", se determinó que solo requerimos una tabla, la cual se llamará "Contenidos" con los campos anteriores.

### REST API:
Se creó una REST API con 5 rutas para el manejo y obtención de la información alojada en la base de datos:

**Tipo de solicitudes:**

- GET: Existen dos rutas con solicitud tipo GET, una con la ruta **Contenidos/listaContenidosPortada** para obtener todas las publicaciones subidas al sistema y otra con la ruta **Contenidos/verContenidos** para obtener una publicación en específico con su id.
- PUT: Se creó una solicitud PUT con la ruta **Contenidos/actualizarContenido**, la cual modifica una publicación en específico, utilizando el id de la misma para hacer un update.
- POST: La solicitud tipo POST tiene el objetivo principal de generar y almacenar una nueva publicación en la base de datos con la ruta **Contenidos/nuevoContenido**.
- DELETE: Este último tipo de solicitud no fue pedida en el requerimiento, pero fue incluída debido a que se creyó conveniente para un manejo más sencillo de los registros en la base de datos desde la parte del Front-End. La solicitud tiene como objetivo borrar una publicación utilizando el id proporcionado y utiliza la ruta **Contenidos/eliminarContenido**.

Todas estas solicitudes fueron creadas dentro de un grupo llamado API para facilitar el manejo de las solicitudes. A su vez, las funciones que ocupa la API se encuentran dentro del controlador de *ContenidoController*:

```
$routes->group('api', function($routes){
    
    $routes->get(   'Contenidos/listaContenidosPortada',        'ContenidoController::index'    );
    $routes->get(   'Contenidos/verContenido/(:num)',           'ContenidoController::show/$1'  );
    $routes->put(   'Contenidos/actualizarContenido/(:num)',    'ContenidoController::update/$1');
    $routes->post(  'Contenidos/nuevoContenido',                'ContenidoController::create'   );
    $routes->delete('Contenidos/eliminarContenido/(:num)',      'ContenidoController::delete/$1');   
});
```

### Front-End:

![Personaje principal del juego](/imgs/landing_page.png)

Se utilizó React JS para desarrollar toda la parte visual de la aplicación. La comunicación entre el Back-End y el Front-End se realiza a partir de las rutas definidas, utilizando **AXIOS** para un manejo asíncrono de las solicitudes, de esta forma evitamos que se recargue la pantalla al momento de realizar solicitudes. 

Para evitar un mal manejo de la información que se encuentra almacenada en la base de datos, desde el Back-End se configuró las reglas CORS, definiendo que la ruta del Front-End sea la única que pueda manejar y manipular la información. A momento de llevar a producción y subir la aplicación a la red, se requeriría modificar esta ruta.

Para la creación de los estílos y la UI (interfaz de usuario) se utilizó **Tailwind** con la finalidad de acelerar el proceso de desarrollo. Se utilizaron las clases definidas por el mismo framework, solo añadiendo colores de la marca creada.

Todas las interfaces gráficas fueron diseñadas tomando en cuenta los principios del desarrollo UI/UX, generando interfaces atractivas para el usuario, generando así un producto disfrutable y cómodo para navegar.

### Videojuego:

![Personaje principal del juego](/imgs/cajero.png)

Para la creación del videojuego en la misma página web, se tomó la decisión del uso del framework **Framer Motion**, con el objetivo de manejar de forma más sencilla la función de *Drag and Drop* solicitada, ya que el framework contiene funciones específicas para esta tarea. 

El código maneja la creación de nuevos billetes, es decir, cuando el billete que se encuentra en la cartera del usuario es arrastrado, **se crea un nuevo billete** que de igual forma puede ser arrastrado, teniendo las mismas propiedades que el billete original. Para el manejo de la **eliminación de billetes** se crearon dos funciones: si el usuario arrastra fuera del cajero el billete, este se destruye; cuando el usuario da doble click al billete este también se destruye. El calculo del dinero que existe dentro del cajero se realiza al momento de terminar de arrastrar el billete:

- Si el billete fue arrastrado dentro del cajero, se suma el valor asignado como propiedad en el objeto. 
- Si el billete fue arrastrado fuera del cajero, se resta el valor asignado como propiedad en el objeto.

## Resultados:
Se logró generar una aplicación web completa, desde el Front-End hasta el Back-End, pasando por la mayor parte de las etapas de la ingeniería de software. Como resultado tenemos un Back-End completamente funcional y un Front-End que se comunica con el Back-End de la forma adecuada, mostrando toda la información recuperada de una forma atractiva visualmente, tomando en cuenta que nuestro público objetivo son las personas que buscan artículos educativos para seguir aprendiendo y maximizando la experiencia que pueda tener el usuario al usar la aplicación.

### Futuras mejoras:

Debido al corto tiempo para el desarrollo del producto, los siguientes puntos son consideraciones para mejorar la página:

- La página puede tener un inicio de sesión, implementando roles para que no cualquiera pueda ser capaz de editar todas las publicaciones de la página.
- La funcionalidad del juego falta por ser completada. Al momentos, no existe la funcionalidad de los niveles, la cual puede ser adaptada con el uso de JavaScript.

## Complicaciones:
Sin duda, esta prueba técnica fue un gran reto de desarrollo, pues el objetivo era hacer una web Full-Stack en poco menos de una semana. A pesar de esto, se consiguió crear toda la funcionalidad de la página, a excepción de la lógica del videojuego, por lo que considero que **el resultado fue bastante positivo** a mi consideración.

El framework de PHP en el cual se solicitó desarrollar la aplicación fue completamente nuevo para mi stack de desarrollo, sin embargo, con mi conocimiento en programación y desarrollo Back-End, logré adaptarme de una excelente forma al mismo framework.

Sin duda fue una experiencia bastante gratificante al momento de ver el resultado final. :)