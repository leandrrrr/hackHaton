<x-app-layout>

        <section class="hero is-primary">
            <div class="hero-body">
            <p class="title">
            {{ __('Dashboard') }}
            </p>
            </div>
        </section>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="notification is-primary is-light">
                    {{ __("You're logged in!") }}
            </div>
            <br><br>
            <style>
                .container {
                    display: flex;
                    height: 100%;
                }


                .block {
                    flex: 1;
                    text-align: center;
                    padding: 20px;
                }


                .titleStats{
                    font-size: 25px;
                }
            </style>


            <!-- Inclure la librairie Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </head>


            <body>


            <div class="container">
                <div class="block">

                    <p class="titleStats">Les delis les plus commun</p>
                    <canvas id="monDoughnut" style="display:block">
                    </canvas>
                </div>
                <div class="block">
                    <p  class="titleStats">Evolution du total des delis </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <canvas id="evolutionDelis" style="display:block">
                    </canvas>
                </div>
                <div class="block">
                    <p class="titleStats">Les departements avec le plus d'insecurité</p>
                    <canvas id="departementDanger" style="display:block">
                    </canvas>
                </div>
            </div>



            @php

                $decodedData = json_decode($delisData, true);

                // Filtrer les données pour obtenir celles de l'année en cours
                $currentYearData = array_filter($decodedData, function($entry) {
                    return date('Y', strtotime($entry['dateMois'])) == date('Y');
                });

                // Initialiser un tableau pour stocker les totaux de nbDelit par typeDeDelit
                $totalsByType = [];

                foreach($currentYearData as $entry) {
                    $typeDeDelit = $entry['typeDeDelit'];
                    $nbDelit = $entry['nbDelit'];

                    if(!isset($totalsByType[$typeDeDelit])) {
                        $totalsByType[$typeDeDelit] = 0;
                    }

                    $totalsByType[$typeDeDelit] += $nbDelit;
                }

                // Trier les totaux par ordre décroissant
                arsort($totalsByType);

                // Prendre les 5 premiers éléments
                $top5 = array_slice($totalsByType, 0, 5, true);
            @endphp
            @php
//nbdelisevolution
                $decodedData = json_decode($delisData, true);


    $resultNbDelisTt = [];

    foreach($decodedData as $entry) {
        $year = date('Y', strtotime($entry['dateMois']));
        $nbDelit = $entry['nbDelit'];

        if(!isset($resultNbDelisTt[$year])) {
            $resultNbDelisTt[$year] = 0;
        }

        $resultNbDelisTt[$year] += $nbDelit;
    }

    // Trier les années de la plus petite à la plus grande
    ksort($resultNbDelisTt);
            @endphp
            @php

                $decodedData = json_decode($delisData, true);

                $result = [];

                foreach($decodedData as $entry) {
                    $department = $entry['departement'];
                    $nbDelit = $entry['nbDelit'];

                    if(!isset($result[$department])) {
                        $result[$department] = 0;
                    }

                    $result[$department] += $nbDelit;
                }

                // Trier les départements par le nombre total de délits de manière décroissante
                arsort($result);

                // Sélectionner les cinq premiers départements
                $topDepartments = array_slice($result, 0, 5, true);
            @endphp

            <script>
                //Les departements les plus dangeureux---------------------------------------------


                document.addEventListener('DOMContentLoaded', function() {
                    <?php
                    echo "const labelsdepartementDanger = [";
                    $counter = 0;
                    foreach ($topDepartments as $key => $value) {
                        echo "'$key'";
                        $counter++;
                        if ($counter < count($topDepartments)) {
                            echo ",";
                        }
                    }
                    echo "];";
                    ?>
                    const datadepartementDanger = {
                        labels: labelsdepartementDanger,
                        datasets: [{
                            label: 'Dataset 1',
                            <?php
                            echo "data: [";
                            $counter = 0;
                            foreach ($topDepartments as $key => $value) {
                                echo "$value";
                                $counter++;
                                if ($counter < count($topDepartments)) {
                                    echo ",";
                                }
                            }
                            echo "],";
                            ?>
                    backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 205, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(54, 162, 235, 0.5)'
                            ]
                        }]
                    };


                    const configdepartementDanger = {
                        type: 'polarArea',
                        data: datadepartementDanger,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Chart.js Polar Area Chart'
                                }
                            }
                        },
                    };


                    const monCanvasdepartementDanger= document.getElementById('departementDanger');
                    const monGraphiquedepartementDanger = new Chart(monCanvasdepartementDanger, configdepartementDanger);
                });




                // Evolution delis -------------------------------------------------------
                const dataEvolutionDelis = {
                    <?php
                    echo "labels: [";
                    $counter = 0;
                    foreach ($resultNbDelisTt as $key => $value) {
                        echo "$key";
                        $counter++;
                        if ($counter < count($top5)) {
                            echo ",";
                        }
                    }
                    echo "],";
                    ?>
                    datasets: [
                        {
                            label: 'Delis',
                            <?php
                            echo "data: [";
                            $counter = 0;
                            foreach ($resultNbDelisTt as $key => $value) {
                                echo "$value";
                                $counter++;
                                if ($counter < count($top5)) {
                                    echo ",";
                                }
                            }
                            echo "],";
                            ?>
                            borderColor: 'red', // Utilisez une couleur directe ou une fonction Utils appropriee
                            backgroundColor: 'rgba(255, 0, 0, 0.5)', // Couleur avec transparence
                            pointStyle: 'circle',
                            pointRadius: 10,
                            pointHoverRadius: 15
                        }
                    ]
                };
                const configEvolutionDelis = {
                    type: 'line',
                    data: dataEvolutionDelis, // Utilisez dataEvolutionDelis plutot que data
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                            }
                        }
                    }
                };


                // Selectionne le canvas par son ID
                const monCanvasEvolutionDelis = document.getElementById('evolutionDelis');


                // Cree le graphique avec Chart.js
                const monGraphiqueEvolutionDelis = new Chart(monCanvasEvolutionDelis, configEvolutionDelis);


                // le dognut -------------------------------------------------------
                const data = {

                    <?php
                    echo "labels: [";
                    $counter = 0;
                    foreach ($top5 as $key => $value) {
                        echo "$key";
                        $counter++;
                        if ($counter < count($top5)) {
                            echo ",";
                        }
                    }
                    echo "],";
                    ?>
                    datasets: [{
                        label: 'My First Dataset',
                        <?php
                        echo "data: [";
                        $counter = 0;
                        foreach ($top5 as $key => $value) {
                            echo "$value";
                            $counter++;
                            if ($counter < count($top5)) {
                                echo ",";
                            }
                        }
                        echo "],";
                        ?>

                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(54, 162, 135)',
                            'rgb(255, 205, 186)'
                        ],
                        hoverOffset: 4
                    }]
                };

                const config = {
                    type: 'doughnut',
                    data: data,
                };

                // Selectionne le canvas par son ID
                const monCanvas = document.getElementById('monDoughnut');

                // Cree le graphique avec Chart.js
                const monGraphique = new Chart(monCanvas, config);
            </script>

</x-app-layout>
