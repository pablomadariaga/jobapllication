<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitApplicationRequest;
use App\Mail\Application;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Update the locale session variable and the app locale
     *
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function language(string $language)
    {
        try {
            if (array_key_exists($language, config('locale.languages'))) {
                session()->put('locale', $language);
                app()->setLocale($language);
                return redirect()->back();
            }
            return redirect('/');
        } catch (\Exception $exception) {
            return redirect('/');
        }
    }

    public function index()
    {
        $companies = Company::all();
        return view('welcome', [
            'companies' => $companies
        ]);
    }

    public function application(SubmitApplicationRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);
        $company = Company::find($validated['company_id']);

        $emails = [$company->email];
        if ($company->optional_email) {
            $emails[] = $company->optional_email;
        }
        try {
            $mail = Mail::to($emails)->send(new Application($user));
        } catch (\Throwable $th) {
            // throw $th;
        }

        session(['user_id' => $user->id]);

        return redirect()->route('success');
    }

    public function success(Request $request)
    {
        $userId =  session('user_id') ?? null;
        if (!$userId) {
            return redirect()->route('index');
        }

        $user = User::findOrFail($userId);

        return view('success', [
            'user' => $user
        ]);
    }
}
