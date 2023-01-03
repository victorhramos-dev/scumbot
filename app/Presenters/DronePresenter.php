<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DronePresenter extends Presenter
{
    /**
     * Return formated short created at date
     *
     * @return  string
     */
    public function createdAt()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Return formated full created at date
     *
     * @return  string
     */
    public function createdAtFull()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }
}
