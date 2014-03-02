<?php
// module/StickyNotes/src/StickyNotes/Controller/StickyNotesController.php:

namespace StickyNotes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StickyNotesController extends AbstractActionController {
	
	protected $_stickyNotesTable;
	
	//interaction with Model in order to get data
	public function getStickyNotesTable() {
		if (!$this->_stickyNotesTable) {
            $sm = $this->getServiceLocator();
            $this->_stickyNotesTable = $sm->get('StickyNotes\Model\StickyNotesTable');
        }
        return $this->_stickyNotesTable;
	}
	
    public function indexAction() {
    	return new ViewModel(array(
    		'stickynotes' => $this->getStickyNotesTable()->fetchAll(),
    	));
    }

    public function addAction(){
    	$request = $this->getRequest();
    	$response = $this->getResponse();
    	if ($request->isPOst()) {
    		$new_note = new \StickyNote\Model\Entity\StickyNote();
    		if (!$note_id = $this->getStickyNotesTable()->saveStickyNotes($new_note)) {
    			
    		} else {
    			$response->setContent(\Zend\Json\Json::encode(array('response' => true)));
    		}
    	}
    }

    public function removeAction() {
    }

    public function updateAction(){
    }
}