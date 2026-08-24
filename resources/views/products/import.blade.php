@extends('layouts.backend.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Import Porduct</h4>
        </div>
        <div class="card-body">

            <form action="{{ url('product/import') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="mb-3 from-group">

                    <label>Product File xlsx|csv|xls</label>

                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">

                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <button class="btn btn-primary">
                    Import Product
                </button>

            </form>
        </div>
    </div>
@endsection
