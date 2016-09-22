<?php
	class Contact{
		public static $types = array(
				1=>'Product enquiry',
				2=>'Billing enquiry',
				3=>'Support enquiry'
			);

		private static $_receiver = array(
			'email' => 'example@example.com',
			'name' => 'Sombebody Somebodyan'
		);

		const CONTACT_SUBJECT = 'Enquire from... ';

		private static function _formatMessage($array=null){
			$items = array();
			$items[] = '<strong>First Name:</strong> ' .$array['first_name'];
			$items[] = '<strong>Last Name:</strong> ' .$array['last_name'];
			$items[] = '<strong>Email Address:</strong> <a href="mailto:' .$array['email'].'">'.$array['email'].'</a>';
			$items[] = '<strong>Enquiry Type:</strong> ' .self::$types[$array['last_name']];
			$items[] = nl2br($array['enquiry']);
			$out = '<div style="font-size:14px; font-family:Arial, sans-serif; color:#333">';
			$out .= '<p>';
			$out .= implode('<br/>', $items);
			$out .= '</p>';
			$out .= '</div>';
			return $out;
		}

		private static function _formatFrom($array=null){
			return $array['first_name'] . ' ' . $array['last_name'] . ' <' . $array['email'] .'>' ;
		}

		private static function _formatTo(){
			return self::$_receiver['name'] . ' ' . ' <' . self::$_receiver['email'] .'>' ;
		}

		public static function send($array=null){
			$message = self::_formatMessage($array);
			$from = self::_formatFrom($array);
			$to = self::_formatTo();
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8\r\n";
			$headers .= "From: ";
			$headers .= $from;
			$headers .= "\r\n";
			$headers .= "Reply to: ";
			$headers .= $from;

			return mail($to, self::CONTACT_SUBJECT, $message, $headers);

		}
	}
?>