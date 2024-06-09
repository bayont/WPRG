<?php

class Ubezpieczenie extends AutoZDodatkami
{
    public $insuranceRate;
    public $yearsOwned;

    public function __construct(string $model, float $eurPrice, float $eurPlnExchangeRate, float $alarm, float $radio, float $klimatyzacja, float $insuranceRate, int $yearsOwned)
    {
        parent::__construct($model, $eurPrice, $eurPlnExchangeRate, $alarm, $radio, $klimatyzacja);
        $this->insuranceRate = $insuranceRate;
        $this->yearsOwned = $yearsOwned;
    }

    public function ObliczCene()
    {
        return  $this->insuranceRate * (parent::ObliczCene() * ((100 - $this->yearsOwned) / 100));
    }
}
