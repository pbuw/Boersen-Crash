<?php


class drinkManager {
    public static function updateLowPrice($drink) {
        if (rand(1, 3) == 3) {
            if ($drink["minPrice"] > $drink["currentPrice"] - 0.5) {
                $price = $drink["currentPrice"];
            } else {
                $price = $drink["currentPrice"] - 0.5;
            }
        } else {
            $price = $drink["currentPrice"] + 0.5;
        }
        return $price;
    }

    public static function updateNormalPrice($drink) {
        if (rand(1, 2) == 2) {
            if ($drink["minPrice"] > $drink["currentPrice"] - 0.5) {
                $price = $drink["currentPrice"];
            } else {
                $price = $drink["currentPrice"] - 0.5;
            }
        } else {
            $price = $drink["currentPrice"] + 0.5;
        }
        return $price;
    }

    public static function updateHighPrice($drink) {
        if (rand(1, 3) == 3) {
            if ($drink["maxPrice"] < $drink["currentPrice"] + 0.5) {
                $price = $drink["currentPrice"];
            } else {
                $price = $drink["currentPrice"] + 0.5;
            }
        } else {
            $price = $drink["currentPrice"] - 0.5;
        }
        return $price;
    }

    public static function showDrink($drink, $flag) {
        $m = new Mustache_Engine;
        $drink["flag"] = $flag;
        echo $m->render(file_get_contents("template/drink.html"), $drink);
    }
}