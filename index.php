<?php

// Array Hotel
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// Stampo in pagina le informazioni date dall' array tramite un forEach

// foreach ($hotels as $hotel) {
//     echo "Name: " . $hotel['name'] . "<br>";
//     echo "Description: " . $hotel['description'] . "<br>";
//     echo "Parking: " . ($hotel['parking'] ? 'Yes' : 'No') . "<br>";
//     echo "Vote: " . $hotel['vote'] . "<br>";
//     echo "Distance to center: " . $hotel['distance_to_center'] . " km<br>";
// }


// Filtra gli hotel in base alla disponibilità di parcheggio
if (isset($_GET['parking']) && $_GET['parking'] === 'yes') {
    $filteredHotels = array_filter($hotels, function ($hotel) {
        return $hotel['parking'] === true;
    });
} else {
    $filteredHotels = $hotels;
}

// Filtra gli hotel in base al rating del hotel
if (isset($_GET['rating'])) {
    $minRating = intval($_GET['rating']);
    $filteredHotels = array_filter($filteredHotels, function ($hotel) use ($minRating) {
        return $hotel['vote'] >= $minRating;
    });
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5 mb-5">
        <form method="GET" action="">
            <div class="container">
                <label>
                    <!-- Valore checkbox preimpostato su yes, "yes" = true. Questa funzione permette di mantenere  il suo stato da "selezionato/ e non" anche quando la pagina viene aggiornata -->
                    <input type="checkbox" name="parking" value="yes" <?php if (isset($_GET['parking']) && $_GET['parking'] === 'yes') echo 'checked'; ?>> 
                    Filter by Parking
                </label>
            </div>
            <div class="container mt-3 mb-3">
                <label for="rating">Minimum Rating:</label>
                <!-- Pure qui il valore scritto rimane anche quando la pagina verrà ricaricata -->
                <input type="number" name="rating" id="rating" value="<?php echo isset($_GET['rating']) ? $_GET['rating'] : ''; ?>">
                <button type="submit">Filter</button>
            </div>
        </form>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to center</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ciclo tramite forEach e gli inserisco dentro la tabella -->
                <?php foreach ($filteredHotels as $index => $hotel) : ?>
                    <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php echo $hotel['parking'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo $hotel['vote']; ?></td>
                        <td><?php echo $hotel['distance_to_center']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>