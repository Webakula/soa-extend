<?php

namespace Webakula\Admin\FormElements;

use KodiCMS\Assets\Facades\Meta;
use SleepingOwl\Admin\Form\Element\NamedFormElement;


class GoogleMap extends NamedFormElement {
    public function initialize() {
        Meta::addJs('admin-custom-js-gmap-api', 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_MAPS_API_KEY'));
        Meta::addJs('admin-custom-js-gmap-init', asset('vendor/webakula/js/google-map/google-map.js'));
    }
    public function render() {
        return view('webakula::form-element.google-map', $this->toArray())->render();
    }
}