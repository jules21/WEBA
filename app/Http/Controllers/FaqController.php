<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Http\Requests\StorefaqRequest;
use App\Http\Requests\UpdatefaqRequest;
use Spatie\TranslationLoader\LanguageLine;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::query()->orderBy('id','DESC')->get();
        return view('admin.settings.faqs.index',compact('faqs'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorefaqRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorefaqRequest $request)
    {
        $faq = new Faq();


        $timestamp = now()->timestamp;
        $identifier = uniqid();
        $id = "${identifier}_${timestamp}";
        $group = "faq";

        $question = $request->question;
        $answer = $request->answer;

        $question_kn = $request->question_kn;
        $answer_kn = $request->answer_kn;

        $questionKey = "question_$id";

        LanguageLine::create(
            [
                'group' => $group,
                'key' => $questionKey,
                'text' => [
                    'kn' => $question_kn,
                    'en' => $question,
                ],
            ]
        );

        $answerKey = "answer_$id";

        LanguageLine::create(
            [
                'group' => $group,
                'key' => $answerKey,
                'text' => [
                    'kn' => $answer_kn,
                    'en' => $answer,
                ],
            ]
        );


        $faq->question="$group.$questionKey";
        $faq->answer="$group.$answerKey";
//        return $faq;
        $faq->save();
        return redirect()->back()->with('success','Faq created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefaqRequest  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatefaqRequest $request, Faq $faq)
    {

        $faq = Faq::findOrFail($request->input('FaqId'));
        $question = $request->question;
        $answer = $request->answer;

        $question_kn = $request->question_kn;
        $answer_kn = $request->answer_kn;

        $questionKey = \Str::after($faq->question, '.');
        $answerKey = \Str::after($faq->answer, '.');

        $questionLine = LanguageLine::where('key', $questionKey)->first();
        $questionLine->text = [
            'kn' => $question_kn,
            'en' => $question,
        ];

        $questionLine->save();

        $answerLine = LanguageLine::where('key', $answerKey)->first();
        $answerLine->text = [
            'kn' => $answer_kn,
            'en' => $answer,
        ];
        $answerLine->save();
        return redirect()->back()->with('success','Faq updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Faq $faq, $id)
    {
        try {
            $faq = Faq::find($id);
            $questionKey = \Str::after($faq->question, '.');
            $answerKey = \Str::after($faq->answer, '.');

            $questionLine = LanguageLine::where('key', $questionKey)->first();
            $questionLine->delete();

            $answerLine = LanguageLine::where('key', $answerKey)->first();
            $answerLine->delete();

            $faq->delete();
            return redirect()->back()->with('success','Faq deleted Successfully');
        }catch (\Exception $exception){
            info($exception);{
                return redirect()->back()->with('error','Faq can not be deleted');
            }
        }
    }
}
