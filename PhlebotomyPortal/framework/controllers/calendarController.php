<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/controllers/Controller.php";

class calendarController extends Controller {

    public $Title = "Calendar";
    protected $Route = null;

    public function __construct($Route = null) {
        parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\calendarView();
        $this->ControllerModel = new \PhlebotomyPortal\calendarModel();
    }

    private function setup($Route) {

        $this->Route = $Route;
    }

}
