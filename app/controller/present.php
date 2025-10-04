<?php

/*
    Asatru PHP - Present Controller
*/

/**
 * This class represents your controller
 */
class PresentController extends BaseController {
    /**
	 * Handles URL: /present/view/{id}
	 * 
	 * @param Asatru\Controller\ControllerArg $request
	 * @return Asatru\View\ViewHandler
	 */
    public function view_present($request)
    {
        $present_id = $request->arg('id');

        $present = Present::getById($present_id);
        $person = Person::getPersonInfo($present->get('person'));

        return parent::view(['content', 'present'], [
            'person' => $person,
            'present' => $present
        ]);    
    }
}
