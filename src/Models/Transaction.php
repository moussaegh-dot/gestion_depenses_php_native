<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Transaction 
{
    public static function totalIncome($user_id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
        SELECT SUM(amount) FROM transactions 
        WHERE user_id = ? AND type = 'income'
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn() ?? 0;
    }

    public static function totalExpense($user_id) 
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
        SELECT SUM(amount) FROM transactions 
        WHERE user_id = ? AND type = 'expense' 
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn() ?? 0;
    }

    public static function byCategory($user_id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
        SELECT categories.name, SUM(transactions.amount) AS total
        FROM transactions 
        JOIN categories ON transactions.category_id = categories.id
        WHERE transactions.user_id = ? AND transactions.type = 'expense'
        GROUP BY categories.name
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function monthlyStats($user_id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT DATE_FORMAT(date_transaction, '%Y-%m') AS mois,
                SUM(CASE WHEN type='income' THEN amount ELSE 0 END) AS total_income,
                SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) AS total_expense
            FROM transactions
            WHERE user_id = ?
            GROUP BY mois
            ORDER BY mois
            ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function lastTransactions($user_id, $limit)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT t.*, c.name AS category
            FROM transactions t
            JOIN categories c ON t.category_id = c.id
            WHERE t.user_id = ?
            ORDER BY t.date_transaction DESC
            LIMIT ?
        ");

        //Bind correct pour limit
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}