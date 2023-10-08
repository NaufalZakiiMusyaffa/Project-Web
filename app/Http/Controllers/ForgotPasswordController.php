<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\VerificationEmail;
use App\ForgotPassword;
use App\User;
use DB;
use Session;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-password.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $emailExists = User::select('id')->where('email', $request->get('email'))->first();

        if ($emailExists) {
            $verifikasiKode = strtoupper(bin2hex(random_bytes(5)) . $emailExists->id . date("His"));
            $expiredAt = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +5 hours"));

            ForgotPassword::create([
                'user_id'           =>  $emailExists->id,
                'verifikasi_kode'   =>  $verifikasiKode,
                'expired_at'        =>  $expiredAt
            ]);

            Mail::to($request->get('email'))->send(new VerificationEmail($request->get('email'), $verifikasiKode));

            // alert()->error('Kode Verifikasi sudah dikirmkan', 'Mohon periksa email anda');
            return redirect()->to("/forgot-password/{$emailExists->id}");
        } else {
            alert()->error('Email tidak ditemukan', 'Mohon periksa kembali email yang anda masukan');
            return redirect()->route('forgot-password.index');
        }
    }

    public function show($id)
    {
        $user_id = $id;
        return view('forgot-password.show', compact('user_id'));
    }

    public function check(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'verifikasi_kode' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $forgotPassword = ForgotPassword::orderBy('expired_at', 'DESC')
                            ->where('user_id', $request->get('user_id'))
                            ->where('is_used', 0)
                            ->get();

        if ($forgotPassword[0]->verifikasi_kode == $request->get('verifikasi_kode')) {
            if (date("Y-m-d H:i:s") < $forgotPassword[0]->expired_at) {
                $user_data = User::findOrFail($request->get('user_id'));
                $user_data->password = bcrypt(($request->get('password')));
                $user_data->update();

                ForgotPassword::where('id', $forgotPassword[0]->id)->update([
                    'is_used'   =>  1
                ]);

                return redirect()->to('/');
            }
        } else {
            // alert()->error('Kode Verifikasi Salah atau Sudah Expired', 'Mohon periksa kembali kode verifikasinya');
            return redirect()->to("/forgot-password/{$request->get('user_id')}");
        }
    }
}
