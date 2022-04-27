<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return void
     */
    public function index()
    {
        return view('admin.register');
    }

    /**
     * @return void
     */
    public function register(Request $request)
    {
        /* ONLY discrimina apenas os dados que quero receber do request */
        $data = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );

        /* Acionando a função validadtor que valida os dados enviados pelo formulário para o request */
        $validator = $this->validator($data);

        /* Testando se o validator encontrou erros e retornando através do withErrors
        withInputs tras os dados pré preenchidos devolta ao formulário em caso de falha */
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        /* Enviando para a função create os dados recebidos do formulário para inserção no DB e já autenticando
        o usuário com o Auth e redirecionando para o dashboard */
        $user = $this->create($data);


        if ($user) {
            Auth::login($user);
        }
        return redirect()->route('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
