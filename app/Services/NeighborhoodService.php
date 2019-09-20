<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NeighborhoodForm;
use App\Repository\NeighborhoodRepo;

class NeighborhoodService {

    /**
     * @var NeighborhoodRepo
     */
    private $repo;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepo $repo
     */
    public function __construct(NeighborhoodRepo $repo) {
        $this->repo = $repo;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function create($request) {
        $form = new NeighborhoodForm();
        $form->content = $request->content;
        $form->validate();
        return $this->repo->create($form->toArray());
    }
}
