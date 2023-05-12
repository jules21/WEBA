<?php

namespace App\Http\Controllers;

use App\Models\faq;
use App\Http\Requests\StorefaqRequest;
use App\Http\Requests\UpdatefaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = faq::query()->orderBy('id','DESC')->get();
        return view('admin.settings.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorefaqRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorefaqRequest $request)
    {
        $faq = new faq();
        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->save();
        return redirect()->back()->with('success','Faq created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefaqRequest  $request
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatefaqRequest $request, faq $faq)
    {
        $faq = faq::findOrFail($request->input('FaqId'));
        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->save();
        return redirect()->back()->with('success','Faq updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(faq $faq,$id)
    {
        try {
            $faq = faq::find($id);
            $faq->delete();
            return redirect()->back()->with('success','Faq deleted Successfully');
        }catch (\Exception $exception){
            info($exception);{
                return redirect()->back()->with('error','Faq can not be deleted');
            }
        }
    }
}
