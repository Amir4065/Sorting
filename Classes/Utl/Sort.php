<?php

namespace Classes\Utl;

class Sort{

    public function quickSort(Array $productPrice)
    {
        $loe = [];
        $gt = [];
        if(count($productPrice) < 2 )
        {
            return $productPrice;
        }
        $pivot_key = key($productPrice);
        $pivot = array_shift($productPrice);
        foreach($productPrice as $item)
        {
            if($item['costs'] >= $pivot['costs'])
            {
                $loe[] = $item;
            }else if($item['costs'] < $pivot['costs']){
                $gt[] = $item;
            }
        }
      	return array_merge($this->quickSort($loe),array($pivot_key=>$pivot),$this->quickSort($gt));
    }
}