<?php
namespace Console\App\DataStore;

use PDO;

class Product
{

    private PDO $db;

    public function __construct(string $dsn)
    {
        $dsn = 'sqlite:/var/www/html/var/db_store/testing.sqlite3'; // Should be stored in .env
        $this->db = new PDO($dsn);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function dropTable(string $tableName): void
    {
        $this->db->exec('DROP TABLE IF EXISTS "' . $tableName . '"');
    }

    public function createTable(): void
    {
        $this->db->exec(
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

    /**
     * Inserts a product record into the database
     *
     * @param string[] $productData Product data to insert
     *
     * @return bool
     */
    public function insert(array $productData): bool
    {
        $sql = "INSERT INTO product (id, heading, title, price, price_in_pence, annual_price, discount) 
                    VALUES (:id, :heading, :title, :price, :price_in_pence, :annual_price, :discount)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(
            [
                'id' => $productData['id'],
                'heading' => $productData['heading'],
                'title' => $productData['title'],
                'price' => $productData['price'],
                'price_in_pence' => $productData['price_in_pence'],
                'annual_price' => $productData['annual_price'],
                'discount' => $productData['discount'],

            ]
        );
    }
}