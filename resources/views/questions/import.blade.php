<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 700px;">
    <h3>Bulk Import Questions</h3>
    <p class="text-muted">Upload your Excel file to import questions and options directly into the database.</p>
    
    <div class="mb-3">
        <a href="{{ route('questions.template') }}" class="btn btn-outline-secondary btn-sm">
            📥 Download Sample Excel Template
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- File Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Detailed Excel Row Failures Display -->
    @if(session()->has('import_failures'))
        <div class="alert alert-warning">
            <h5>Import completed with errors in some rows:</h5>
            <table class="table table-sm table-bordered mt-2 bg-white">
                <thead>
                    <tr>
                        <th>Row #</th>
                        <th>Field</th>
                        <th>Error Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('import_failures') as $failure)
                        <tr>
                            <td>Row {{ $failure->row() }}</td>
                            <td><code>{{ $failure->attribute() }}</code></td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($failure->errors() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Import Form -->
    <form action="{{ route('questions.import.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label font-weight-bold">Select Excel File (.xlsx, .csv)</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Upload and Import</button>
    </form>
</div>
</body>
</html>