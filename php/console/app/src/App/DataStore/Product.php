<?php
class tableSetup {

    private PDO $db;

    public function __construct(string $dsn)
    {
        // 'sqlite:/var/www/html/var/db_store/testing.sqlite3'
        $this->db = new PDO($dsn);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function dropTable(string $tableName) :void
    {
        $this->db->exec('DROP TABLE IF EXISTS "'.$tableName.'"');
    }

    public function createProduct()
    {

        $file_db->exec(
            'CREATE TABLE IF NOT EXISTS "product" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "heading" VARCHAR,
    "title" VARCHAR,
    "price" VARCHAR,
    "price_in_pence" INTEGER,
    "annual_price" INTEGER,
    "discount" VARCHAR
  )'
        );
    }
}