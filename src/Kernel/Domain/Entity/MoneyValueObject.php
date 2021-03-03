<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity;

class MoneyValueObject extends FloatValueObject
{
    private int $whole;
    private int $tenths;

    public function __construct(float $value)
    {
        parent::__construct($value);

        $arPrice = explode('.', (string)$this->getValue());
        $this->whole = isset($arPrice[0]) ? (int)$arPrice[0] : 0;
        $this->tenths = isset($arPrice[1]) ? (int)$arPrice[1] : 0;
    }

    public function getFormatted(): string
    {
        $result = $this->getFormattedWhole();
        if ($this->tenths > 0) {
            $result .= '.' . $this->getFormattedTenths();
        }

        return $result;
    }

    public function getFormattedWhole(): string
    {
        return number_format($this->whole, 0, ' ', ' ');
    }

    public function getFormattedTenths(): string
    {
        return $this->tenths > 10 ? substr((string)$this->tenths, 0, 2) : $this->tenths . '0';
    }

    public function getWhole(): int
    {
        return $this->whole;
    }

    public function getTenths(): int
    {
        return $this->tenths;
    }
}
