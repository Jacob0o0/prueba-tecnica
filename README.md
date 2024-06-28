# Prueba técnica para la vacante de Desarrollo Full Stack Jr

Este repositorio y aplicación fue creado con el propósito de realizar la prueba técnica asignada por "PruebaT" para el proceso de contratación por la vacante de Desarrollo Full Stack Jr.

## A realizar:

Realizar un sistema usando el framework CodeIgniter y MySQL para la gestión y despliegue de "contenido educativo". 

Implementar los servicios REST detallados más adelante en un controlador llamado Contenidos usando seguridad basica.

REST: Lógica de restricciones y recomendaciones para las cuales se debe construir una API.

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
	* Si está en modo edición al dar en el botón de guardar se realizará la actualización del contenido. En caso que se esté en modo
	  de nuevo contenido hará la inserción de un nuevo contenido. Se registra en la base de datos la fecha y hora de la operación.
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
Se analizaron los requerimientos y se diseñaron las páginas solicitadas en figma, creando solo los wireframes para agilizar el proceso de desarrollo. Seguido de esto, se determinó que el uso del framework de React sería el adecuado para lo que se necesita hacer en la parte del Front-End. Para el backend se utilizará CodeIgniter como se solicita.

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

Tomando esto en cuenta y que no se nos pide la creación de usuarios o algún otro "objeto", se determinó que solo requerimos una tabla, la cuál se llamará "Contenidos" con los campos anteriores.

CAMBIOS:
- Filters/Cors.php
- Models/ContenidoModel.php
- Controllers/ContenidoController
- Migratios...
- Config/Routes.php
- Config/Filters.php
- .env