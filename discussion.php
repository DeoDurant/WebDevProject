<?php

require('connect.php');

$query = "SELECT * FROM discussion";
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
                <h1><?= $row['title'] ?></h1>
                
                <section>
                    <?php if (strlen($row['content']) > 200): ?>
                    <p><?= substr($row['content'], 0, 200); ?>Read Full Post</p>
                    <?php else: ?>
                   <p><?= $row['content'] ?></p>
                   <?php endif ?>
                </section>
                <h3><?= $row['datetime'] ?></h3>
                
            <?php endwhile ?>
        </section>

        <section>
            <?php echo (date('d-m-y')); ?>
        </section>

    </section>

</body>
</html>