<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<table class="table table-list">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <?php foreach ($games as $game): ?>
        <tr>
            <td><?php echo $game->name ?></td>
            <td><?php echo $game->price ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>