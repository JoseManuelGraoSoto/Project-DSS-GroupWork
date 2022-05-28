<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll()
    {
        $transactions = Transaction::paginate(7);
        return view('admin.transaction', ['transactions' => $transactions]);
    }

    public function extraerMes($mes)
    {
        switch ($mes) {
            case 'Enero':
                return '01';
            case 'Febrero':
                return '02';
            case 'Marzo':
                return '03';
            case 'Abril':
                return '04';
            case 'Mayo':
                return '05';
            case 'Junio':
                return '06';
            case 'Julio':
                return '07';
            case 'Agosto':
                return '08';
            case 'Septiembre':
                return '09';
            case 'Octubre':
                return '10';
            case 'Noviembre':
                return '11';
            case 'Diciembre':
                return '12';
        }
    }

    public function search(Request $request)
    {
        $descendente = $request->has('order');
        $fecha = $request->input('datepicker');
        $dia = '';
        $mes = '';
        $anyo = '';
        if ($fecha !== null) {
            $j = 0;
            for ($j = 0; $j < strlen($fecha); $j++) {
                if ($fecha[$j] === ' ') {
                    $j++;
                    break;
                }
            }
            $dia = $fecha[$j] . $fecha[$j + 1];
            $j += 3;
            $mes = '';
            for ($j; $j < strlen($fecha); $j++) {
                if ($fecha[$j] === ' ') {
                    $j++;
                    break;
                } else {
                    $mes .= $fecha[$j];
                }
            }
            $mes = $this->extraerMes($mes);
            $anyo = $fecha[$j] . $fecha[$j + 1] . $fecha[$j + 2] . $fecha[$j + 3];

            $fecha = $anyo . '-' . $mes . '-' . $dia;
        }

        $types = array('reader', 'author', 'moderator');
        if ($request->has('readerCheckbox') || $request->has('authorCheckbox') || $request->has('moderatorCheckbox')) {
            $types = array();
        }
        if ($request->has('readerCheckbox')) {
            $types[] = 'reader';
        }
        if ($request->has('authorCheckbox')) {
            $types[] = 'author';
        }
        if ($request->has('moderatorCheckbox')) {
            $types[] = 'moderator';
        }

        $email = $request->input('email');

        $transactions = null;
        if ($email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            }
        } elseif ($email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {

                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('transactions.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                } else {
                    $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['transactions.id', 'transactions.price', 'transactions.concept', 'transactions.created_at', 'users.email', 'users.type'])->withQueryString();
                }
            }
        }

        return view('admin.transaction', compact('transactions'));
    }

    //Devuelve el formulario de borrado de transaction pasándole como parámetro los transaction
    public function deletetransactionFormulary()
    {
        $valo = transaction::all();
        return view('deletetransactions', ['comment' => $valo]);
    }

    public function delete(Request $request)
    {
        $transactions = json_decode($request->input('transactions'));

        foreach ($transactions as $id) {
            $transaction = transaction::find($id);
            $transaction->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([TransactionController::class, 'search'])->withInput();
    }
}
