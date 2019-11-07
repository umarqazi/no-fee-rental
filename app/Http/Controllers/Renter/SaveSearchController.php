<?php

namespace App\Http\Controllers\Renter;

use App\Services\SaveSearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class SaveSearchController
 * @package App\Http\Controllers\Renter
 */
class SaveSearchController extends Controller {

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var SaveSearchService
     */
    private $saveSearchService;

    /**
     * SaveSearchController constructor.
     */
    public function __construct() {
        $this->saveSearchService = new SaveSearchService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $searches = $this->saveSearchService->get($this->paginate);
        return view('renter.save_search', compact('searches'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function remove(Request $request, $id) {
        $res = $this->saveSearchService->remove($id);
        return sendResponse($request, $res, 'Search has been deleted.');
    }
}
