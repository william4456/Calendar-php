<?php

namespace App\Date;

class Month
{
    public $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
    private $months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
    public $month;
    public $year;

    /**
     * Constructeur de l'objet Month
     * @param int $month mois compris entre 1 et 12
     * @param int $year l'annee
     */
    public function __construct(int $month = null, int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Renvoie le mois en lettre (ex. Septembre 2019 )
     * @return String
     */
    public function __toString()
    {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Renvoie le jour d'aujourd'hui
     * @return DateTime
     */
    public function getStartingDay()
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * @return int
     */
    public function getWeeks()
    {
        $start = new \DateTime("{$this->year}-{$this->month}-01");
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W') - 1);

        if ($weeks < 0) {
            $weeks = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year) / 7 + 1;
        }
        return $weeks;
    }

    /**
     * Renvoie les jours du mois 
     * @param DateTime $date
     * @return DateTime
     */
    public function withinMonth(\DateTime $date)
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Renvoie le prochain mois
     * @return Month
     */
    public function nextMonth()
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**
     * Renvoie le mois precedent
     * @return Month
     */
    public function previousMonth()
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }
}
