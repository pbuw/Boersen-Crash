<?php

/**
 * Class database
 * used for manage the database
 */
class database
{
    /**
     * @return mysqli
     */
    public static function getConnection()
    {
        $connection = mysqli_connect("localhost", "root", "root", "bc");
        return $connection;
    }

    /**
     * @param $query
     * @param $connection
     * @return mixed
     */
    public static function getResultByQuery($query, $connection)
    {
        $result = $connection->query($query);
        return $result;
    }

}