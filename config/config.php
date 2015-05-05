<?php

/**
 * Bono App Configuration
 *
 * @category  PHP_Framework
 * @package   Bono
 * @author    Ganesha <reekoheek@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @version   0.10.0
 * @link      http://xinix.co.id/products/bono
 */

use Norm\Schema\String;
use Norm\Schema\Password;
use Norm\Schema\Reference;
use Norm\Schema\Date;
use Norm\Schema\Text;
use App\Schema\SysParamReference;

return array(
    'application' => array(
        'title' => 'Bono Application',
        'subtitle' => 'One great application'
    ),
    'bono.salt' => 'please change this',
    'bono.debug' => false,
    'bono.providers' => array(
        'Norm\\Provider\\NormProvider' => array(
            'datasources' => array(
                // 'filedb' => array(
                //     'driver' => 'ROH\\FDB\\Connection',
                //     'dataDir' => '../data',
                // ),
                // to use mongo
                'mongo' => array(
                    'driver' => 'Norm\\Connection\\MongoConnection',
                    'database' => 'man-power',
                ),
            ),
            'collections' => array(
                'default' => array(
                    'observers' => array(
                        'Norm\\Observer\\Ownership' => null,
                        'Norm\\Observer\\Timestampable' => null
                    ),
                    'limit' => 25,
                ),
                'resolvers' => array(
                    'Norm\\Resolver\\CollectionResolver' => null,
                ),
                'mapping' => array(
                    'User' => array(
                        'schema' => array(
                            'username' => String::create('username')->filter('trim|required|unique:User,username'),
                            'password' => Password::create('password')->filter('trim|confirmed|salt'),
                            'email' => String::create('email')->filter('trim|required|unique:User,email'),
                            'first_name' => String::create('first_name')->filter('trim|required'),
                            'last_name' => String::create('last_name')->filter('trim|required'),
                            'handphone' => String::create('handphone'),
                        ),
                    ),
                    'Project' => array(
                        'schema' => array(
                            'name' => String::create('name')->set('list-column', true),
                            'client_id' => Reference::create('client_id')->to('Client')->set('list-column', true),
                            'starttime' => Date::create('starttime')->set('list-column', true),
                            'endtime' => Date::create('endtime')->set('list-column', true),
                            'value' => String::create('value'),
                            'url_demo' => String::create('url_demo')->set('list-column', true),
                            'project_flag' => SysParamReference::create('project_flag')->by('project_flag')->set('list-column', true),
                        ),
                    ),
                    'Participant' => array(
                        'schema' => array(
                            'project_id' => Reference::create('project_id')->to('Project')->set('list-column', true),
                            'user_id' => Reference::create('user_id')->to('User', 'username')->set('list-column', true),
                            'project_title' => SysParamReference::create('project_title')->by('project_title')->set('list-column', true),
                        ),
                    ),
                    'Client' => array(
                        'schema' => array(
                            'name' => String::create('name'),
                            'address' => Text::create('address'),
                            'email' => String::create('email'),
                            'telephone' => String::create('telephone'),
                            'contact_person' => String::create('contact_person'),
                        ),
                    ),
                    'Sysparam' => array(
                        'schema' => array(
                            'groups' => String::create('groups')->filter('trim|required'),
                            'key' => String::create('key')->filter('trim|required'),
                            'value' => String::create('value')->filter('trim|required')
                        ),
                    ),
                ),
            ),
        ),
        'Xinix\\Migrate\\Provider\\MigrateProvider' => array(
            // 'token' => 'changetokenherebeforeenable',
        ),
        'App\\Provider\\AppProvider',
    ),
    'bono.middlewares' => array(
        'Bono\\Middleware\\StaticPageMiddleware' => null,
        'Bono\\Middleware\\ControllerMiddleware' => array(
            'default' => 'Norm\\Controller\\NormController',
            'mapping' => array(
                '/sysparam' => null,
                '/user' => null,
                '/project' => '\\App\\Controller\\ProjectController',
                '/project/:id/participant' => null,
                '/client' => null,
                '/participant' => null,
            ),
        ),
        // uncomment below to enable auth
        'ROH\\BonoAuth\\Middleware\\AuthMiddleware' => array(
            'driver' => 'ROH\\BonoAuth\\Driver\\NormAuth',
        ),
        'Bono\\Middleware\\NotificationMiddleware' => null,
        'Bono\\Middleware\\SessionMiddleware' => null,
        'Bono\\Middleware\\ContentNegotiatorMiddleware' => array(
            'extensions' => array(
                'json' => 'application/json',
            ),
            'views' => array(
                'application/json' => 'Bono\\View\\JsonView',
            ),
        ),
    ),
    'bono.theme' => array(
        'class' => 'Xinix\\Theme\\Naked2Theme',
        'overwrite' => true,
    ),
);
