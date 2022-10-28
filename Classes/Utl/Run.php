<?php
namespace Classes\Utl;

use Classes\Utl\PriceCalculate;
use Classes\Utl\Sort;

class Run
{
    public function init()
    {
        $annualBaseTariff = [];
        $annualPackagedTariff = [];
        $baseEelectricityTariff = [
            3500,
            4500,
            6000
        ];

        $packagedTariff = [
            3500,
            4500,
            6000
        ];

        $price = new PriceCalculate($baseEelectricityTariff, $packagedTariff);
        $annualBaseTariff = $price->calculateBaseEelectricityTariff();
        $annualPackagedTariff = $price->calculatePackagedTariff();

        $annualCosts = array_merge($annualBaseTariff, $annualPackagedTariff);

        $sort = new Sort();
        $result = $sort->quickSort($annualCosts);
        if(count($result) > 1 )
        {
            echo ' ------------------------------------------------------------------- '."\n";
            echo '|'."\t\t".'Tariff Name'."\t\t".'| Annual Costs(€/Year)'."\t\t".'| '."\n";
            echo ' ------------------------------------------------------------------- '."\n";
        }
        foreach($result as $item)
        {
            echo '|'."\t".$item['label']. "\t\t".'|'."\t\t". $item['costs']."\t\t".'|'."\n";
            echo ' ------------------------------------------------------------------- '."\n";
        }
    }
}