<?php

class Experiencia {
	var $experiencia_id;
	var $user_id;
	var $titulo;
	var $descripcion;
	var $precio_persona_dia;
	var $incluye_material;
	var $duracion;
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
	
	function Experiencia($datos) {
		$this->user_id = $datos["user_id"];
		$this->titulo = $datos["titulo"];
		$this->descripcion = $datos["descripcion"];
		$this->precio_persona_dia = $datos["precio_persona_dia"];
		$this->incluye_material = $datos["incluye_material"];
		$this->duracion = $datos["duracion"];
		$this->provincia = $datos["provincia"];
		$this->localidad = $datos["localidad"];
		$this->direccion = $datos["direccion"];
		$this->siempre = $datos["siempre"];
		$this->fin_de_semana = $datos["fin_de_semana"];
		$this->dificultad = $datos["dificultad"];
		$this->otros = $datos["otros"];
		$this->acepta_politica = $datos["acepta_politica"];
		$this->acepta_cookies = $datos["acepta_cookies"];
		$this->lat = $datos["lat"];
		$this->lng = $datos["lng"];
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

	public static function getTodasExperiencias($wpdb) {
		return $wpdb->get_results(
				"SELECT *
				FROM wp_experiencias"
			);
	}

	/**
	 * Devuelve la cantidad de experiencias que hay en la base de datos.
	 * @param  [type] $wpdb Objeto de la base de datos.
	 * @return [type]       Cantidad de experiencias que hay en la base de datos.
	 */
	public static function getCantidad($wpdb) {
		return $wpdb->get_var("
			SELECT COUNT(*)
			FROM wp_experiencias
			WHERE aprobada = 1
			AND eliminada = 0
			");
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
		return "experiencia/" . Experiencia::codificarTitulo($experiencia_titulo);
	}

	private static function codificarTitulo($experiencia_titulo) {
		return urlencode(str_replace(" ", "-", $experiencia_titulo));
	}
}
?>