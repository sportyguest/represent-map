<?php
class Rating {

	var $id;
	var $event_id;
	var $rate;
	var $ip;

	public function Rating($nevent_id, $nrate, $nip) {
		$this->event_id = $nevent_id;
		$this->rate = $nrate;
		$this->ip = $nip;
	}

	public function saveDB($wpdb) {
		return $wpdb->insert( 
			'wp_evento_valoracion', 
			array( 
				'event_id' => $this->event_id,
				'rate'	=> $this->rate,
				'ip'	=> $this->ip
			)
		);
	}

	public static function getRating($wpdb, $event_id) {
		return $wpdb->get_var(
						$wpdb->prepare("
							SELECT AVG(rate)
							FROM wp_evento_valoracion
							WHERE event_id = %d",
						$event_id));
	}

	public static function isIP($wpdb, $event_id, $ip) {
		return $wpdb->get_var(
						$wpdb->prepare("
							SELECT ip
							FROM wp_evento_valoracion
							WHERE event_id = %d AND ip = %s",
							$event_id,
							$ip));
	}
}
?>