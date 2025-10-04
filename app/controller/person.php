<?php

/*
    Asatru PHP - Person Controller
*/

/**
 * This class represents your controller
 */
class PersonController extends BaseController {
    /**
	 * Handles URL: /person/add
	 * 
	 * @param Asatru\Controller\ControllerArg $request
	 * @return Asatru\View\RedirectHandler
	 */
    public function add_person($request)
    {
        try {
            $name = $request->params()->query('name');
            $birthday = $request->params()->query('birthday');

            Person::addPerson($name, $birthday);

            return redirect('/');
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
	 * Handles URL: /person/view/{id}
	 * 
	 * @param Asatru\Controller\ControllerArg $request
	 * @return Asatru\View\ViewHandler
	 */
    public function view_person($request)
    {
        $person_id = $request->arg('id');

        $person = Person::getPersonInfo($person_id);

        return parent::view(['content', 'person'], [
            'person' => $person
        ]);
    }
}
