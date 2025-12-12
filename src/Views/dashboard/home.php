<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
</head>
<body>
  <h1>Tableau de bord</h1>
  <h3>Résumé</h3>
  <ul>
    <li>Révenus Totaux: <strong><?= $income ?> F CFA</strong></li>
    <li>Dépenses Totales : <strong><?= $expense ?> F CFA</strong></li>
    <li>Solde Actuel : <strong><?= $balance ?> F CFA</strong></li>
  </ul>
  
  <h3>Dépenses par catégories</h3>
  <ul>
    <?php foreach($byCategory as $cat) : ?>
      <li><?= $cat['name'] ?> : <?= $cat['total'] ?></li>
    <?php endforeach ?>
  </ul>

  <h3>Dernières transactions </h3>
  <table border="1" cellpadding="5">
    <tr>
      <th>Date</th>
      <th>Catégories</th>
      <th>Type</th>
      <th>Montant</th>
    </tr>
    <?php foreach($lastTransactions as $t): ?>
      <tr>
        <td><?= $t['date_transaction'] ?></td>
        <td><?= $t['category'] ?></td>
        <td><?= $t['type'] ?></td>
        <td><?= $t['amount'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <script>
  const ctx = document.getElementById('myChart');

  const labels = <?= json_encode(array_column($monthlyStats, 'mois')) ?>;
  const incomeData = <?= json_encode(array_column($monthlyStats, 'total_income')) ?>;
  const expenseData = <?= json_encode(array_column($monthlyStats, 'total_expense')) ?>;

  new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: [
              {
                  label: 'Revenus',
                  data: incomeData,
                  borderWidth: 2
              },
              {
                  label: 'Dépenses',
                  data: expenseData,
                  borderWidth: 2
              }
          ]
      }
  });
  </script>

  <h3>Graphique Mensuel</h3>
  <canvas id="myChart" whidth="400" heigt="200"></canvas>
</body>
</html>