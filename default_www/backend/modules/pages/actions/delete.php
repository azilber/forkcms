<?php

/**
 * BackendPagesDelete
 * This is the delete-action, it will delete a page
 *
 * @package		backend
 * @subpackage	pages
 *
 * @author 		Tijs Verkoyen <tijs@netlash.com>
 * @since		2.0
 */
class BackendPagesDelete extends BackendBaseActionDelete
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// get parameters
		$id = $this->getParameter('id');

		// get page (we need the title)
		$page = BackendPagesModel::get($id);

		// delete the page
		$success = BackendPagesModel::delete($id);

		// build cache
		BackendPagesModel::buildCache();

		// page is deleted, so redirect to the overview
		if($success) $this->redirect(BackendModel::createURLForAction('index') .'&report=deleted&var='. urlencode($page['title']));
		else $this->redirect(BackendModel::createURLForAction('edit') .'&error=delete&var='. urlencode($page['title']));
	}
}

?>