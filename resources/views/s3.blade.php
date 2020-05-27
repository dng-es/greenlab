@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">S3</div>

                <audio preload="none" controlsList="nodownload" controls style="max-width:100%;" id='player1' class="podcast-player mejs__player">
                    <source src="{{ route('s3.download',['folder' => 'podcasts', 'filename' => '1573739995.mp3']) }}" type="audio/mpeg">
                </audio>

                {{-- <img src="data:image/jpeg;base64,{{ base64_encode($fichero) }}" /> --}}
                <img class="col-3" src="{{ route('s3.download',['folder' => 'podcasts', 'filename' => '1573739871.png']) }}" />
                <img class="col-3" src="{{ route('s3.download',['folder' => 'podcasts', 'filename' => '1573726448.jpg']) }}" />
                <img class="col-3" src="{{ route('s3.download',['folder' => 'podcasts', 'filename' => '1573726373.jpg']) }}" />
                <img class="col-3" src="{{ route('s3.download',['folder' => 'podcasts', 'filename' => '1573738642.jpg']) }}" />

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form class="" method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="fileContents">Fichero:</label>
                            <input type="file" name="fileContents" id="fileContents" class="form-control" />
                            <small id="emailHelp" class="form-text text-muted">Fichero a cargar en en Amazon S3</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Cargar archivo</button>

                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
