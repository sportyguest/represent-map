<?php


Class Evento {

	var $id;
	var $nombre;
	var $direccion;
	var $lat;
	var $lng;
	var $tipo;
	var $fecha_creacion;
	var $fecha;
	var $aprobada;





	function Evento($nnombre,$ndireccion,$nlat,$nlng,$ntipo,$nfecha){
		
		$this->nombre=$nnombre;
		$this->direccion=$ndireccion;
		$this->lat=$nlat;
		$this->lng=$nlng;
		$this->tipo=$ntipo;	
		$this->fecha=$nfecha;

	}
	

		function guardarDB($wpdb) {
		
		$f=$this->fecha;
		$fecha = new DateTime($f);
		$fecha= $fecha->format('Y-m-d H:i:s');
				return $wpdb->insert( 
			'wp_eventos', 
			array( 
				
				'nombre' => $this->nombre,
				'direccion' => $this->direccion,
				'lat' => $this->lat,
				'lng' => $this->lng,
				'tipo' => $this->tipo,
				'fecha'=> $fecha

			)
		);
		/*return $wpdb->get_var("
			SELECT
			MAX(id)
			FROM wp_eventos
			");
		*/
	}

	function getEventos($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_eventos		
			");
	}

		function getEventosAprobados($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_eventos
			where aprobada='1'
			");
	}

function getEventosTipo($wpdb, $tipo){
		return $wpdb->get_results("
			SELECT *
			FROM wp_eventos
			where tipo='$tipo'and aprobada='1' ");
	}
	function countTypes($wpdb){
		return $wpdb->get_results("
			SELECT *
			FROM wp_eventos
			where tipo='marathon' and aprobada='1'
			");

	}
	
}