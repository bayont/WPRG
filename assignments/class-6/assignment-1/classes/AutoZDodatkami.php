<?php

declare(strict_types=1);

class AutoZDodatkami extends NoweAuto
{
    public $alarm;
    public $radio;
    public $klimatyzacja;

    public function __construct(string $model, float $eurPrice, float $eurPlnExchangeRate, float $alarm, float $radio, float $klimatyzacja)
    {
        parent::__construct($model, $eurPrice, $eurPlnExchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene()
    {
        return parent::ObliczCene() + $this->alarm + $this->radio + $this->klimatyzacja;
    }
}
