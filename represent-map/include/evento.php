<?php

Class Evento {

	var $id;
	var $name;
	var $direccion;
	var $descripcion;
	var $url;
	var $lat;
	var $lng;
	var $category;
	var $subcategory;
	var $fecha_creacion;
	var $fecha;
	var $aprobada;
	// Events categories
	static $events_categories = array(
		"ciclismo" => array("name" => "Ciclismo", 
							"code" => "0"),
		"running" => array("name" => "Running", 
							"code" => "1"),
		"escalada" => array("name" => "Escalada", 
							"code" => "2"),
		"deportes_de_invierno" => array("name" => "Deportes de invierno", 
										"code" => "3"),
		"senderismo" => array("name" => "Senderismo", 
								"code" => "4"),
		"piraguismo" => array("name" => "Piragüismo", 
								"code" => "5"),
		"triatlon" => array("name" => "Triatlón", 
							"code" => "6"),
		"deportes_nauticos" => array("name" => "Deportes náuticos", 
										"code" => "7"),
		"motociclismo" => array("name" => "Motociclismo", 
								"code" => "8"),
		"otros" => array("name" => "Otros", 
						"code" => "9")
	);
	// Events subcategories
	static $events_subcategories = array(
	    "ciclismo"              => array(	"mtb_btt"                         	=> "MTB/BTT",
					                        "cicloturismo"                     	=> "Ciclocolturismo",
					                        "trial"                            	=> "Trial",
					                        "bmx"                              	=> "BMX",
					                        "carretera"                        	=> "Carretera",
					                        "otros"                            	=> "Otros"),
	    "running" 				=> array(	"carreras_populares"               	=> "Carreras populares",
					                        "trail"                          	=> "Trail",
					                        "maraton"                			=> "Maratón",
					                        "medio_maraton"          			=> "Medio maratón",
					                        "canicross"                       	=> "Canicross",
					                        "otros"                        		=> "Otros"),
	    "escalada" 				=> array(	"escalada_en_roca"                  => "Escalada en roca",
					                        "grandes_paredes"                   => "Grandes paredes",
					                        "boulder"                           => "Boulder"),
	    "piraguismo" 			=> array(	"kayak"                           	=> "Kayak",
				                            "kayak_polo"                   		=> "Kayak Polo",
				                            "descensos"                     	=> "Descensos",
				                            "otros"                         	=> "Otros"),
	    "motociclismo" 			=> array(	"grandes_premios"                   => "Grandes premios",
				                            "motocross"                         => "Motocross",
				                            "enduro"                            => "Enduro",
				                            "trial"                             => "Trial",
				                            "freestyle"                         => "Freestyle",
				                            "otros"                             => "Otros"),
	    "deportes_de_invierno" 	=> array(	"esqui_de_fondo"                    => "Esquí de fondo",
		                                    "raquetas_de_nieve"                 => "Raquetas de nieve",
		                                    "esqui_extremo"                     => "Esquí extremo",
		                                    "snowboard"                         => "Snowboard"),
	    "triatlon" 				=> array(	"triatlon"                          => "Triatlón",
					                        "duatlon"                           => "Duatlón",
					                        "acuatlon"                          => "Acuatlón"),
		"senderismo" 			=> array(	"senderismo" 						=> "Senderismo"),
	    "deportes_nauticos"		=> array(	"vela"                              => "Vela",
		                                    "windsurf"                          => "Windsurf",
		                                    "kitesurf"                          => "Kitesurf",
		                                    "surf"                              => "Surf",
		                                    "otros"                             => "Otros"),
		"otros" 				=> array(	"otros" 							=> "Otros")
	);

	function Evento($nname,$ndescripcion, $nurl,$ndireccion,$nlat,$nlng,$ncategory, $nsubcategory,$nfecha){
		$this->name = $nname;
		$this->descripcion = $ndescripcion;
		$this->url = $nurl;
		$this->direccion = $ndireccion;
		$this->lat = $nlat;
		$this->lng = $nlng;
		$this->category = $ncategory;	
		$this->subcategory = $nsubcategory;	
		$this->fecha = $nfecha;
	}

	function guardarDB($wpdb) {
		$fecha = new DateTime($this->fecha);
		$fecha = $fecha->format('Y-m-d H:i:s');
		return $wpdb->insert( 
			'wp_evento', 
			array( 
                'name'          => $this->name,
                'description'   => $this->descripcion,
                'url'           => $this->url,
                'address'       => $this->direccion,
                'lat'           => $this->lat,
                'lng'           => $this->lng,
                'category'      => $this->category,
                'subcategory'   => $this->subcategory,
                'date'          => $fecha
			)
		);
	}

	function getEventos($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_evento	
			");
	}

	function getEventosAprobados($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_evento
			where approved='1'
			");
	}

	function getEventoscategory($wpdb, $category){
		return $wpdb->get_results("
			SELECT *
			FROM wp_evento
			where category='$category'and approved='1' ");
	}
	
	public static function getCodeEvent($name) {
		if (array_key_exists($name, Evento::$events_categories)) {
			$keys = array_keys(Evento::$events_categories, $name);
			return Evento::$events_categories[$keys[0]]->code;
		}
		return -1;
	}
}