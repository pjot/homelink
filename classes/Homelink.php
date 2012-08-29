<?php
class Homelink
{
	private $action = null;
	
	private static function redirect($action)
	{
		header('Location: ' . Config::get('BASE_URL') . '?action=' . $action);
		exit;
	}

	public function run()
	{
		session_start();
		$this->getAction();
		$this->setupView();
		$this->doAction();
		$this->displayView();
	}

	private function setupView()
	{
		$this->view = new MySmarty();
		$this->view->assign('menu', $this->getMenu());
	}
	private function getMenu()
	{
		$menu = new MySmarty();
		$menu->assign('items', array(
			'seed' => array(
				'name' => 'Seeding',
				'active' => $this->action == 'seed',
				'url' =>  Config::get('BASE_URL') . '?action=seed',
				'icon' => 'icon-hdd',
			),
			'view' => array(
				'name' => 'Viewing',
				'active' => $this->action == 'view',
				'url' => Config::get('BASE_URL') . '?action=view',
				'icon' => 'icon-film',
			),
			'deluge' => array(
				'name' => 'Downloading',
				'active' => $this->action == 'deluge',
				'url' => Config::get('BASE_URL') . '?action=deluge',
				'icon' => 'icon-tasks',
			),
			'torrent' => array(
				'name' => 'Add Torrent',
				'active' => $this->action == 'torrent',
				'url' => Config::get('BASE_URL') . '?action=torrent',
				'icon' => 'icon-download-alt',
			)
		));
		return $menu->fetch('Menu.tpl');
	}
	private function getAction()
	{
		switch ($_GET['action'])
		{
			case 'seed':
			case 'view':
			case 'deluge':
			case 'torrent':
			case 'toggle':
				$this->action = $_GET['action'];
				break;
			default:
				$this->action = 'view';
				break;
		}
	}
	
	private function doAction()
	{
		$this->{'action' . ucfirst($this->action)}();
	}

	private function actionSeed()
	{
		$folder = Config::get('SEED_PATH') . '/' . (
			isset($_GET['folder']) 
				? preg_replace('/\.\.\/?/', '', $_GET['folder']) 
				: ''
		);
		$directory = new DirectoryLister($folder);
		$entries = array();
		foreach ($directory->getFiles() as $file)
		{
			$entries[] = new SeedEntry($folder . '/' . $file);
		}
		usort($entries, array('Entry', 'sort'));
		$view = new FileView();
		$view->loadRows($entries);
		if (isset($_GET['folder']))
		{
			$view->useBack();
		}
		$this->view->assign('content', $view->fetch());
	}

	private function actionView()
	{
		$directory = new DirectoryLister(Config::get('VIEW_PATH'));
		$entries = array();
		foreach ($directory->getFiles() as $file)
		{
			$entries[] = new ViewEntry(Config::get('VIEW_PATH') . $file);
		}
		usort($entries, array('Entry', 'sort'));
		$view = new FileView();
		$view->loadRows($entries);
		if (isset($_SESSION['banner']))
		{
			$view->setBanner($_SESSION['banner']);
			unset($_SESSION['banner']);
		}
		$this->view->assign('content', $view->fetch());
	}

	private function actionDeluge()
	{
		$view = new TorrentView();
		$view->addRows(Deluge::getInfo());
		if (isset($_SESSION['banner']))
		{
			$view->setBanner($_SESSION['banner']);
			unset($_SESSION['banner']);
		}
		$this->view->assign('content', $view->fetch());
	}

	private function actionToggle()
	{
		$target = preg_replace('/\.\.\/?/', '', $_GET['target']);
		if (strpos($target, Config::get('SEED_PATH')) !== false)
		{
			if (Toggler::makeLink($target))
			{
				$_SESSION['banner'] = array(
					'type' => 'success',
					'text' => 'Sucessfully added file.',
				);
			}
			else
			{
				$_SESSION['banner'] = array(
					'type' => 'error',
					'text' => 'Something went wrong when adding file.',
				);
			}
		}
		if (strpos($target, Config::get('VIEW_PATH')) !== false)
		{
			if (Toggler::removeLink($target))
			{
				$_SESSION['banner'] = array(
					'type' => 'success',
					'text' => 'Successfully removed file.',
				);
			}
			else
			{
				$_SESSION['banner'] = array(
					'type' => 'error',
					'text' => 'Something went wrong when removing file.',
				);
			}
		}
		self::redirect('view');
	}

	private function actionTorrent()
	{
		if ($_POST['torrent_url'])
		{
			if (TorrentDownloader::getUrl($_POST['torrent_url']))
			{
				$_SESSION['banner'] = array(
					'type' => 'success',
					'text' => 'Successfully added torrent.',
				);
			}
			else
			{
				$_SESSION['banner'] = array(
					'type' => 'error',
					'text' => 'Something went wrong when adding torrent',
				);
			}
			self::redirect('deluge');
		}
		else
		{
			$formView = new TorrentFormView();
			$this->view->assign('content', $formView->fetch());
		}	
	}
	private function displayView()
	{
		$this->view->display('Main.tpl');
	}
}


