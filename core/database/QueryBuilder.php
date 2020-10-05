<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 12:50
 */

namespace App\Core\Database;
use PDO;

class QueryBuilder
{
    protected $pdo;

    protected $statement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
            return $statement->rowCount();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function paginate($table, $start, $limit)
    {
        $statement = $this->pdo->prepare("select * from {$table} limit {$start},{$limit}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
