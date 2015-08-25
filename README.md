# Cakeular CakePHP Plugin

Cakeular is a Angular.js Plugin for CakePHP. It creates a RESTful JSON API service from your models and Angular.js views. 

## Requirements

The master branch has the following requirements:

* CakePHP 2.2.0 or greater.
* PHP 5.3.0 or greater.

## Installation

1. Clone/Copy the files in this directory into `app/Plugin/Cakeular`.
2. Ensure the plugin is loaded in `app/Config/bootstrap.php` by calling `CakePlugin::loadAll(array('Cakeular' => array('routes' => true)));`.
3. Copy Console/Command/CakeularShell.php to /app/Console/Command/
4. Copy Console/Command/Task/CakeularTask.php to /app/Console/Command/Task/
5. Copy /app/Plugin/Cakeular/Config/cakeular.php to /app/Config/cakeular.php
6. Put the URL where your API will be hosted. The default routing expects this to be //api.yourhost

### Install as Git submodule

You can replace Step 1 above with the following to add Cakeular to your CakePHP project as a submodule:

```
$ cd /path/to/CakePHP/project/
$ git submodule add https://github.com/mcred/Cakeular.git app/Plugin/Cakeular
```

### Cross-origin resource sharing (CORS) 

Your server must allow CORS from the requesting application. This can be enabled a few ways. The easiest I have found is to allow the host for my application to the .htaccess file in the /app folder. Add the following lines: 
```
Header set Access-Control-Allow-Origin "localhost or yourserver"
Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
```

# Usage

1. Create your Database Schema following Cake Convention.
2. `./cake bake all` for your Models. 
3. Select Cakeular as your Template. 
4. `./cake cakular` for your Models. 
5. Do not select to Interactively Bake and select Cakeular as the Template. 

# Options
In the Config/cakeular.php file, there is an option to turn on Authentication for the API. If the "authorize" option is set to true, please also set your salt for the authentication. All requests must contain an Authorization Signature and Date header. The Signature is a BASE64 encoded hash made of the Requested model and the GMdate, using the salt you set up in your config file. A CakePHP HttpSocket request would look like this:
```
App::uses('HttpSocket', 'Network/Http');
$HttpSocket = new HttpSocket();

//build signature
$date = date(gmdate("Ymd H:i", time()));
$sig = base64_encode(hash_hmac('sha256', REQUESTED_MODEL . $date, CONFIGURE.SALT, true));

$options = array(
    'header' => array(
        'Authorization' => $sig,
        'Date' => $date,
    ),
);

$verify = $HttpSocket->get('http://api.localhost/REQUESTED_MODEL/', null, $options);
debug(json_decode($verify->body, true));
```

# Documentation

## Cakeular Console Templates

We have included Console Templates to allow you to easily bake a project and gain Angular functionality throughout.

To utilize the Console Templates simply bake your project like usual but select `Cakeular` when it asks you which template you would like to use.

##API Routes

The standard Cake controller methods are replaced by a RESTful JSON API. So instead of viewing an individual record for your model by going to `/model/view/:id`, JSON data for this record can be seen by a GET request to `/model/:id`. The replacement for Cake methods are as follows:

`/model/index/` becomes a GET request to `/model/`<br />
`/model/view/:id` becomes a GET request to `/model/:id`<br />
`/model/add` becomes a POST request to `/model/`, send the model as the 'body' of a POST as a JSON string.<br />
`/model/edit/:id` becomes a POST request to `/model/`, send the model as the 'body' of a POST as a JSON string.<br />
`/model/delete:id` becomes a DELETE request to `/model/`<br />

##Angular Views

The standard Cake views are replaced by a single index.ctp file that runs an Angular App. Each model has an Angular controller file created in /app/webroot/js. HTML templates are created for each view in /app/webroot/view/model/. 

# TODO

* Clean up and make some functions global
