<?php
namespace Database;

class TranslateTable extends ABSDatabase
{
    private static string $tableName = 'p_translate';

    public static function getTableName():string
    {
        return self::$tableName;
    }

    /**
     * Gets one record from database or false
     * @param array $filter
     * @param array $select
     * @return array|bool
     * @throws \Exception
     */
    public function getRow(array $filter, array $select): array|false
    {
        $strSql = 'SELECT ' . (in_array('*', $select) ? '*' : implode(',', $select)) . ' FROM ' . self::$tableName;
        if ($filter) {
            $strSql .= ' WHERE ';
            foreach ($filter as $fk => $fv) {
                $strSql .= (($fk . ' = "' . addslashes($fv) . '"') . ' AND ');
            }
            $strSql = rtrim($strSql, ' AND ');
        }
        $strSql .= ' LIMIT 1';

        $res = $this->connect()->query($strSql);
        $res->setFetchMode(\PDO::FETCH_ASSOC);

        return $res->fetch();
    }

    /** Add row to database
     * @param array $fields
     * @return int|false - row id or false
     * @throws \Exception
     */
    public function add(array $fields): int|false
    {
        $sqlString = 'INSERT INTO ' . self::getTableName().' (' . implode(',', array_keys($fields)) . ') VALUES ('
            . implode(',', array_map(fn($value) => "'$value'", array_values($fields))) . ');';

        $rs = $this->connect()->prepare($sqlString)->execute();
        return $rs ? $this->connect()->lastInsertId() : false;
    }

    /** Update existed row
     * @param int $id
     * @param array $fields
     * @return bool
     * @throws \Exception
     */
    public function update(int $id, array $fields): bool
    {
        $sqlStr = 'UPDATE ' . self::getTableName() . ' SET ';

        $fieldsRows = [];
        foreach ($fields as $fieldKey => $fieldValue) {
            $fieldsRows[] = "$fieldKey='$fieldValue'";
        }
        $sqlStr .= implode(',', $fieldsRows);
        $sqlStr .= (' WHERE ID =' . $id . ';');

        return $this->connect()->prepare($sqlStr)->execute();
    }

    /**
     * Delete row by id
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $sqlStr = 'DELETE FROM ' . self::getTableName() . ' WHERE ID = ' . $id;
        return $this->connect()->prepare($sqlStr)->execute();
    }

}
