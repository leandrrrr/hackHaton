<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
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
            <!-- Ajoute un canvas avec un ID pour que tu puisses le cibler -->


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






            <script>
                //Les departements les plus dangeureux---------------------------------------------


                document.addEventListener('DOMContentLoaded', function() {
                    const labelsdepartementDanger = ['Red', 'Orange', 'Yellow', 'Green', 'Blue'];
                    const datadepartementDanger = {
                        labels: labelsdepartementDanger,
                        datasets: [{
                            label: 'Dataset 1',
                            data: [10, 20, 30, 40, 50], // Exemple de données, remplacez-les par les vôtres
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
                    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
                    datasets: [
                        {
                            label: 'Dataset',
                            data: [25000, 15000, 30000, 40000, 50000, 30000], // Donnees de test
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
                    labels: [
                        'Red',
                        'Blue',
                        'Yellow',
                        'Blue2',
                        'Yellow2'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [30000, 5000, 10000,8000,7800],
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


        </div>
    </div>
</x-app-layout>
