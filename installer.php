<?php
//connection.php
function replace_string_in_file($filename, $string_to_replace, $replace_with){
    $content=file_get_contents($filename);
    $content_chunks=explode($string_to_replace, $content);
    $content=implode($replace_with, $content_chunks);
    file_put_contents($filename, $content);
}

  $filename="php/connection.php";
  $string_to_replace="url";
  $replace_with=$_POST['dburl'];
  replace_string_in_file($filename, $string_to_replace, $replace_with);

  $string_to_replace="url";
  $replace_with=$_POST['dburl'];
  replace_string_in_file($filename, $string_to_replace, $replace_with);

  $string_to_replace="user";
  $replace_with=$_POST['dbuser'];
  replace_string_in_file($filename, $string_to_replace, $replace_with);

  $string_to_replace="password";
  $replace_with=$_POST['dbpass'];
  replace_string_in_file($filename, $string_to_replace, $replace_with);

  $string_to_replace="dbname";
  $replace_with=$_POST['dbname'];
  replace_string_in_file($filename, $string_to_replace, $replace_with);

  include_once("php/connection.php");

//admin user

$sql="INSERT INTO `users` (`id`, `nick`, `email`, `password`,
   `address`, `type`, `name`, `surname`,`theme`) VALUES
   (1,'".$_POST["appadmin"]."', '' ,'".$_POST["apppass"]."', NULL , 'admin',
   NULL , NULL, 'index.css' );";

 $result = $connection->query($sql);
 $sql=" UPDATE `users` SET `password` = MD5('12345') WHERE `users`.`id` = 1;";
 $result = $connection->query($sql);


//cars
if (isset($_POST['coches'])) {
  $sql="INSERT INTO `item` (`reference`, `name`, `value`, `chassis`, `traction`, `transmission`, `type`, `description`, `description_long`, `stock`, `pic`) VALUES
  (9, 'Fiat Multipla', 1220, 'Monovolumen', 'Delantera', 'Manual', 'Diésel', 'El Fiat Multipla es un monovolumen producido por el fabricante italiano Fiat desde 1998 hasta 2010. Se fabricó en la planta turinesa de Fiat Mirafiori.\nEl motor del Multipla es un gasolina de 1,6 litros con 102 CV de potencia máxima. La caja de cambios es manual con 5 velocidades.', 'El diseño peculiar del Fiat Multipla, con sus proporciones inusuales y un escalón entre el capó y el parabrisas, lo llevó a ser expuesto en el Museo de Arte Moderno de Nueva York (MoMA), aparecer en la película futurista Children of Men y recibir el galardón Automóvil más feo de 1999 por el programa de televisión inglés Top Gear. <br /> <br /> En el año 2004 el frontal fue reestilizado, perdiendo el escalón frente al parabrisas, mientras que la calandra y los faros fueron modificados para asemejarlos con los modelos contemporáneos de Fiat. El Multipla usa la plataforma C1 Sandwich, basada en el Fiat Bravo/Brava. Con respecto a otros monovolúmenes de su categoría, el Multipla es mucho más ancho y corto. A diferencia de ellos posee, al igual que el Fiat 600 Multipla de 1956, seis plazas, que están dispuestas en dos filas de tres asientos. Este formato fue posteriormente imitado en el Honda FR-V.', 1, 'images/multipla.jpg'),
  (10, 'BMW X6', 32000, 'Todocamino', '4x4', 'Manual', 'Diésel', 'El BMW X6 representa una nueva categoría automovilística con un concepto de diseño diferente. El primer Sports Activity Coupé del fabricante fascina por un diseño que mezcla la elegancia y deportividad de un gran coupé con el aplomo y solidez de un modelo X de BMW.', 'La primera generación (E71) fue comercializada en 2008. Debutó combinando los atributos de un SUV (altura libre al suelo y capacidad de tracción integral a las cuatro ruedas) unido a la pose de vehículo coupé con una estética de gran dinamismo y aplomo. Su diseño específico y extravagante cuenta con una sección frontal que se distingue por su apariencia deportiva de líneas claramente estructuradas, con grandes entradas de aire.  <br /> <br /> El perfil es alargado, con una superficie acristalada esbelta y líneas de carrocería que guían la vista hacia las ruedas, acentuando el aplomo del coche. Las proporciones corresponden a las de un coupé clásico. La línea dinámica del techo termina de manera armónica en la zaga, dejando una sensación de diseño imponente en su conjunto. La segunda generación (F16) se presentó en el Salón de París en 2014.  ', 1, 'images/original.jpg'),
  (11, 'Mercedes Clase C', 38000, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'El Mercedes Clase C es el coche que el segmento de las berlinas medias estaba esperando. Se trata de un producto que disfruta de un dinamismo y deportividad con el modelo precedente solo podía soñar. Sin duda, Mercedes-Benz quiere hacer mucho daño en el segmento y es por ello que los ingenieros de la firma de la estrella han creado un producto francamente convincente.', 'Esta berlina utiliza una nueva plataforma que ya se emplea en una batería de nuevos modelos de Mercedes. De hecho, son nada menos que cuatro las variantes disponibles de la gama del Clase C, pues además de la berlina de cuatro puertas, encontramos al Clase C Estate con carrocería familiar, al Clase C Coupé de dos puertas y por último, al más reciente de la gama, al nuevo Clase C Cabrio con capota de lona escamoteable.  <br /> <br />   En el nuevo Mercedes Clase C berlina ha aumentado sus dimensiones. La batalla crece en 80 milímetros en comparación con el antecesor, la longitud del vehículo 95 milímetros, y la anchura, otros 40 milímetros. Los ocupantes de las plazas traseras son los principales beneficiarios del incremento resultante en las cotas del habitáculo y pueden disfrutar de un mayor confort en sus viajes.Esta berlina utiliza una nueva plataforma que ya se emplea en una batería de nuevos modelos de Mercedes. De hecho, son nada menos que cuatro las variantes disponibles de la gama del Clase C, pues además de la berlina de cuatro puertas, encontramos al Clase C Estate con carrocería familiar, al Clase C Coupé de dos puertas y por último, al más reciente de la gama, al nuevo Clase C Cabrio con capota de lona escamoteable.  <br /> <br />   En el nuevo Mercedes Clase C berlina ha aumentado sus dimensiones. La batalla crece en 80 milímetros en comparación con el antecesor, la longitud del vehículo 95 milímetros, y la anchura, otros 40 milímetros. Los ocupantes de las plazas traseras son los principales beneficiarios del incremento resultante en las cotas del habitáculo y pueden disfrutar de un mayor confort en sus viajes.', 1, 'images/mercedesclasec.jpg'),
  (15, 'Tesla Modelo S', 90000, 'Berlina', 'Trasera', 'Automático', 'Eléctrico', 'El Tesla Model S es una berlina de lujo de cinco puertas. Comercializado desde 2012, cuenta con la máxima calificación en materia de seguridad y, es todo un éxito en materia de ventas dentro y fuera de los Estados Unidos. Equipado con un paquete de baterías de 85 kWh, supera en autonomía al Tesla Roadster, siendo capaz de recorrer más de 400 kilómetros entre carga y carga.', 'El motor va en el eje trasero y las baterías van tumbadas en el suelo. ¿Resultado? Un centro de gravedad más bajo para que la berlina vaya a la misma distancia del asfalto que un deportivo. El Tesla Model S está disponible en dos configuraciones diferentes de tracción: trasera y tracción total con motor dual. Esta última configuración equipa un motor en ambos ejes, monitorizados y controlados digitalmente, que permite una tracción óptima en cualquier situación. <br /><br />  El Tesla Model S maximiza la capacidad del bloque de baterias con un diseño aerodinámico de lineas fluidas permitiendo una resistencia menor en el flujo de aire. En el interior llama la atención la pantalla táctil de 17 pulgadas, en ángulo hacia el conductor e incluye tanto los modos de día y de noche para una visibilidad sin distracciones. ', 1, 'images/teslamodels.jpg'),
  (16, 'Ford Focus RS ', 41000, 'Hatchback', 'AWD', 'Manual', 'Gasolina', 'El nuevo Focus RS con motor EcoBoost de 2,3 litros presenta unas cifras impresionantes.   Todas ellas se han mejorado gracias a una serie de avanzadas tecnologías orientadas al rendimiento, como la tracción a las cuatro ruedas, el control de aceleración o los modos de conducción seleccionables.', 'La tracción a las cuatro ruedas (AWD) Ford Performance con control vectorial del par dinámico proporciona, un agarre excepcional y un paso por curva óptimo.El sistema emplea un doble embrague con control electrónico que ayuda a repartir el par motor entre las ruedas traseras en función de la superficie y las condiciones de conducción. Además, esta tecnología inteligente también le permite disfrutar de un derrape con sobreviraje controlado en conducción deportiva.  <br /><br />  La revolucionaria tecnología del motor EcoBoost de 2,3 litros incorpora inyección directa de combustible, doble distribución variable independiente y turbocompresor de doble entrada (twin-scroll). Esta tecnología, específicamente afinada y calibrada para el nuevo Focus RS permite disponer de una potencia máxima de 350 CV y un par máximo de 440 Nm (overboost de 470 Nm). A su excelente capacidad de respuesta a bajas revoluciones cabe sumar su excelente empuje en la zona media pudiendo llegar hasta 6800 rpm.', 1, 'images/2016-Ford-Focus-RS-lp-2.jpg'),
  (18, 'Range Rover', 69000, 'Todoterreno', '4x4', 'Manual', 'Gasolina', 'El Range Rover Sport SVR derrocha deportividad por los cuatro costados y se presenta oficialmente como el SUV más rápido sobre Nürburgring. ¿Cómo lo consigue? Sin duda, con su poderoso motor V8 de 5,0 litros sobrealimentado que desarrolla 550 CV y 680 Nm de par máximo.', 'Con estas especificaciones, no tiene problemas para devorar el mítico trazado alemán puesto que acelera de 0 a 100 km/h en 4,7 segundos, con una velocidad máxima de 260 km/h. Si parece poco, el Range Rover Sport SVR utiliza un sistema de escape activo con control eléctrico y su bastidor se pone al nivel de las exigencias del nuevo motor. <br /><br />Para optimizar el reparto de la tracción, se ha recalibrado el bloqueo del diferencial trasero activo. Ahora, el diferencial se bloquea antes para que el par se transfiera a la rueda trasera aumentando así la agilidad.', 1, 'images/range_rover_sport_2014_c01.jpg'),
  (19, 'Audi Q7', 63000, 'SUV', '4x4', 'Manual', 'Gasolina', 'Mucho más ligero, ágil y deportivo. Así es el nuevo Audi Q7. Los de Ingolstadt han creado un duro rival para el Porsche Cayenne y el BMW X5. El diseño no sorprende en exceso. No cabe duda de que es un SUV atractivo, pero recuerda en exceso al modelo anterior.', 'Así que uno apenas sospecha al primer vistazo que apenas comparte una pieza con su antecesor, que se trata de un modelo completamente nuevo, y más bien parece un ‘facelift’. Pero no es así en absoluto. Hay que fijarse para ver dónde están las novedades de la carrocería. Y en cuanto lo pones en la báscula, uno se da cuenta del milagro: ahorra nada más y nada menos que 325 kilos respecto al anterior, y logra quedarse por debajo de las dos toneladas.<br /><br /> Primera sorpresa. En el interior sí que se notan las diferencias: es más moderno y ergonómico, transmite aún más calidad que el del modelo anterior y sus sistemas multimedia y de conectividad se han puesto a la última. La cura de adelgazamiento se nota: su construcción ligera y el nuevo chasis de cinco brazos, así como motores más potentes y la opción de las ruedas traseras direccionales o la suspensión neumática dejan patente que  transmite más ligereza y es más manejable. <br /><br />A las salidas de los semáforos empuja con agresividad, pasa por las curvas ágil y aplomado, en superficie irregular filtra con eficacia y confort. En carreteras de montaña, da la impresión de estar conduciendo un Audi Q5 con traje de gala. En cuanto a la gama de motores, el Q7 cuenta con un 3.0 TDI de 272 CV, y un 3.0 TFSI de 333 CV.', 1, 'images/audi-q7_2016_c01.jpg'),
  (23, 'Infiniti Q50', 35000, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'El Infiniti Q50 realmente supone una nueva era para la marca. Además, es el primer Infiniti que estrena una nueva nomenclatura para la futura gama de vehículos de la compañía con el prefijo Q para berlinas, coupés y cabrios. Esta berlina es algo más que una simple letra nueva', 'Para empezar, el diseño exterior del Infiniti Q50 ha sido influenciado por la trilogía de los concept cars de Infiniti: Essence, Etherea y Emerg-e. En el interior del Infiniti Q50, la sensación de doble cabina se consigue mediante un panel de control en forma de doble onda.<br /><br />\r\nAdemás, la calidad en acabados y ajustes corresponde sin duda al segmento de las berlinas premium como el BMW Serie 3, el Audi A4 o el Mercedes Clase C, donde el Q50 quiere ser un competidor de verdad.<br /><br />\r\n Con una distancia entre ejes de 2.850 mm, el Infiniti Q50 cuenta con un amplio espacio para los pasajeros adultos en las filas delantera y, sobre todo, en la trasera, donde dos adultos de 1,80 metros no tendrán mayor problema, con uno de los mejores espacios para las rodillas de su clase.', 1, 'images/infiniti-q50_2014_c01.jpg'),
  (24, 'Jaguar XF', 43003, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'La primera generación del Jaguar XF ha cosechado un gran éxito, basada en su atractivo diseño, que mezcla elegancia y deportividad. Gracias a eso ha aguantado en tipo durante todos estos años, ya que se lanzó en 2008 (tuvo un restyling en 2011). Ahora el nuevo Jaguar XF actualiza sus formas, y renueva su gama mecánica.', 'Por fuera destaca un frontal que mantiene la esencia, pero que incorpora nuevos faros con luces de día LED, aunque lo que más destaca es su nueva plataforma y su construcción monocasco en la que se ha usado principalmente el aluminio (el 75% es de aluminio), lo que se traduce en una mayor ligereza (concretamente es un 11% más ligero que antes). <br />\r\n<br />\r\nEn total se ahorran 190 kilos, y se aumenta la rigidez (en un 28%). El interior, pese a que el Jaguar XF es más bajo que el anterior, logra una mejor cota de altura disponible para la cabeza en las plazas traseras, que ganan 27 milímetros. <br />\r\n<br />\r\nAdemás, la batalla gana 5 mm, que no es demasiado, pero no hace sino incrementar la sensación de espacio interior. Del mismo modo, se ha estudiado especialmente la aerodinámica en el nuevo Jaguar XF y con un Cx de 0,26 logra un gran indice de penetración en el aire si lo comparamos con su competencia. <br />\r\n<br />\r\nSu objetivo es enfrentarse a berlinas premium como el BMW Serie 5 o el Audi A6.', 1, 'images/jaguar-xf_2016_c01.jpg');
";
     $result = $connection->query($sql);

//if cars are not selected, delete de images.
} else {
  $files = glob('images/*');
  foreach($files as $file){
    if(is_file($file))
      unlink($file);
  }
}
//test users
if (isset($_POST['usuarios'])) {
  $sql="INSERT INTO `users` (`id`, `nick`, `email`, `password`, `address`, `type`, `name`, `surname`, `theme`) VALUES
  (NULL, 'tester', 'testerino@tester.com', '827ccb0eea8a706c4c34a16891f84e7b', 'testerlandia', 'user', 'teste', 'ino', 'index.css'),
  (NULL, 'prueba', 'prueba@prueba.com', '827ccb0eea8a706c4c34a16891f84e7b', 'asd', 'user', 'asd', 'asd', 'index.css');
";
     $result = $connection->query($sql);
}
//rename and delete all install files
unset($connection);
rename("index.php", "delete1");
rename("index0.php", "index.php");
unlink("delete1");
header("Location: index.php");
unlink(__FILE__);
 ?>
