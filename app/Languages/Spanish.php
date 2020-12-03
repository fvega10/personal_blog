<?php namespace MyApp\Languages{
        
    class Spanish
    {
    	public $lang = null;
        public function __construct()
        {
			$year = (date('Y') - 1991);
			$this->lang =
			[
				"Likes" => "¡Gracias por tu Me gusta!",
				"Firts_tittle_principal"  => "Fabricio Vega Ugalde",
				"Firts_tittle_secondary"  => "Desarrollador de Sitios y Aplicaciones Web",
				"About_button"            => "Sobre Mí",
				"About_tittle"            => "Fabricio Vega Ugalde",
				"Close_button"            => "Cerrar",
				"Second_tittle_principal" => "Proyectos desarrollados",
				"Second_tittle_secondary" => "<<< Deslizar hacia la derecha o hacia la izquierda >>>",
				"Third_tittle_principal"  => "Artículos recientes",
				"Four_tittle_principal"   => "Información",
				"Development_projects"    => "Proyectos desarrollados",
				"Year_experience"         => "Años de experiencia",
				"Tools_used"              => "Herramientas tecnológicas utilizadas",
				"Five_tittle_principal"   => "¿Cuáles tecnologías usualmente implemento?",
				"Visited_number"          => "Eres el visitante",
				"Visited_thanks"          => "¡Gracias por su visita!",
				"Home_button"             => "Inicio",
				"Contact_button"          => "Contacto",
				"Back_button"             => "Regresar",
				"Other_articles"          => "Otros Articulos",
				"Autor_tittle"            => "Autor",
				"Publish_tittle"          => "Publicado",
				"Category_tittle"         => "Categoría",
				"Likes_tittle"            => "Me gustas",
				"Contact_title" => "Inicie un proyecto",
				"Contact_info" => "¿Tienes interés en que trabajemos juntos? Contáctame al WhatsApp",
				"Contact_btn" => "Hablemos",
				"change_language" => "Change to English",
				"Category" => "Categoría",
				"Services" => "Servicios",
				"Service_1" => "Desarrollo de Sitios Web",
				"Service_1_Detail" => "Sitios web profesionales, desarrollados con tecnología de punta, que permiten transmitir profesionalismo, seguridad y confianza a los diferentes clientes que navegan por internet.
				<br>
				Un Sitio Web permite crear mayor presencia en la www, crear contenido de interés en un blog y compartirlo en redes sociales, es una buena estrategía para atraer a más clientes de forma orgánica (sin paga) a tu sitio, y con ello lograr concretar tu objetivo, que puede ser:
				concretar una venta en línea, lograr el contacto para más información acerca de un producto, entre otros.",
				"Basic" => "Básico",
				"Basic_Amount" => "₡10,000.00 / mensual",
				"Detail_0" => "Diseño y Desarrollo del sitio web",
				"Detail_1" => "Capacidad para auto-administrar",
				"Detail_2" => "Dominio y servicio de hosting",
				"Detail_3" => "Páginas de: Bienvenida, Acerca de, Contacto, Servicios, Blog, galería",
				"Detail_4" => "Todas las páginas deseadas",
				"Detail_5" => "Correo empresarial",
				"Detail_6" => "Seguridad SSL en el sitio web (candado verde)",
				"Detail_7" => "Diseño y Desarrollo de la aplicación web",
				"Detail_8" => "Conexión segura a base de datos",
				"Detail_9" => "Dominio y servicio de hosting",
				"Detail_10" => "Software web a la medida",
				"Business" => "Empresarial",
				"Business_Amount" => "Precio con base a requerimientos",
				"Detail_Button" => "Deseo Información",
				"Intermediate" => "Intermedio",
				"Intermediate_Amount" => "₡20,000.00 / mensual",
				"Premium" => "Premium",
				"Premium_Amount" => "₡35,000.00 / mensual",
				"Service_2" => "Desarrollo de Aplicaciones Web",
				"Service_2_Detail" => "Una Aplicación Web permite definir y crear una estructura empresarial bien definida, que puede ir desde la creación de un sitio para controlar tu lista de tareas, hasta la creación de un punto de ventas.
				<br>
				Si eres un o una empresaria pequeña, mediana o grande o bien, ofreces algún bien o servicio, quizás estés en la necesidad de alguna aplicación para darle otro nivel a tu mix de negocio. <br> Este servicio puede ser de tu interés.
				<br>
				Una aplicación web no precisamente debe estar en línea, de hecho existen algunos sitios que únicamente funcionan en equipos de tu misma red, como por ejemplo las llamadas Intranet. <br>
				Levantemos juntos una lista de requerimientos y permíteme llevarte a otro nivel.",
				"Contact_Form" => "Formulario de Contácto",
				"Contact_Form_Name" => "Nombre",
				"Contact_Form_Email" => "Correo electrónico",
				"Contact_Form_Message" => "Mensaje",
				"Contact_Form_Button" => "Enviar",
				"WhoIAm" => 
				"¡Hola! soy Fabricio Vega, tengo " . $year . " años de edad, y soy Ingeniero del Software y Licenciando en Administración de Empresas. 
				<br>
				Desde pequeño he sido amante de las matemáticas, del fútbol y hoy por hoy, amante de la creación de sitios web, software a la medida web y aplicaciones móviles.
				<br>
				Mi pasión cambió cerca de los 19 años, pasando de entrenar diariamente en campos de fútbol, ha estar en un escritorio
				digitando grandes cantidades de líneas de código para la creación de cosas fascinantes. 
				<br>
				<br>
				<strong style='font-weight: bold;'>Misión:</strong> <br> 
				Visualizar necesidades en la población de manera que, con el conocimiento en el ambiente tecnológico pueda aportar mi granito de arena.
				<br>
				Cada vez que ingreso a un sitio web en donde se ofrece 'X' servicio y estos están inundados en publicidad, me lloran los ojos e intento desarrollar algo parecido.
				<br>
				Quiero poder ayudar a pequeños empresarios con la creación de palancas tecnológicas que les permita proyectar su negocios a otro nivel.
				<br>
				Esto se ha convertido en un verdadero hobbie para mí.",
				"Phrase" => "Una vez un filósofo dijo: <strong>El placer en el oficio trae la perfección en el trabajo</strong>. Hace 6 años tenía curiosidad por cómo desarrollar sitios web, para poder subir los conocimientos adquiridos en mi carrera de administración de empresas a una plataforma web, así que empíricamente en ese momento inicié el camino que hoy es mi mayor pasión, con la que he logró desarrollar más de 100 proyectos personales y empresariales. Sumado a esa gran pasión, puedo destacar la fascinación por el diseño gráfico y el amor por el fútbol. Por muchas cosas puedo decir que soy un apasionado de lo que hago y una persona verdaderamente fiel a quienes me demuestran su cariño.",
				"Phone" => "Teléfono",
				"CopyRight" => "Todos los derechos reservados"
			];
		}
	}
}
?>