<?php

Class Evento {
	const IMAGES_URL = "uploads/images/";
	const IMAGES_PATH = "/var/www/sportyguest/mapa/represent-map/represent-map/uploads/images/";
	var $id;
	var $owner_name;
	var $owner_email;
	var $name;
	var $address;
	var $image_url;
	var $price;
	var $description;
	var $url;
	var $lat;
	var $lng;
	var $category;
	var $subcategory;
	var $date_creacion;
	var $date;
	var $approved;
	// Events categories
	static $events_categories = array(
		"ciclismo" => array("name" => array("es_ES" => "Ciclismo", "en" => "Cycling"), 
							"code" => "0",
							"can_add_new" => true,
							"can_hide" => true),
		"running" => array("name" => array("es_ES" => "Running", "en" => "Running"), 
							"code" => "1",
							"can_add_new" => true,
							"can_hide" => true),
		"escalada" => array("name" => array("es_ES" => "Escalada", "en" => "Climbing"), 
							"code" => "2",
							"can_add_new" => true,
							"can_hide" => true),
		"deportes_de_invierno" => array("name" => array("es_ES" => "Deportes de invierno", "en" => "Winter Sports"), 
										"code" => "3",
										"can_add_new" => true,
										"can_hide" => true),
		"senderismo" => array("name" => array("es_ES" => "Senderismo", "en" => "Hiking"), 
								"code" => "4",
								"can_add_new" => true,
								"can_hide" => true),
		"piraguismo" => array("name" => array("es_ES" => "Piragüismo", "en" => "Canoeing"), 
								"code" => "5",
								"can_add_new" => true,
								"can_hide" => true),
		"triatlon" => array("name" => array("es_ES" => "Triatlón", "en" => "Triathlon"), 
							"code" => "6",
							"can_add_new" => true,
							"can_hide" => true),
		"deportes_nauticos" => array("name" => array("es_ES" => "Deportes náuticos", "en" => "Water Sports"), 
										"code" => "7",
										"can_add_new" => true,
										"can_hide" => true),
		"motociclismo" => array("name" => array("es_ES" => "Motociclismo", "en" => "Motorcycling"), 
								"code" => "8",
								"can_add_new" => true,
								"can_hide" => true),
		"experiencia" => array("name" => array("es_ES" => "Experiencia Sportyguest", "en" => "Sportyguest experience"), 
								"code" => "9",
								"can_add_new" => false,
								"can_hide" => true)
	);
	// Events subcategories
	static $events_subcategories = array(
	    "ciclismo"              => array(	"mtb_btt"                         	=> array("es_ES" => "MTB/BTT", "en" => "MTB/BTT"),
					                        "cicloturismo"                     	=> array("es_ES" => "Cicloturismo", "en" => "Cycling"),
					                        "trial"                            	=> array("es_ES" => "Trial", "en" => "Trial"),
					                        "bmx"                              	=> array("es_ES" => "BMX", "en" => "BMX"),
					                        "carretera"                        	=> array("es_ES" => "Carretera", "en" => "Road"),
					                        "otros"                            	=> array("es_ES" => "Otros", "en" => "Others")),
	    "running" 				=> array(	"carreras_populares"               	=> array("es_ES" => "Carreras populares", "en" => "Popular races"),
					                        "trail"                          	=> array("es_ES" => "Trail", "en" => "Trail"),
					                        "maraton"                			=> array("es_ES" => "Maratón", "en" => "Marathon"),
					                        "medio_maraton"          			=> array("es_ES" => "Medio maratón", "en" => "Half Marathon"),
					                        "canicross"                       	=> array("es_ES" => "Canicross", "en" => "Cani cross"),
					                        "otros"                        		=> array("es_ES" => "Otros", "en" => "Others")),
	    "escalada" 				=> array(	"escalada_en_roca"                  => array("es_ES" => "Escalada en roca", "en" => "Rock climbing"),
					                        "grandes_paredes"                   => array("es_ES" => "Grandes paredes", "en" => "Big Walls"),
					                        "boulder"                           => array("es_ES" => "Boulder", "en" => "Boulder")),
	    "piraguismo" 			=> array(	"kayak"                           	=> array("es_ES" => "Kayak", "en" => "Kayak"),
				                            "kayak_polo"                   		=> array("es_ES" => "Kayak Polo", "en" => "Polo Kayaking"),
				                            "descensos"                     	=> array("es_ES" => "Descensos", "en" => "Descent"),
				                            "otros"                         	=> array("es_ES" => "Otros", "en" => "Others")),
	    "motociclismo" 			=> array(	"grandes_premios"                   => array("es_ES" => "Grandes premios", "en" => "Grand Prix"),
				                            "motocross"                         => array("es_ES" => "Motocross", "en" => "Motocross"),
				                            "enduro"                            => array("es_ES" => "Enduro", "en" => "Enduro"),
				                            "trial"                             => array("es_ES" => "Trial", "en" => "Trial"),
				                            "freestyle"                         => array("es_ES" => "Freestyle", "en" => "Freestyle"),
				                            "otros"                             => array("es_ES" => "Otros", "en" => "Others")),
	    "deportes_de_invierno" 	=> array(	"esqui_de_fondo"                    => array("es_ES" => "Esquí de fondo", "en" => "Cross-country skiing"),
		                                    "raquetas_de_nieve"                 => array("es_ES" => "Raquetas de nieve", "en" => "Snowshoe"),
		                                    "esqui_extremo"                     => array("es_ES" => "Esquí extremo", "en" => "Extreme skiing"),
		                                    "snowboard"                         => array("es_ES" => "Snowboard", "en" => "Snowboard"),
		                                    "freeride"							=> array("es_ES" => "Freeride", "en" => "Freeride"),
		                                    "freestyle"							=> array("es_ES" => "Freestyle", "en" => "Freestyle")),
	    "triatlon" 				=> array(	"triatlon"                          => array("es_ES" => "Triatlón", "en" => "Triathlon"),
					                        "duatlon"                           => array("es_ES" => "Duatlón", "en" => "Duathlon"),
					                        "acuatlon"                          => array("es_ES" => "Acuatlón", "en" => "Aquathlon")),
		"senderismo" 			=> array(	"senderismo" 						=> array("es_ES" => "Senderismo", "en" => "Hiking")),
	    "deportes_nauticos"		=> array(	"vela"                              => array("es_ES" => "Vela", "en" => "Sailing"),
		                                    "windsurf"                          => array("es_ES" => "Windsurf", "en" => "Windsurf"),
		                                    "kitesurf"                          => array("es_ES" => "Kitesurf", "en" => "Kitesurf"),
		                                    "surf"                              => array("es_ES" => "Surf", "en" => "Surf"),
		                                    "otros"                             => array("es_ES"=> "Otros", "en" => "Others")),
		"experiencia" 			=> array(	"experiencias" 						=> array("es_ES" => "Experiencias", "en" => "Experiences"))
	);

	function Evento($nowner_name, $nowner_email, $nname, $nimage_url, $nprice, $ndescription, $nurl,$naddress,$nlat,$nlng,$ncategory, $nsubcategory,$ndate){
		$this->owner_name = $nowner_name;
		$this->owner_email = $nowner_email;
		$this->name = $nname;
		$this->image_url = $nimage_url;
		$this->price = $nprice;
		$this->description = $ndescription;
		$this->url = $nurl;
		$this->address = $naddress;
		$this->lat = $nlat;
		$this->lng = $nlng;
		$this->category = $ncategory;	
		$this->subcategory = $nsubcategory;	
		$this->date = $ndate;
	}

	function saveDB($wpdb) {
		$date_aux = new DateTime($this->date);
		$date_aux = $date_aux->format('Y-m-d H:i:s');
		return $wpdb->insert( 
			'wp_evento', 
			array( 
				'owner_name'	=> $this->owner_name,
				'owner_email'	=> $this->owner_email,
                'name'          => $this->name,
                'image_url'		=> $this->image_url,
                'price'			=> $this->price,
                'description'   => $this->description,
                'url'           => $this->url,
                'address'       => $this->address,
                'lat'           => $this->lat,
                'lng'           => $this->lng,
                'category'      => $this->category,
                'subcategory'   => $this->subcategory,
                'date'          => $date_aux
			)
		);
	}
	public function updateDB($wpdb) {
		$date_aux = new DateTime($this->date);
		$date_aux = $date_aux->format('Y-m-d H:i:s');
		return $wpdb->update( 
			'wp_evento', 
			array( 
				'owner_name'	=> $this->owner_name,
				'owner_email'	=> $this->owner_email,
                'name'          => $this->name,
                'image_url'		=> $this->image_url,
                'price'			=> $this->price,
                'description'   => $this->description,
                'url'           => $this->url,
                'address'       => $this->address,
                'lat'           => $this->lat,
                'lng'           => $this->lng,
                'category'      => $this->category,
                'subcategory'   => $this->subcategory,
                'date'          => $date_aux
			),
			array(
				'id'			=> $this->id
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%f',
				'%f',
				'%s',
				'%s',
				'%s'
			),
			array(
				'%d'
			)
		);
	}

	public static function hide($wpdb, $id) {
		return $wpdb->update( 
				'wp_evento', 
				array( 
					'approved' => '0'
				), 
				array( 'id' => $id ), 
				array( 
					'%s'
				), 
				array( '%d' ) 
			);
	}
	public static function approve($wpdb, $id) {
		return $wpdb->update( 
				'wp_evento', 
				array( 
					'approved' => '1'
				), 
				array( 'id' => $id ), 
				array( 
					'%s'
				), 
				array( '%d' ) 
			);
	}
	public static function delete($wpdb, $id) {
		return $wpdb->delete( 
				'wp_evento',
				array( 'id' => $id )
			);
	}

	function getEventos($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_evento	
			");
	}

	public static function getEvent($wpdb, $id) {
		return $wpdb->get_row(
					$wpdb->prepare("
						SELECT *
						FROM wp_evento
						WHERE id = %d
						",
						$id)
				);
	}


	public static function getAllEventsApproved($wpdb){
		$query = "SELECT *
				FROM wp_evento
				where approved='1'";
		return $wpdb->get_results($query);
	}

	public static function getEventsApproved($wpdb, $start = 0, $items_per_page = 15){
		$query = "SELECT *
				FROM wp_evento
				where approved='1'
				LIMIT " . $start . ", " . $items_per_page;
		return $wpdb->get_results($query);
	}
	public static function getEventsRejected($wpdb, $start = 0, $items_per_page = 15){
		$query = "SELECT *
				FROM wp_evento
				where approved='0'
				LIMIT " . $start . ", " . $items_per_page;
		return $wpdb->get_results($query);
	}
	public static function getEventsPending($wpdb, $start = 0, $items_per_page = 15){
		$query = "SELECT *
				FROM wp_evento
				where approved IS null
				LIMIT " . $start . ", " . $items_per_page;
		return $wpdb->get_results($query);
	}
	public static function getEventsSortByName($wpdb, $start = 0, $items_per_page = 15){
		$query = "SELECT *
				FROM wp_evento
				ORDER BY name
				LIMIT " . $start . ", " . $items_per_page;
		return $wpdb->get_results($query);
	}
	public static function getEventsByName($wpdb, $search, $start = 0, $items_per_page = 15){
		$query = "SELECT *
				FROM wp_evento
				WHERE name LIKE '%$search%' ORDER BY name
				 LIMIT " . $start . ", " . $items_per_page;
		return $wpdb->get_results($query);
	}
	public static function getCountByName($wpdb, $search) {
		return $wpdb->get_var("SELECT COUNT(*) FROM wp_evento WHERE name LIKE '%$search%'");
	}
	public static function getApprovedCount($wpdb) {
		return $wpdb->get_var("SELECT COUNT(*) FROM wp_evento WHERE approved='1'");
	}
	public static function getRejectedCount($wpdb) {
		return $wpdb->get_var("SELECT COUNT(*) FROM wp_evento WHERE approved='0'");
	}
	public static function getPendingCount($wpdb) {
		return $wpdb->get_var("SELECT COUNT(*) FROM wp_evento WHERE approved IS null");
	}
	public static function getTotalCount($wpdb) {
		return $wpdb->get_var("SELECT COUNT(*) FROM wp_evento");
	}
	public static function getEventsNamesSortyByID($wpdb) {
		return $wpdb->get_col("SELECT name, id FROM wp_evento ORDER BY id");
	}
	public static function getEventsIdsSortByID($wpdb) {
		return $wpdb->get_col("SELECT id FROM wp_evento ORDER BY id");
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

	public static function createImageURL($site_url, $image_name) {
		return $site_url . Evento::IMAGES_URL . $image_name;
	}

	public static function createImageName($image_name) {
		$end = end(explode(".", $image_name));
		return time() . "_" . rand(1000,1000000) . "." . $end;
	}
}