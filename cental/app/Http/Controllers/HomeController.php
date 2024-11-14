<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function pdfGenerate()
    {
        // Define the data to be passed to the view
        $data = ['title' => 'বাংলা টাইপ করুন', 'Date' => date('m/d/Y')];
    
        $pdf = Pdf::loadView('invoice', $data);
    
        return $pdf->stream('invoice.pdf');
    }
}
