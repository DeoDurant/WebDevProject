<?php

require('connect.php');

$query = "SELECT * FROM pokemon";
$statement = $db->prepare($query);
$statement->execute();
?>

</head>
<body>
    <h1>Professor Oak's Pokedex</h1>
    <section>
        <section>
            <h1><a href="homepage.php">Home</a></h1>
        </section>

        <ul>
            <li><a href="index.php" class="active">Pokedex</a></li>
            <li><a href="create.php">New Post</a></li>
            <li><a href="discussion.php">Discussion</a></li>
        </ul>

        <section>
            <?php if($statement->rowCount()==0): ?>
                <li><?="No posts here"; ?></li>
            <?php endif ?>
            <?php while($row = $statement->fetch()): ?>
                <h1><?= $row['name'] ?></h1>
                <h3><?= $row['typing'] ?></h3>
                <h3><?= $row['ability'] ?></h3>
                <section>
                    <?php if (strlen($row['notes']) > 200): ?>
                    <p><?= substr($row['notes'], 0, 200); ?>Read Full Post</p>
                    <?php else: ?>
                   <p><?= $row['notes'] ?></p>
                   <?php endif ?>
                </section>
            <?php endwhile ?>
        </section>

        <section>
            <?php echo (date('d-m-y')); ?>
        </section>

    </section>

</body>
</html>