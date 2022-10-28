<?php
namespace Classes\Utl;

class PriceCalculate
{
    private $baseEelectricityTariff;
    private $packagedTariff;

    public function __construct(array $basEelectricityTariff, array $packagedTariff)
    {
        $this->baseEelectricityTariff = $basEelectricityTariff;
        $this->packagedTariff = $packagedTariff;
    }

    public function calculateBaseEelectricityTariff(): array
    {
        $baseCostsPerMonth = 5;
        $consumptionPerKwh = 0.22;
        $baseAnnualCosts = [];
        $counter = 0;
        foreach($this->baseEelectricityTariff as $item)
        {
            $result = 0;
            $result = ($baseCostsPerMonth * 12) + ($item * $consumptionPerKwh);
            $baseAnnualCosts[$counter]['label'] = 'Base Eelectricity Tariff';
            $baseAnnualCosts[$counter]['costs'] = $result;
            $counter++;
        }
        return $baseAnnualCosts;
    }

    public function calculatePackagedTariff()
    {
        $baseAnnual = 800;
        $limitConsumption = 4000;
        $consumptionPerKwh = 0.30;
        $packagedAnnualCosts = [];
        $counter = 0;
        foreach($this->packagedTariff as $item)
        {
            if($limitConsumption >= $item)
            {
                $packagedAnnualCosts[$counter]['label'] = 'Packaged Tariff';
                $packagedAnnualCosts[$counter]['costs'] = $baseAnnual;
            }
            if($limitConsumption < $item)
            {
                $analyzedConsumption = $item - $limitConsumption;
                $result = $baseAnnual + ($analyzedConsumption * $consumptionPerKwh);
                $packagedAnnualCosts[$counter]['label'] = 'Packaged Tariff';
                $packagedAnnualCosts[$counter]['costs'] =  $result;
            }
            $counter++;
        }
        return $packagedAnnualCosts;
    }

}