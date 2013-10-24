<?php

class Email {
	const ADMIN_MAIL = "info.sportyguest@gmail.com";
	const OFFICIAL_MAIL = "info@sportyguest.es";
	const MAP_URL = "http://eventosdeportivos.sportyguest.es";
	const EMAIL_APPROVED = "/var/www/sportyguest/mapa/represent-map/represent-map/email/email-approved-event.html";
	const EMAIL_CREATED = "/var/www/sportyguest/mapa/represent-map/represent-map/email/email-created-event.html";

	public static function sendEmail($from, $to, $subject, $message) {
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= ('From: ' . $from . "\r\n". 'Content-type: text/html;  charset=UTF-8' . "\r\n");
		mail($to, $subject, $message, $header);
	}

	public static function notifyEventApproved($evento) {
        $nombres_variables = array( "EVENT_URL"       	=> Email::MAP_URL,
                                    "EVENT_NAME"      	=> $evento->name,
                                    "FB_EVENT_URL"    	=> urlencode(Email::MAP_URL),
                                    "FB_EVENT_NAME"   	=> urlencode($evento->name),
                                    "FB_EVENT_SUMMARY"	=> urlencode($evento->description),
                                    "FB_IMAGE_URL"    	=> urlencode("http://eventosdeportivos.sportyguest.es/images/badges/badge2.png"),
                                    "TWEET_TEXT"      	=> urlencode("Échale un vistazo a " . $evento->name),
                                    "TWEET_URL"       	=> urlencode(Email::MAP_URL));
		$html = file_get_contents(Email::EMAIL_APPROVED);
		foreach ($nombres_variables as $key => $value) {
			$html = str_replace("%" . $key . "%", $value, $html);
		}
		$subject = "Se ha aprobado su evento";
		Email::sendEmail(Email::OFFICIAL_MAIL, $evento->owner_email, $subject, $html);
	}

	public static function notifyEventCreated($evento) {
		$html = file_get_contents(Email::EMAIL_CREATED);
		$subject = "Se ha creado un nuevo evento";
		Email::sendEmail(Email::OFFICIAL_MAIL, Email::ADMIN_MAIL, $subject, $html);
	}
}
?>