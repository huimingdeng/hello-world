<?php
require_once 'class.baseclient.php';
require_once 'class.contacts.php';

$HAPIKey = '4b1e31ab-181c-4f5d-9ba6-98e34ca7e880';
$emails=array("d.huang@beatson.gla.ac.uk","d.prati@ospedale.lecco.it","1275431510@qq.com");
$contact = new HubSpot_Contacts($HAPIKey);
foreach ($emails as $k => $v) {
	echo $contact -> get_contact_by_email($v)->vid ."\n";
}
