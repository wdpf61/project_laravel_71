<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\QuestionTemplateExport;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionImportController extends Controller
{
    public function showForm()
    {
        return view('questions.import');
    }

    public function downloadTemplate()
    {
        return Excel::download(new QuestionTemplateExport, 'question_import_sample.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:4096',
        ]);

        $import = new QuestionsImport();
        Excel::import( $import,$request->file('file'));
        // $import->import();

        // Check if there are row-level validation failures
        if ($import->failures()->isNotEmpty()) {
            return back()->with('import_failures', $import->failures());
        }

        return back()->with('success', 'All questions imported successfully!');
    }
}