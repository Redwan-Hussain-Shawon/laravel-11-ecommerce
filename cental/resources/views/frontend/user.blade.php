@extends('frontend.layout.main')

<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-link {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #f8f9fa;
    color: #8800ff;
    border: 1px solid #dee2e6;
    text-decoration: none;
    border-radius: 4px;
}

.pagination-link:hover {
    background-color: #e9ecef;
    color: #6900c5;
}

.pagination-link.active {
    background-color: #8800ff;
    color: #fff;
    pointer-events: none;
}

.pagination-disabled {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #e9ecef;
    color: #6c757d;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    pointer-events: none;
}

</style>
@section('content')

    <div
        class="table-responsive container my-5"
    >
    @if($user->count()>0)
        
        <table
            class="table  table-striped"
        >
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $key => $value)
                <tr class="">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    <td>{{$value['number']}}</td>
                    <td>{{$value['address']}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="pagination-wrapper">
            @if ($user->onFirstPage())
                <span class="pagination-disabled">Previous</span>
            @else
                <a href="{{ $user->previousPageUrl() }}" class="pagination-link">Previous</a>
            @endif

            @php
                $currentPage = $user->currentPage();
                $lastPage = $user->lastPage();
                $startPage = max(1, $currentPage - 2); 
                $endPage = min($lastPage, $currentPage + 2); // End displaying 2 pages after the current page

                if ($endPage - $startPage < 4) {
                    $endPage = min($startPage + 4, $lastPage);
                }
                if ($startPage > 1) {
                    $startPage = max(1, $endPage - 4);
                }
            @endphp

            @for ($page = $startPage; $page <= $endPage; $page++)
                <a href="{{ $user->url($page) }}" class="pagination-link {{ $user->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
            @endfor

            @if ($user->hasMorePages())
                <a href="{{ $user->nextPageUrl() }}" class="pagination-link">Next</a>
            @else
                <span class="pagination-disabled">Next</span>
            @endif
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            No user available.
        </div>
        @endif

    </div>
    
@endsection