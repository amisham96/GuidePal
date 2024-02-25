<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '990468118259-uklqtsiobjofsr7gj8mbsf8khvmt1uks.apps.googleusercontent.com';
$config['google']['client_secret']    = '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';
$config['google']['redirect_uri']     = base_url().'login/google_login';
$config['google']['application_name'] = 'guidepal';
$config['google']['api_key']          = 'AIzaSyDNcLWVtcAkU2jOUKVDMUSHs_Q5-2NEvyk';
$config['google']['scopes']           = array();


?>