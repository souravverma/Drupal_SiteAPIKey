<?php
/**
 * @file
 * Contains \Drupal\mymodule\Controller\MyModuleController.
 */
namespace Drupal\mymodule\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class MyModuleController{
    /**
     * @param $siteapikey - the API key parameter
     * @param NodeInterface $node - the node built from the node id parameter
     * @return JsonResponse
     */
    public function content($siteapikey, NodeInterface $node){
		
        // Site API Key configuration value
        $site_api_key_saved = \Drupal::config('mymodule.configuration')->get('siteapikey');

        if($node->getType() == 'page' && $site_api_key_saved != 'No API Key yet' && $site_api_key_saved == $site_api_key){

            // Respond with the json representation of the node
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        }

        // Respond with access denied
        return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
    }
}