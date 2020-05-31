# CoyoRappi
> El rincón de Coyoisauro.
## Dinos 
:turtle:
## _Integrantes_
* Melo Téllez Mariana Itzel
* Perez Natalia
* Zahuantitla Vázquez José Antonio
## _Instalación del proyecto:_
### _1.Requerimentos generales:_
* Servidor Apache con PHP 7 y Maria DB.
* Navegador Web actualizado(se sugiere ocupar Google Chrome).
* Carpeta del proyecto.
###  _2.Instalación:_
* En caso de no contar con un servidor Apache con PHP 7.2 Y Maria DB, se recomienda descargar XAMPP: [Instalar XAMPP](https://www.apachefriends.org/download.html/) , de preferencia aceptar las configuraciones predeterminadas en la ruta de instalación.
* Una vez instalado, copiar la carpeta "Coyo_Rappi" dentro del directorio "htdocs" en caso de estar utilizando XAMPP o en la carpeta correspondiente si no estamos utilizando Xampp.
* Tras esto, se va a crear la base de datos, para esto es necesario comunicarnos con la consola,  presionar en el caso de Windows, "Windows+R  -> cmd" (Terminal) como atajo de teclado o en su defecto buscar consola o símbolo del sistema en la herramienta de búsqueda de aplicaciones, en el caso de Linux, "Menu K->Sistema->Konsole" (Programa de terminal).
Dentro, escribiremos el path cd xampp/htdocs/CoyoRappi  -  > mysql -u root, tras lo cual escribiremos "CREATE DATABASE Coyo_Rappi". Con esto habremos creado la base de datos, sin embargo falta ocupar el respaldo, por lo que
escribiremos "exit" y proseguiremos a ingresar la siguiente ruta "mysqldump -u root Coyo_Rappi < DB_Coyo_Rappi.sql" 
### _3.Configuraciones generales:_
* Con el fin de evitar un mal uso del sistema, este viene con un único usuario de tipo "Aministrador" preestablecido con los campos "CoyoAdministrador" y "o{H:k5yqa*" como usuario y contraseña respectivamente; sin embargo,
estos se pueden modificar para cumplir los requerimentos del uso que se le vaya a dar, lo que tenemos que hacer es en la consola (Revisar instalación), escribir el siguiente comando "UPDATE administrador SET usuario='usuario deseado' && contraseña= 'contraseña' WHERE usuario=''CoyoAdministrador".
* Como el sistema almacena la fecha y hora de los registros realizados, es recomendable revisar que la zona horaria en la que está configurada MYSQL sea la correcta, para esto escribiremos el comando "SELECT NOW()", si tanto la fecha como la hora coinciden con la
actual entonces podremos continuar.
 ### _4.Uso (Aministrador):_
* El usuario de tipo administrador tendrá ciertos permisos entre los que se encuentran el modificar, eliminar y agregar los alimentos de la base de datos, así como modificar la informacion de los usuarios y el eliminar estos mismos.
* Para poder ingresar como administrador es necesario entrar a la página principal del sistema "localhost/Coyo_Rappi/Templates/Coyo_Rappi.html" y presionar sobre el botón derecho que dice administrador, una vez ahí se pedirá que se ingrese un usuario y contraseña(los definidos anteriormente).
Una vez ingresados, si los campos son correctos nos permitirá entrar a una interfaz dónde podremos seleccionar la acción que queremos realizar y llevarla acabo.
* Una de las principales funciones del Administrador es la de ser el único usuario con la capacidad de agregar otros supervisores y administradores, por lo que, una vez que sean designados, sólo se podran registrar directamente por el administrador.

 ### _5.-Uso(Supervisor):_
* El tipo de usuario Supervisor tiene los permisos necesarios para manipular los pedidos y modificar el estado de estos mismos y de los clientes(Alumnos, Profesores, Funcionarios y Trabajadores). Para ingresar como supervisor daremos clic sobre el botón 
de la págian principal que dice la leyenda Supervisor, esto nos llevará a un formulario de inicio de sesión, como se mencionó anteriormente no hay forma de que el supervisor se registre por si mismo. 
* _Si ya fue registrado, ingresará a una interfaz que posee
dos vistas:_
* La primera corresponde para los pedidos pendientes donde podrá atenderlos con las opciones que se oeresentan a la izquierda de estos, podremos ver que en la parte superior habrá una barra donde se leerá "Pedidos", "Alertas", "Cerrar Sesión",
* La pestaña de alertas por el contraio de la de pedidos contiene todos aquellos pedidos que no se recogieron en el tiempo establecido por lo que su tarea será seleccionar el pedido y dar clic en "Sancionar".

## _Resumen del funcionamiento:_
Coyo_Rappi es un sistema de pedidos que busca hacer más eficaz la entrega de comida de la cafetería de la escuela nacional preparatoria número 6 Antonio Caso, este posee 3 clases de usuarios (Administrador, Supervisor y Cliente) y 3 a su vez,
cuatro tipos de clientes (Alumnos, Profesores, Trabajadores, Funcionarios). Posee una página principal donde dependiendo del usuario podemos elegir entre alguna de las opciones presentadas, así como una barra de navegación para poder moverse alrededor del sitio
de una forma más sencilla, la última opción de la barra de navegación posee la leyenda "Ayuda" y busca se una guía para los clientes ya que aunque se considera intuitivo el movimiento por el sitio, podrían llegar a surgir dudas entorno a la entrega de pedidos.
Coyo_Rappi permite a los usuarios una visualización de los productos disponibles en ese momento dentro de la cafetería, de tal forma que puedan pedir cierta cantidad de un mismo alimento, vean el monto total y decidan si confirmar o cancelar la compra así como
dónde desean recibir su orden o en su defecto recogerla en cafetería en cierto tiempo, el cual de expirar antes de recoger el pedido, provocará una sanción de 5 días sin utilizar el servicio.

### _Soluciones a posibles problemas:_
En caso de accidentalmente borrar el usuario Administrador, será necesario crear uno nuevo desde la consola, para esto, tendremos que ingresar el siguiente path "cd xampp/mysql/bin"  -  >  "mysql -u root" -  >  "USE Coyo_Rappi"  -  >  "INSERT INTO administrador ('usuario','contraseña') VALUES ('usuarioDeseado', 'contraseñaDeseada').

### _Comentarios Adicionales:_
Es posible que se requiera ajustar el proyecto a sus necesidades, gracias por preferirnos.:octocat:
