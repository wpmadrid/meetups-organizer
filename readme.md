# Meetups Organizer

El objetivo de este plugin es crear un Custom Post Type en el que publicar los distintos Meetups que organicen las comunidades, sean o no sean de WordPress, para que estos sean visibles en los sitios web de dichas comunidades.

## Requisitos

- [WordPress 5.4](https://es.wordpress.org/download/)
- [Advanced Custom Field PRO](https://www.advancedcustomfields.com/pro/)
- PHP 7.2
- Muchas ganas de montar un Meetup

## Instalación

1. Entra en la [URL del repositorio](https://github.com/wpmadrid/meetups-organizer). Seguramente, si estás leyendo esto, ya estarás en ella.
2. Verás un botón verde chillón, que pone "Clone or download". Haz clic sobre él y después, sobre "Download ZIP".
3. Una vez que te has descargado el ZIP, descomprímelo en tu carpeta de descargas (no en la carpeta "plugins" de tu instalación de WordPress).
4. Renombra la carpeta del plugin de "meetups-organizer-master" a "meetups-organizer".
5. Mediante un servidor FTP, sube la carpeta del plugin al directorio de plugins de tu instalación de WordPress (wp-content/plugins).
6. Accede al panel de administración de WordPress.
7. En el menú lateral, haz clic sobre "Plugins".
8. Buscar el plugin "Meetups Organizer" y haz clic sobre "Activar".

Y, voilà!!! Con estos sencillos pasos, tendrás el plugin instalado.

## Funcionamiento

Una vez instalado el plugin, verás que en tu menú de WordPress, aparece una nueva opción: Meetups. Esta opción, conduce a un Custom Post Type y su forma de contribuirlo es similar a las páginas y entradas. No obstante, te explico cómo hacerlo.

1. Haz clic sobre la opción del menú "Meetups".
2. En la pantalla que se muestra, aparecerá un listado de todos los Meetups que tengas publicados.
3. Si aún no tienes ninguno publicado, es el momento de hacerlo. Para ello, haz clic sobre "Añadir nuevo".
4. En tu pantalla, aparecerá el editor de bloques, así que da rienda suelta a tu imaginación y añade todo el contenido que creas necesario para tu Meetup.
5. En las opciones de la entrada, a la derecha de la pantalla, podrás añadir una imagen destacada para el Meetup. También podrás añadir una temática (subject), para clasificar el Meetup.
6. Debajo del editor de bloques, aparecerán una serie de campos propios de este Custom Post Type:
    - Código del vídeo: Este campo, permite añadir un vídeo de YuoTube (normalmente, la grabación o el streaming del Meetup) para que aparezca en la cabecera de la entrada. Si la URL de nuestro vídeo es https://www.youtube.com/v=XXXXXXXX, en este campo deberás añadir el valor XXXXXXXX.
    - ¿Chat activado?: Marcando esta casilla, aparecerá un chat para que los asistentes al Meetup hagan preguntas e interactúen con el resto. Para ello, deberás tenerlo activo también en YouTube.
    - Ponentes: Permite añadir hasta 5 ponentes, proporcionando la siguiente información:
        - Nombre.
        - Foto.
        - Enlace a su web, perfil de LinkedIn, Twitter,...

Cuando tengas todo esto, tu Meetup estará listo para ser publicado.

## Nota informativa

Este es un proyecto Open Source, así que siéntete libre de descargarlo, utilizarlo y proponer nuevas características y funcionalidades.

El plugin está aún en fase beta, por lo que disculpa si encuentras algún error. De ser así, por favor, házmelo saber.

Si te animas, estaré encantado de aceptarte una Pull Request, pero ten en cuenta, que no aceptaré PR's que no tengan un comentario o que traigan algún tipo de código malicioso.

## Agredecimientos

Quisiera agradecer a la [comunidad de WPMadrid](https://wpmadrid.es/) que me hayan dado la oportunidad de desarrollar este plugins para nuestros Meetups y a [Sonia Ruiz](https://twitter.com/Yune__vk) por echarme una mano con la maquetación de los archivos "archive.php" y "single.php".