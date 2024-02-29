@extends('indexing.layout.app')
@section('title', 'Jobs - JobPulse')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-2">
            <img class="img-fluid rounded img-thumbnail" src="{{asset($profile['image'])}}" alt="">
        </div>

        <div class="col-md-8 text-light">
            <h2>{{ $profile['name'] }}</h2>
            <p><strong>Paspoart:</strong>{{ $profile['Passport_id']}}</p>
            <p><strong>Phone:</strong>{{ $profile['cell_no']}}</p>
        </div>

        <div class="col-md-2 text-light">
            <a class="text-light h3 m-2" href="{{ $profile['facebook'] }}"><i class="fa-brands fa-facebook"></i></a>
            <a class="text-light h3 m-2" href="{{ $profile['linkedin'] }}"><i class="fa-brands fa-linkedin"></i></a>
            <a class="text-light h3 m-2" href="{{ $profile['github'] }}"><i class="fa-brands fa-github"></i></a>
            <a class="text-light h3 m-2" href="{{ $profile['portfolio_link'] }}"><i class="fa-solid fa-globe"></i></a>
            <p class="text-light m-2"><strong>Blood Group:</strong> {{ $profile['blood_group']}}</p>
        </div>
    </div>

    {{-- personal information --}}
    <div class="row text-light mt-5">
        <div class="col-md-8">
            <h2>Personal Information</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Father Name:</strong> {{ $profile['father_name'] }}</li>
                <li class="list-group-item mt-1"><strong>Mother Name:</strong> {{ $profile['mother_name'] }}</li>
                <li class="list-group-item mt-1"><strong>Date of Birth:</strong> {{ $profile['date_of_birth'] }}</li>
                <li class="list-group-item mt-1"><strong>Social ID:</strong> {{ $profile['Social_id'] }}</li>
                <li class="list-group-item mt-1"><strong>Emergency Contact:</strong> {{ $profile['emergency_no'] }}</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h2>Skils</h2>
            <ul class="list-group list-group-flush">
                @foreach ( $skils as $skil )
                   <li class="list-group-item mt-1"> {{ $skil['name'] }}</li>
                @endforeach

            </ul>
        </div>
    </div>

    {{-- education --}}
    <div class="row text-light mt-5">
        <h2>Education</h2>
        <table>
            <thead>
                <tr class="text-dark bg-light">
                    <th scope="col">#</th>
                    <th scope="col">Degree</th>
                    <th scope="col">Institute</th>
                    <th scope="col">Department</th>
                    <th scope="col">Result</th>
                    <th scope="col">Passing Year</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($canidate_edu as $edu)
                    <tr class="mt-2">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $edu['degree'] }}</td>
                        <td>{{ $edu['institute'] }}</td>
                        <td>{{ $edu['department'] }}</td>
                        <td>{{ $edu['result'] }}</td>
                        <td>{{ $edu['passing_year'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- experiance --}}
    <div class="row text-light mt-5">
        <h2>Experiance</h2>
        <table>
            <thead>
                <tr class="text-dark bg-light">
                    <th scope="col">#</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($jobExp as $exp)
                    <tr class="mt-2">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $exp['company_name'] }}</td>
                        <td>{{ $exp['position'] }}</td>
                        <td>{{ $exp['start_date'] }}</td>
                        <td>@if ($exp['end_date'] === null)
                                Running
                                @else {{ $exp['end_date'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- profesional traning --}}
    <div class="row text-light mt-5">
        <h2>Traning</h2>
        <table>
            <thead>
                <tr class="text-dark bg-light">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">institute</th>
                    <th scope="col">End Date</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($traning as $tra)
                    <tr class="mt-2">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $tra['training_name'] }}</td>
                        <td>{{ $tra['institute'] }}</td>
                        <td>{{ $tra['end_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endSection
