<?php
require 'functions.php';
if (isset($_COOKIE["games"])) {
    $games = json_decode($_COOKIE['games'], true);
} else {
    $games = array(
        "morrocoVSBrasil" => array("MOROCCO" => 0, "BRASIL" => 0, "played" => false),
        "morrocoVSSpain" => array("MOROCCO" => 0, "SPAIN" => 0, "played" => false),
        "morrocoVSCanada" => array("MOROCCO" => 0, "CANADA" => 0, "played" => false),
        "BrasilVSCanada" => array("BRASIL" => 0, "CANADA" => 0, "played" => false),
        "BrasilVSSpain" => array("BRASIL" => 0, "SPAIN" => 0, "played" => false),
        "CanadaVSSpain" => array("CANADA" => 0, "SPAIN" => 0, "played" => false),
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World cup simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1 class="text-center m-5">WC Simulator</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET['gameName'])) {
            foreach ($games as $game => $gameInfo) {
                // Only mark as played if both scores are provided
                if (
                    isset($_GET[$game][1]) && isset($_GET[$game][3]) &&
                    $_GET[$game][1] !== '' && $_GET[$game][3] !== ''
                ) {
                    $games[$game][$_GET[$game][0]] = (int)$_GET[$game][1];
                    $games[$game][$_GET[$game][2]] = (int)$_GET[$game][3];
                    $games[$game]['played'] = true;
                } else {
                    // If only one score is provided, set the other to 0
                    if (isset($_GET[$game][1]) && $_GET[$game][1] !== '') {
                        $games[$game][$_GET[$game][0]] = (int)$_GET[$game][1];
                        $games[$game][$_GET[$game][2]] = 0;
                        $games[$game]['played'] = true;
                    } elseif (isset($_GET[$game][3]) && $_GET[$game][3] !== '') {
                        $games[$game][$_GET[$game][0]] = 0;
                        $games[$game][$_GET[$game][2]] = (int)$_GET[$game][3];
                        $games[$game]['played'] = true;
                    }
                }
            }
            setcookie('games', json_encode($games));
        } elseif ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET['reset'])) {
            $games = array(
                "morrocoVSBrasil" => array("MOROCCO" => 0, "BRASIL" => 0, "played" => false),
                "morrocoVSSpain" => array("MOROCCO" => 0, "SPAIN" => 0, "played" => false),
                "morrocoVSCanada" => array("MOROCCO" => 0, "CANADA" => 0, "played" => false),
                "BrasilVSCanada" => array("BRASIL" => 0, "CANADA" => 0, "played" => false),
                "BrasilVSSpain" => array("BRASIL" => 0, "SPAIN" => 0, "played" => false),
                "CanadaVSSpain" => array("CANADA" => 0, "SPAIN" => 0, "played" => false),
            );
            setcookie('games', json_encode($games));
        }
        ?>
    </header>
    <!-- all games section -->
    <main class="d-flex justify-content-center">
        <section class="col-md-4 mx-1" id="games">
            <?php
            foreach ($games as $game => $gameInfo): ?>
                <?php
                $nationalTeams = [];
                $nationalTeamsInfo = [];
                foreach ($gameInfo as $key => $value):
                    array_push($nationalTeams, $key);
                    array_push($nationalTeamsInfo, $value);
                ?>
                <?php endforeach ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" class="navy_blue_bg p-3 mb-3">
                    <div id="match" class="d-flex m-2 p-2 justify-content-center align-items-center baby_blue_bg position-relative <?php echo $gameInfo["played"] ? 'border border-success' : ''; ?>">
                        <?php if ($gameInfo["played"]): ?>
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success">✓ Played</span>
                            </div>
                        <?php endif; ?>
                        <div class="team1 w-50 text-center">
                            <h5 class="fw-bold text-dark mb-0"><?php echo $nationalTeams[0] ?></h5>
                        </div>
                        <div id="teamsScores" class="d-flex justify-content-center align-items-center mt-4 mb-3 p-3" style="background-color: rgba(255, 255, 255, 0.9); border-radius: 10px; border: 2px solid #000c66;">
                            <!-- game name -->
                            <input type="hidden" name="gameName" value="<?php echo $game ?>">
                            <!-- first team name -->
                            <input type="hidden" name="<?php echo $game ?>[]" value="<?php echo $nationalTeams[0] ?>">
                            <!-- first team score -->
                            <input type="number" min="0" max="99" name="<?php echo $game ?>[]"
                                <?php if ($gameInfo["played"] == true) {
                                    echo "readonly";
                                } ?>
                                value="<?php echo $nationalTeamsInfo[0] ?>" class="form-control mx-2 text-center"
                                style="width: 120px; height: 50px; font-size: 24px; font-weight: bold; border: 3px solid #000c66;"
                                placeholder="0" required>

                            <span class="mx-3 fw-bold fs-4 text-dark">VS</span>

                            <!-- second team name -->
                            <input type="hidden" name="<?php echo $game ?>[]" value="<?php echo $nationalTeams[1] ?>">
                            <!-- second team score -->
                            <input type="number" min="0" max="99" name="<?php echo $game ?>[]"
                                value="<?php echo $nationalTeamsInfo[1] ?>"
                                <?php if ($gameInfo["played"] == true) {
                                    echo "readonly";
                                } ?> class="form-control mx-2 text-center"
                                style="width: 120px; height: 50px; font-size: 24px; font-weight: bold; border: 3px solid #000c66;"
                                placeholder="0" required>
                        </div>
                        <div class="team2 w-50 text-center">
                            <h5 class="fw-bold text-dark mb-0"><?php echo $nationalTeams[1] ?></h5>
                        </div>
                    </div>
                <?php endforeach ?>
                <input type="submit" name="" value="Play" class="d-block btn btn-success px-4 py-2 mx-auto">
                </form>
                <div class="text-center">
                    <form method='GET' action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="reset" value="reset">
                        <input type="submit" class="btn text-center mx-auto btn-danger mb-5" value="Reset all games">
                    </form>
                </div>
        </section>
        <section class="col-md-6 px-3 py-4 mx-1">
            <h2 class="py-2 text-center text-primary">Leaderboard table</h2>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>TEAM</th>
                            <th>POINTS</th>
                            <th>GAMES PLAYED</th>
                            <th>GAMES WON</th>
                            <th>GAMES EQUAL</th>
                            <th>GAME LOSTS</th>
                            <th>Goals Scored</th>
                            <th>Goals Recieved</th>
                            <th>DIFF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_REQUEST['simulate']) &&  $_REQUEST['simulate'] == "simulate") {
                            foreach (sortTable(createTeams($games)) as  $game => $gameInfo) {

                        ?>
                                <tr>
                                    <td><?php echo $game + 1; ?> </td>
                                    <td><?php echo $gameInfo["Team"];  ?></td>
                                    <td><?php echo $gameInfo["POINTS"];  ?></td>
                                    <td><?php echo $gameInfo["GAMES_PLAYED"];  ?></td>
                                    <td><?php echo $gameInfo["GAMES_WON"];  ?></td>
                                    <td><?php echo $gameInfo["GAMES_EQUAL"];  ?></td>
                                    <td><?php echo $gameInfo["GAME_LOSTS"];  ?></td>
                                    <td><?php echo $gameInfo["GOALS_SCORED"];  ?></td>
                                    <td><?php echo $gameInfo["GOALS_RECEIVED"];  ?></td>
                                    <td><?php echo $gameInfo["DIFF"]; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "
<tr>
<td>1</td>
<td>MOROCCO</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
</tr>
<tr>
<td>2</td>
<td>BRASIL</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
</tr>
<tr>
<td>3</td>
<td>CANADA</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
</tr>
<tr>
<td>4</td>
<td>SPAIN</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
<td>0</td>
</tr> 
";
                        }
                        ?>
                        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="simulate" value="simulate" class="m-auto">
                            <input type="submit" class="btn text-center mx-auto blue_bg my-2 simulate" value="simulate">
                        </form>
        </section>
    </main>
</body>

</html>