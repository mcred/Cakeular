# Cakeular CakePHP Plugin

Cakeular is a Angular.js Plugin for CakePHP. It creates a RESTful JSON API service from your models and Angular.js views. 

## Requirements

The master branch has the following requirements:

* CakePHP 2.2.0 or greater.
* PHP 5.3.0 or greater.

## Installation

1. Clone/Copy the files in this directory into `app/Plugin/Cakeular`.
2. Ensure the plugin is loaded in `app/Config/bootstrap.php` by calling `CakePlugin::load('Cakeular');`.
3. Modify `app/Config/routes.php` to include the following code before CakePlugin::routes(); is called.

```
/**
 * ... connect Cakeular RESTful URLs to JSON API.
 */
	Router::connect('/:controller/*', array('action' => 'index'));
```

### Install as Git submodule

You can replace Step 1 above with the following to add Cakeular to your CakePHP project as a submodule:

```
$ cd /path/to/CakePHP/project/
$ git submodule add https://github.com/mcred/Cakeular.git app/Plugin/Cakeular
```

# Documentation

## Cakeular Console Templates

We have included Console Templates to allow you to easily bake a project and gain Angular functionality throughout.

To utilize the Console Templates simply bake your project like usual but select `Cakeular` when it asks you which template you would like to use.

##API Routes

The standard Cake controller methods are replaced by a RESTful JSON API. So instead of viewing an individual record for your model by going to `/model/view/:id`, JSON data for this record can be seen by a GET request to `/model/:id`. The replacement for Cake methods are as follows:

`/model/index/` becomes a GET request to `/model/`
`/model/view/:id` becomes a GET request to `/model/:id`
`/model/add` becomes a POST request to `/model/`, send the model as the 'body' of a POST as a JSON string.
`/model/edit/:id` becomes a POST request to `/model/`, send the model as the 'body' of a POST as a JSON string.
`/model/delete:id` becomes a DELETE request to `/model/`


# TODO

* Add Angular.js templates to replace the standard cake view templates
