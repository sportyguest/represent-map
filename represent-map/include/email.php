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
		$url = Email::MAP_URL . "/#" . $evento->id;
        $nombres_variables = array( "EVENT_URL"       	=> $url,
                                    "EVENT_NAME"      	=> $evento->name,
                                    "FB_EVENT_URL"    	=> urlencode($url),
                                    "FB_EVENT_NAME"   	=> urlencode($evento->name),
                                    "FB_EVENT_SUMMARY"	=> urlencode($evento->description),
                                    "FB_IMAGE_URL"    	=> urlencode("http://eventosdeportivos.sportyguest.es/images/badges/badge2.png"),
                                    "TWEET_TEXT"      	=> urlencode("Échale un vistazo a " . $evento->name),
                                    "TWEET_URL"       	=> urlencode($url),
                                    "LINKEDIN_EVENT_URL"=> $url,
                                    "GOOGLE_EVENT_URL"	=> $url);
		$html = file_get_contents(Email::EMAIL_APPROVED);
		$html = Email::replaceVariables($html, $nombres_variables);
		$subject = "Se ha aprobado su evento";
		Email::sendEmail(Email::OFFICIAL_MAIL, $evento->owner_email, $subject, $html);
		Email::sendEmail(Email::OFFICIAL_MAIL, Email::ADMIN_MAIL, $subject, $html);
	}

	public static function notifyEventCreated($evento) {
		$nombres_variables = array( "EVENT_NAME" => $evento->name);
		$html = file_get_contents(Email::EMAIL_CREATED);
		$html = Email::replaceVariables($html, $nombres_variables);
		$subject = "Se ha creado un nuevo evento";
		Email::sendEmail(Email::OFFICIAL_MAIL, Email::ADMIN_MAIL, $subject, $html);
	}

	private static function replaceVariables($msg, $variables) {
		foreach ($variables as $key => $value) {
			$msg = str_replace("%" . $key . "%", $value, $msg);
		}
		return $msg;
	}
}
?>