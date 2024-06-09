<?php

declare(strict_types=1);

class NoweAuto
{
    public $model;
    public $eurPrice;
    public $eurPlnExchangeRate;

    public function __construct(string $model, float $eurPrice, float $eurPlnExchangeRate)
    {
        $this->model = $model;
        $this->eurPrice = $eurPrice;
        $this->eurPlnExchangeRate = $eurPlnExchangeRate;
    }

    public function ObliczCene()
    {
        return $this->eurPrice * $this->eurPlnExchangeRate;
    }
}
