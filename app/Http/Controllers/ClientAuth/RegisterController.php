<?php

namespace App\Http\Controllers\ClientAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterClientRequest;
use App\Models\Client;
use App\Models\DocumentType;
use App\Models\LegalType;
use App\Models\Province;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected string $redirectTo = '/client/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $request = new RegisterClientRequest();
        return Validator::make($data,$request->rules(),$request->messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Client
     */
    protected function create(array $data)
    {
        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'legal_type_id' => $data['legal_type_id'],
            'document_type_id' => $data['document_type_id'],
            'doc_number' => $data['doc_number'],
            'phone' => $data['phone'],
            'province_id' => $data['province_id'],
            'district_id' => $data['district_id'],
            'sector_id' => $data['sector_id'],
            'cell_id' => $data['cell_id'],
            'village_id' => $data['village_id'],

        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return Application|Factory|View
     */
    public function showRegistrationForm()
    {
        return view('client.auth.register',
            [
                'legalTypes' => LegalType::all(),
                'provinces' => Province::all(),
                'idTypes' => DocumentType::query()->get(),
            ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('client');
    }

//    public function register(RegisterClientRequest $request)
//    {
//        $this->validator($request->all())->validate();
//
//        event(new Registered($user = $this->create($request->all())));
//
//        return redirect($this->redirectPath())->with('success', 'Your account has been created successfully! please login');
//    }
//    protected function registered()
//    {
//        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
//    }
}
