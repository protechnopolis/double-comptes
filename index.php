<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visiteur IP Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 80%;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #2575fc;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur le site</h1>
        <form method="post" action="">
            <input type="text" name="pseudo" placeholder="Entrez votre pseudo" required>
            <input type="submit" value="Envoyer">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $ip = $_SERVER['REMOTE_ADDR'];

            // URL du webhook Discord
            $webhookUrl = 'https://discord.com/api/webhooks/1219213906661347329/chYn276egcy1hK6jU-G2D1ZkT6zW1WlApMlOCbFSTTZJugAiPSiKnqVTLHke2iA3zXO1';

            // Préparer les données
            $data = json_encode([
                'content' => "Nouveau visiteur : $pseudo (IP : $ip)"
            ]);

            // Envoyer les données au webhook Discord
            $ch = curl_init($webhookUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($ch);
            curl_close($ch);

            echo '<p>Merci ' . $pseudo . ', votre IP a été envoyée.</p>';
        }
        ?>
    </div>
</body>
</html>
