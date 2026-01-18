@extends('admin.layouts.master')

@section('title')
    Dashboard - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Dashboard</h4>
@endsection

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1em;
        }

        .controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .year-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .year-filter label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        select {
            padding: 10px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 16px;
            background: white;
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        select:hover {
            border-color: #667eea;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #3d9b06, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            opacity: 0.9;
            color: #fff;
            font-size: 15px;
        }

        .stat-card .value {
            font-size: 2em;
            font-weight: bold;
        }

        .chart-container {
            position: relative;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .chart-wrapper {
            position: relative;
            height: 400px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header h1 {
                font-size: 2em;
            }

            .controls {
                flex-direction: column;
                gap: 15px;
            }

            .chart-wrapper {
                height: 300px;
            }
        }
    </style>


@endsection
@push('stackedScripts')

@endpush
