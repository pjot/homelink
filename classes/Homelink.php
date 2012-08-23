<?php
class Homelink
{
	const BASE_URL = 'http://pjot.se/homelink';
	const TORRENT_PATH = '/home/pjot/Downloads/';
	const SEED_PATH = '/media/store/tmp/';
	const VIEW_PATH = '/media/store/share/';

	private $action = null;

	private static function redirect($action)
	{
		header('Location: ' . self::BASE_URL . '?action=' . $action);
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
		$menu->assign('items',
			array(
			'seed' => array(
				'name' => 'Seeding',
				'active' => $this->action == 'seed',
				'url' =>  self::BASE_URL . '?action=seed',
				'icon' => 'icon-hdd',
			),
			'view' => array(
				'name' => 'Viewing',
				'active' => $this->action == 'view',
				'url' => self::BASE_URL . '?action=view',
				'icon' => 'icon-film',
			),
			'deluge' => array(
				'name' => 'Downloading',
				'active' => $this->action == 'deluge',
				'url' => self::BASE_URL . '?action=deluge',
				'icon' => 'icon-tasks',
			),
			'torrent' => array(
				'name' => 'Add Torrent',
				'active' => $this->action == 'torrent',
				'url' => self::BASE_URL . '?action=torrent',
				'icon' => 'icon-download-alt',
			)
		    )
		);
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
		$folder = self::SEED_PATH . (isset($_GET['folder']) ? preg_replace('/\.\.\/?/', '', $_GET['folder']) : '');
		$directory = new DirectoryLister($folder);
		$entries = array();
		foreach ($directory->getFiles() as $file)
		{
		    $entries[] = new SeedEntry($folder . $file);
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
		$directory = new DirectoryLister(self::VIEW_PATH);
		$entries = array();
		foreach ($directory->getFiles() as $file)
		{
		    $entries[] = new ViewEntry(self::VIEW_PATH . $file);
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
		$this->view->assign('content', $view->fetch());
	}

	private function actionToggle()
	{
		$target = preg_replace('/\.\.\/?/', '', $_GET['target']);
		if (strpos($target, self::SEED_PATH) !== false)
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
		if (strpos($target, self::VIEW_PATH) !== false)
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
		echo 'ecT';
	}
	private function displayView()
	{
		$this->view->display('Main.tpl');
	}
}


