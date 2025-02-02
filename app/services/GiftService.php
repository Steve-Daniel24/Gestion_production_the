<?php

namespace app\services;
use app\models\Gift;

use Flight;

class GiftService
{
    public static function suggestGifts($girls, $boys)
    {
        $gifts = [];
        $gifts['girls'] = Gift::findByCategory('girl', $girls);
        $gifts['boys'] = Gift::findByCategory('boy', $boys);
        $gifts['neutral'] = Gift::findByCategory('neutral', ($girls + $boys));
        return $gifts;
    }

    public static function calculateTotal($gift_ids)
    {
        $total = 0;
        foreach ($gift_ids as $id) {
            $price = Flight::db()->prepare("SELECT price FROM gifts WHERE id = :id");
            $price->bindParam(':id', $id);
            $price->execute();
            $prices = $price->fetch();
            if ($prices) {
                $total += $prices['price'];
            }
        }
        return $total;
    }

}
