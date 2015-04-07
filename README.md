# Archivos: principal.js
Son los que tienen funciones geneéricas que pueden ser usadas en todo el sistema sin limitarse a un módulo/comportamiento específico

#Modules: array();
Mediante un array doy de alta módulos, si existe en el array se pueden crear dentro de modules de lo contrario, envía un error. Si no es un módulo, no se da de alta en el array y se crea su controlador y su vista en las carpetas de la raíz

#Libs: librerias
Librerías de terceros que podemos usar (sin modificarlas) para añadir funcionalidades a la aplicación

#Core: Núcleo
Nucleo principal, contiene los archivos usados para la BD, sesiones, controlador y módulo principal, auto inicio, vista y funciones de PHP genéricas para usar en el sistema.

#Controllers: controladores
Todos los controladores que heredan del controlador principal, sin estos las rutas no exiten. Si es un módulo dentro de cada módulo se encontrará sus propios controladores que heredan del controlador de la carpeta controllers principal

#Models: modelos
Todos los modelos de la raíz, si es un módulo, se encontrará dentro de este y heredará directo del Model de core

#Views: vistas
Todas las vistas del sistema (html), img, js, css, que aplican para el módulo en especifico

#index.php
Se importan las librerías de core y se auto inicia las peticiones para comenzar a correr la aplicación

#config.ini
Archivo de definicion de variables globales (define)

#config.php
Llama al archivo config.ini, define las variables constantes y su valor. Definimos si se muestran los errores o no dependiendo si el sistema está en test o en producción.