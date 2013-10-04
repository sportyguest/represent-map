<?php

class Experiencia {
	var $experiencia_id;
	var $user_id;
	var $titulo;
	var $provincia;
	var $localidad;
	var $direccion;
	var $siempre;
	var $fin_de_semana;
	var $dificultad;
	var $otros;
	var $acepta_politica;
	var $acepta_cookies;
	var $aprobada;
	var $fecha_creacion;
	var $fecha_modificacion;
	var $lat;
	var $lng;
	
	function Experiencia($nuser_id, $ntitulo, $nprovincia, $nlocalidad, $ndireccion, $nsiempre, $nfin_de_semana, $nacepta_politica, $nacepta_cookies) {
		$this->user_id = $nuser_id;
		$this->titulo = $ntitulo;
		$this->plazas = $nplazas;
		$this->provincia = $nprovincia;
		$this->localidad = $nlocalidad;
		$this->direccion = $ndireccion;
		$this->siempre = $nsiempre;
		$this->fin_de_semana = $nfin_de_semana;
		$this->acepta_politica = $nacepta_politica;
		$this->acepta_cookies = $nacepta_cookies;
	}
	
	/**
	 * Actualiza los datos de un experiencia, solamente los datos que se le pasen
	 * @param  [type] $wpdb [description]
	 * @param  [type] $map  [description]
	 * @return [type]       [description]
	 */
	public static function updateDBMap($wpdb, $map) {
		$experiencia_id = $map["experiencia_id"];
		unset($map["experiencia_id"]);
		$where = array(
				'experiencia_id' => $experiencia_id
			);
		$wpdb->update(
			'wp_experiencias',
			$map,
			$where
			);
	}

	function updateDB($wpdb) {
		$datos = array( 
                'user_id'               => $this->user_id,
                'titulo'                => $this->titulo,
                'provincia'             => $this->provincia,
                'localidad'             => $this->localidad,
                'direccion'             => $this->direccion,
                'siempre'               => $this->siempre,
                'fin_de_semana'         => $this->fin_de_semana,
                'dificultad'            => $this->dificultad,
                'otros'					=> $this->otros,
                'acepta_politica'       => $this->acepta_politica,
                'acepta_cookies'        => $this->acepta_cookies,
                'fecha_modificacion'    => date('Y-m-d H:i:s')
			);
		$where = array(
				'experiencia_id' => $this->experiencia_id
			);
		$wpdb->update(
			'wp_experiencias',
			$datos,
			$where,
			array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%d',
				'%d',
				'%s'
			),
			array(
				'%d'
			)
		);
	}
	
	// TODO: Escapear entrada del usuario
	function guardarDB($wpdb) {
		$datos = array( 
                'user_id'           => $this->user_id,
                'titulo'            => $this->titulo,
                'provincia'         => $this->provincia,
                'localidad'         => $this->localidad,
                'direccion'         => $this->direccion,
                'siempre'           => $this->siempre,
                'fin_de_semana'     => $this->fin_de_semana,
                'dificultad'        => $this->dificultad,
                'otros'				=> $this->otros,
                'acepta_politica'   => $this->acepta_politica,
                'acepta_cookies'    => $this->acepta_cookies,
                'fecha_creacion'    => date('Y-m-d H:i:s')
			);
		$wpdb->insert( 
			'wp_experiencias', 
			$datos,
			array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%d',
				'%d',
				'%s'
			)
		);
		return $wpdb->insert_id;
	}
	
	public static function getExperiencia($wpdb, $id) {
		return $wpdb->get_row("
			SELECT * 
			FROM wp_experiencias 
			WHERE experiencia_id = {$id}
			");
	}
	
	public static function getExperiencias($wpdb, $user_id = -1) {
		$query = "SELECT *
				FROM wp_experiencias
				WHERE aprobada = 1
				AND eliminada = 0";
		if ($user_id > 0) {
			$query .= " AND user_id = {$user_id}";
		}
		return $wpdb->get_results($query);
	}

	public static function getDescripcion($wpdb, $id) {
		return $wpdb->get_var(
				$wpdb->prepare("
					SELECT descripcion
					FROM wp_experiencias_servicios
					WHERE experiencia_id = %d AND principal = 1
					",
					$id)
			);
	}

	/**
	 * Devuelve la URL de la experiencia relativa a la experiencia. No incluye la url de la home (www.sportyguest.es)
	 * @param  [type] $wpdb               	Objeto de la base de datos.
	 * @param  int $experiencia_id     		ID de la experiencia.
	 * @param  string $experiencia_titulo 	Título de la experiencia. Si se proporciona se evita el acceso a la base de datos.
	 * @return string                     	URL de la experiencia.
	 */
	public static function getURL($wpdb, $experiencia_id, $experiencia_titulo = "") {
		if (empty($experiencia_titulo)) {
			$experiencia_titulo = $wpdb->get_var("
								SELECT titulo
								FROM wp_experiencias
								WHERE experiencia_id = {$experiencia_id}
							");
		}
		return "experiencia/?experiencia_titulo=" . Experiencia::codificarTitulo($experiencia_titulo);
	}

	private static function codificarTitulo($experiencia_titulo) {
		return urlencode(str_replace(" ", "-", $experiencia_titulo));
	}
}
?>