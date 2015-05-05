<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;

class ProjectController extends NormController
{
    public function mapRoute()
    {
        parent::mapRoute();

    }

    public function read($id)
    {
    	$found = false;

        try {
            $this->data['entry'] = $entry = $this->collection->findOne($id);
        } catch (\Exception $e) {
        }

		/* Get data from table userRating by userId */
        $participantModel = Norm::factory('Participant');
        $dataParticipant = $participantModel->find(array('project_id'=>$id)) ?: array();
        /* Generate data participant into array */
        $participants = array();
        foreach ($dataParticipant as $key => $value) {
            $participants[] = $value->toArray();
        }

        /* If data from table crewEducation is available, send data to view crewEducation */
        $this->data['participants'] = $participants?:array();
        if (isset($entry)) {
            $found = true;
        }

        if (!$found) {
            return $this->app->notFound();
        }

    }
}