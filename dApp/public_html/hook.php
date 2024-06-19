<?php
/**
* Git hook file. Git should trigger it after push
* secret_key should be the same as $_SERVER["DOCUMENT_ROOT"]
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

// check for POST request
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    error_log('FAILED - not POST - '. $_SERVER['REQUEST_METHOD']);
    exit();
}

// get content type
$content_type = isset($_SERVER['CONTENT_TYPE']) ? strtolower(trim($_SERVER['CONTENT_TYPE'])) : '';

if ($content_type != 'application/json') {
    error_log('FAILED - not application/json - '. $content_type);
    exit();
}

// get payload
$payload = trim(file_get_contents("php://input"));

if (empty($payload)) {
    error_log('FAILED - no payload');
    exit();
}

// get header signature
$header_signature = isset($_SERVER['HTTP_X_GITEA_SIGNATURE']) ? $_SERVER['HTTP_X_GITEA_SIGNATURE'] : '';

if (empty($header_signature)) {
    error_log('FAILED - header signature missing');
    exit();
}

// calculate payload signature
$payload_signature = hash_hmac('sha256', $payload, $_SERVER["DOCUMENT_ROOT"], false);

// check payload signature against header signature
if ($header_signature !== $payload_signature) {
    error_log('FAILED - payload signature');
    exit();
}

// convert json to array
$decoded = json_decode($payload, true);

// check for json decode errors
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('FAILED - json decode - '. json_last_error());
    exit();
}

system("cd ../../ && git reset --hard origin/master && git pull 1> git.log 2> git.error & && chmod 705 cron.php &");
