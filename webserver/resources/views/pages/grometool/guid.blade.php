<x-app-layout background="bg-white">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        @foreach ($variables as $variable)
            <div class="mb-12">
                <!-- Table (Top Channels) -->
                {{-- <x-dashboard.dashboard-card-05 /> --}}
                <canvas id="{{ $variable }}" width="595" height="248"></canvas>
                <form class="flex items-center w-full" method="POST" action="{{ route('guid.setpoint') }}">
                    @csrf
                    <div class="relative w-full">
                        <input name="setpoint" type="number" step="0.01" id="simple-set" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Setpoint" required="">
                        <input name="guid" type="hidden" value="{{ $guid }}">
                        <input name="username" type="hidden" value="{{ $username }}">
                        <input name="variable" type="hidden" value="{{ $variable }}">
                    </div>
                    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Set
                    </button>
                </form>
            </div>
            @push('js')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script type="text/javascript">
                    // console.log();
                    var ctx = document.getElementById({{ Js::from($variable) }}).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                            datasets: [{
                                fill: true,
                                label: {{ Js::from($variable) }}.replace('_',' ').replace(/(^|\s)\S/g, function(t) { return t.toUpperCase() }),
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            @endpush
        @endforeach
    </div>
</x-app-layout>
{{-- @vite(["resources/js/bootstrap.js"]) --}}
