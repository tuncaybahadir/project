<?php

use App\Models\Repositories\WidgetRepository as Widget;

class HomeController extends BaseController
{
    public $widget;

    public function __construct(Widget $widget)
    {
        $this->widget = $widget;

    }

    public function index()
    {
        return Response::view('home.index');
    }

    public function locale()
    {
        return $this->widget->allValues();
    }

    public function selectLocale($select_locale)
    {
        return $this->widget->getLocaleValues($select_locale);
    }

}