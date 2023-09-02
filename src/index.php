<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/firework.css">
    <link rel="stylesheet" href="css/background.css">
    <script src="js/script.js"></script>
    <title>☕ Prenez une pause café</title>
</head>

<body>
    <section id="bg">
        <ul id="shape">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <div class="container">
                <div class="logo">
                    <img src="img/logo.png" alt="Logo">
                </div>


                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST["category"])) {
                        $category = $_POST["category"];
                        $rssFeedUrl = "";

                        if ($category === "Linux") {
                            $rssFeedUrl = "https://www.journalduhacker.net/t/linux.rss";
                        } elseif ($category === "Development") {
                            $rssFeedUrl = "https://www.journalduhacker.net/t/dev.rss";
                        } elseif ($category === "Auto-Hébergement") {
                            $rssFeedUrl = "https://www.journalduhacker.net/t/auto-h%C3%A9bergement.rss";
                        } elseif ($category === "surprise") {
                            $rssFeedUrl = "https://www.journalduhacker.net/rss";
                        } else {
                            echo "Catégorie invalide.";
                            exit;
                        }

                        $rssData = simplexml_load_file($rssFeedUrl);

                        if ($rssData) {
                            $randomItemIndex = rand(0, count($rssData->channel->item) - 1);
                            $randomItem = $rssData->channel->item[$randomItemIndex];

                            $title = (string) $randomItem->title;
                            $url = (string) $randomItem->link;

                            echo "<p class='lien container'><a href='$url' target='_blank'>$title</a></p>";
                        } else {
                            echo "Error fetching RSS feed.";
                        }
                    }
                } else {
                    echo <<<EOT

 <form id="radioForm" method="post">
        <div class="center-radio-group">
            <label>
                <input type="radio" name="category" value="Linux"> 🐧 Linux
            </label>
            <label>
                <input type="radio" name="category" value="Development"> 🖥️ Development
            </label>
            <label>
                <input type="radio" name="category" value="Auto-Hébergement"> 🖥 Auto-Hébergement
            </label>
            <label>
                <input type="radio" name="category" value="surprise" checked> ☕ Kawa Surprise
            </label>
        </div>
        <div class="container">
        <button id="submitButton" type="submit">Prendre une pause café</button>
        </div>
    </form>
    <footer>
        <p>Prenez une pause-café en lisant un article de la catégorie de votre choix !</p>
        <p style="padding-top: 2px;">Merci au <a href="https://www.journalduhacker.net/">Journal Du Hackeur</a> de mettre à disposition ces liens !</p>

    </footer>
EOT;
                }
                ?>


            </div>

        </ul>
    </section>
</body>

</html>