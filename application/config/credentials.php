<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Google Cloud Platform credentials 
$config['gc_credentials'] = array(

    'auth' => array(
        'type' => getenv('GOOGLE_CLOUD_ACCOUNT_TYPE'),
        'project_id' => getenv('GOOGLE_CLOUD_PROJECT_ID'),
        'private_key_id' => getenv('GOOGLE_CLOUD_PRIVATE_KEY_ID'),
        'private_key' => getenv('GOOGLE_CLOUD_PRIVATE_KEY'),
        'client_email' => getenv('GOOGLE_CLOUD_CLIENT_EMAIL'),
        'client_id' => getenv('GOOGLE_CLOUD_CLIENT_ID'),
        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri' => 'https://oauth2.googleapis.com/token',
        'auth_provider_x509_cert_url' => "https://www.googleapis.com/oauth2/v1/certs",
        'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/gcp-storage-upload%40' . getenv('GOOGLE_CLOUD_PROJECT_ID') . '.iam.gserviceaccount.com',
    ),

    'storage' => array(
        'bucket' => getenv('GOOGLE_CLOUD_STORAGE_BUCKET'),
        'cloud_path' => '' //optional
    )
);