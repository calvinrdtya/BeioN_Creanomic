<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Statickidz\GoogleTranslate;

class TranslationController extends Controller
{
    public function showForm()
    {
        $title = 'Terjemahkan';
        return view('front.translate', compact('title'));
    }

    public function translateAsync(Request $request)
    {
        $request->validate([
            'source_language' => 'required|string',
            'target_language' => 'required|string',
            'text' => 'required|string',
        ]);

        $source = $request->input('source_language');
        $target = $request->input('target_language');
        $text = $request->input('text');

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);

        return response()->json(['result' => $result]);
    }
}
