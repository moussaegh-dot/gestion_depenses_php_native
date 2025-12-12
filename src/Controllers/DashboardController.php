<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\AuthMiddleware;
use App\Core\Auth;
use App\Models\Transaction;

class DashboardController extends Controller 
{
    public function index()
    {
        AuthMiddleware::requireAuth();
        $user = Auth::user();

        $income = Transaction::totalIncome($user['id']);
        $expense = Transaction::totalExpense($user['id']);
        $balance = $income - $expense;

        $byCategory = Transaction::byCategory($user['id']);
        $mothlyStats = Transaction::monthlyStats($user['id']);
        $lastTransactions = Transaction::lastTransactions($user,5);
        
        $this->view('dashboard/home', [
            "income" => $income,
            "expense" => $expense,
            "balance" => $balance,
            "byCategory" => $byCategory,
            "monthlyStats" => $mothlyStats,
            "lastTransactions" => $lastTransactions,
        ]);
    }
}