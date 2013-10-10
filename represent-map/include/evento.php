<?php

Class Evento {

	var $id;
	var $owner_name;
	var $owner_email;
	var $name;
	var $address;
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
		"ciclismo" => array("name" => "Ciclismo", 
							"code" => "0",
							"can_add_new" => true,
							"can_hide" => true),
		"running" => array("name" => "Running", 
							"code" => "1",
							"can_add_new" => true,
							"can_hide" => true),
		"escalada" => array("name" => "Escalada", 
							"code" => "2",
							"can_add_new" => true,
							"can_hide" => true),
		"deportes_de_invierno" => array("name" => "Deportes de invierno", 
										"code" => "3",
										"can_add_new" => true,
										"can_hide" => true),
		"senderismo" => array("name" => "Senderismo", 
								"code" => "4",
								"can_add_new" => true,
								"can_hide" => true),
		"piraguismo" => array("name" => "Piragüismo", 
								"code" => "5",
								"can_add_new" => true,
								"can_hide" => true),
		"triatlon" => array("name" => "Triatlón", 
							"code" => "6",
							"can_add_new" => true,
							"can_hide" => true),
		"deportes_nauticos" => array("name" => "Deportes náuticos", 
										"code" => "7",
										"can_add_new" => true,
										"can_hide" => true),
		"motociclismo" => array("name" => "Motociclismo", 
								"code" => "8",
								"can_add_new" => true,
								"can_hide" => true),
		"experiencia" => array("name" => "Experiencia", 
								"code" => "9",
								"can_add_new" => false,
								"can_hide" => false)
	);
	// Events subcategories
	static $events_subcategories = array(
	    "ciclismo"              => array(	"mtb_btt"                         	=> "MTB/BTT",
					                        "cicloturismo"                     	=> "Cicloturismo",
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
		"experiencia" 			=> array(	"experiencias" 						=> "Experiencias")
	);

	function Evento($nowner_name, $nowner_email, $nname, $ndescription, $nurl,$naddress,$nlat,$nlng,$ncategory, $nsubcategory,$ndate){
		$this->owner_name = $nowner_name;
		$this->owner_email = $nowner_email;
		$this->name = $nname;
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

	public static function getEventsApproved($wpdb, $page = null, $items_per_page = null){
		$query = "SELECT *
				FROM wp_evento
				where approved='1'";
		if ($page != null) {
			$query .= " LIMIT " . $page . ", " . $items_per_page;
		}
		return $wpdb->get_results($query);
	}
	public static function getEventsRejected($wpdb, $page = null, $items_per_page = null){
		$query = "SELECT *
				FROM wp_evento
				where approved='0'";
		if ($page != null) {
			$query .= " LIMIT " . $page . ", " . $items_per_page;
		}
		return $wpdb->get_results($query);
	}
	public static function getEventsPending($wpdb, $page = null, $items_per_page = null){
		$query = "SELECT *
				FROM wp_evento
				where approved IS null";
		if ($page != null) {
			$query .= " LIMIT " . $page . ", " . $items_per_page;
		}
		return $wpdb->get_results($query);
	}
	public static function getEventsSortByName($wpdb, $page = null, $items_per_page = null){
		$query = "SELECT *
				FROM wp_evento
				ORDER BY name";
		if ($page != null) {
			$query .= " LIMIT " . $page . ", " . $items_per_page;
		}
		return $wpdb->get_results($query);
	}
	public static function getEventsByName($wpdb, $search, $page = null, $items_per_page = null){
		$query = "SELECT *
				FROM wp_evento
				WHERE name LIKE '%$search%' ORDER BY name";
		if ($page != null) {
			$query .= " LIMIT " . $page . ", " . $items_per_page;
		}
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
}