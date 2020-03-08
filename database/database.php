<?php

/**
 * Class database
 * used for manage the database
 */
class database {
    /**
     * @return mysqli
     */
    public static function getConnection() {
        $connection = mysqli_connect("localhost", "ch263738_boersencrash", "Assd#[]dfcmdlkf343434", "ch263738_boersencrash");
        return $connection;
    }

    /**
     * @param $query
     * @param $connection
     * @return mixed
     */
    public static function getResultByQuery($query, $connection) {
        $result = $connection->query($query);
        return $result;
    }

    public static function getDrinks($connection) {
        $result = $connection->query("SELECT * FROM drink");
        return $result;
    }

    public static function updateDrinkPrice($id, $price, $connection) {
        $result = $connection->query("UPDATE `drink` SET `currentPrice` = '$price' WHERE `drink`.`id` = $id; ");
    }

}