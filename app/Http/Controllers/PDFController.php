<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templates;
use App\Models\Documents;
use App\Models\Document_values;

use App\Console\StringConvert;

use PDF;


class PDFController extends Controller
{
    public function generatePDFExample()
    {
        $data = ['title' => 'Welcome to Laravel PDF Tutorial'];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('laravel_pdf.pdf');
    }

    public function generatePDF(Request $request){
        
        $template = Templates::where('id','=',$request->template_id)->first();

        $document = new Documents();
        $document->generated_content = $template->content;
        $document->type_download = $request->type_download;
        $document->download = $request->download;
        $document->state = $request->state;
        $document->user_created = $request->user_created;
        $document->template_id = $request->template_id;
        $document->save();

        foreach($request->parametros as $param){
            $document_val = new Document_values();
            $document_val->document_id = $document->id;
            $document_val->parameter_name = $param['parameter_name'];
            $document_val->parameter_value = $param['parameter_value'];
            $document_val->save();
        }

        $document_values = Document_values::where('document_id','=',$document->id)->get();

        $originalText = $template->content;
        $patterns=[];
        $replacements=[];
        foreach ($document_values as $value) {
            array_push($patterns,$value->parameter_name);
            array_push($replacements,$value->parameter_value);
        }
        $html = StringConvert::replaceStrings($originalText, $patterns, $replacements);

        // Generar el PDF usando el HTML proporcionado
        $pdf = PDF::loadHTML($html);

        $document->generated_content = $html;
        $document->save();

        // Devolver el PDF como respuesta
        return $pdf->download($document->download);
    }

    public function getPdf($document_id){
        $document = Documents::where('id','=',$document_id)->first();

        $document_values = Document_values::where('document_id','=',$document->id)->get();

        $originalText = $document->generated_content;
        $patterns=[];
        $replacements=[];
        foreach ($document_values as $value) {
            array_push($patterns,$value->parameter_name);
            array_push($replacements,$value->parameter_value);
        }
        $html = StringConvert::replaceStrings($originalText, $patterns, $replacements);

        // Generar el PDF usando el HTML proporcionado
        $pdf = PDF::loadHTML($html);

        // Devolver el PDF como respuesta
        return $pdf->download($document->download);
    }


    
}
