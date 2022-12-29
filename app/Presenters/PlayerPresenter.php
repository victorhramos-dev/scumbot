<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class PlayerPresenter extends Presenter
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

    /**
     * Return formated created at date week full
     *
     * @return  string
     */
    public function createdAtWeekFull()
    {
        $startOfWeek = $this->created_at->startOfWeek()->format('d/m/Y');

        $endOfWeek = $this->created_at->endOfWeek()->format('d/m/Y');

        $weekNum = $this->created_at->week();

        return sprintf('Semana %s : <strong>%s</strong> &raquo; <strong>%s</strong>', $weekNum, $startOfWeek, $endOfWeek);
    }

    /**
     * Return first name
     *
     * @return  string
     */
    public function firstName()
    {
        return explode(' ', $this->entity->name)[0];
    }

    /**
     * Return short name
     *
     * @return  string
     */
    public function shortName()
    {
        $words = explode(' ', $this->entity->name);

        if (count($words) > 1) {
            return sprintf('%s %s', $words[0], end($words));
        }

        return $words[0];
    }
}
