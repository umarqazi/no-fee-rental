<?php
/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller {

    /**
     * @var UserService
     */
	private $service;

    /**
     * HomeController constructor.
     *
     * @param UserService $service
     */
	public function __construct(UserService $service) {
		$this->service = $service;
	}

	/**
	 * @return View
	 */
	public function index() {
		return view('admin.index');
	}

    /**
     * @return mixed
     * @throws \Exception
     */
	public function agents() {
		return dataTable($this->service->agents());
	}

    /**
     * @return mixed
     * @throws \Exception
     */
	public function renters() {
		return dataTable($this->service->renters());
	}

    /**
     * @return mixed
     * @throws \Exception
     */
    public function owners() {
        return dataTable($this->service->owners());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
	public function companies() {
        return dataTable($this->service->companies());
	}

    /**
     * @param $id
     *
     * @return mixed
     */
    public function associatedAgents($id) {
        $agents= $this->service->associatedAgents($id);
        return $agents ;
    }
}
