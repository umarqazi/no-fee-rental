<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/21/19
 * Time: 3:28 PM
 */

namespace App\Services;

use \App\Traits\SearchTraitService as SearchFilters;

class SearchService {

    use SearchFilters {
        SearchFilters::__construct as private __searchConstruct;
    }

    /**
     * SearchService constructor.
     */
    public function __construct() {
        $this->__searchConstruct();
    }
}