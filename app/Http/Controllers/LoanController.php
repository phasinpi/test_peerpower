<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\LoanDetail;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::orderBy('created_at', 'desc')->paginate(20);
        return view('loan.index', ['loans' => $loans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $loan = Loan::create([
            'amount' => $request->input('amount'),
            'term' => $request->input('term'),
            'interest_rate' => $request->input('interest_rate'),
            'month' => $request->input('month'),
            'year' => $request->input('year')
        ]);
        $month = $request->input('month');
        $year = $request->input('year');
        $amount = $request->input('amount');
        $term = $request->input('term');
        $rate = $request->input('interest_rate') / 100;
        $pmt =  ($amount * ($rate / 12)) / (1 - (1 + ($rate / 12)) ** (-12 * $term));
        $balance = $amount;
        do {
            if ($month <= 12) {
                $month = $month;
                $year = $year;
            } else {
                $month = 1;
                $year++;
            }
            $interest = ($rate / 12) * $balance;
            $principal = $pmt - $interest;
            $amount = $balance;
            $balance = $balance - $principal;
            LoanDetail::create([
                'loan_id' => $loan->id,
                'month' => $month,
                'year' => $year,
                'amount' => $pmt,
                'principal' => $principal,
                'interest' => $interest,
                'balance' => $balance
            ]);
            $month++;
        } while ($balance > 0);
        Session::flash('message', 'The loan has been created successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('/loan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::where('id', $id)->first();
        $loanDetails = LoanDetail::where('loan_id', $loan->id)->get();
        return view('loan.show', ['loanDetails' => $loanDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::where('id', $id)->first();
        return view('loan.edit', ['loan' => $loan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::where('id', $id)->first();
        $loan->update([
            'amount' => $request->input('amount'),
            'term' => $request->input('term'),
            'interest_rate' => $request->input('interest_rate'),
            'month' => $request->input('month'),
            'year' => $request->input('year')
        ]);
        LoanDetail::where('loan_id', $loan->id)->delete();
        $month = $request->input('month');
        $year = $request->input('year');
        $amount = $request->input('amount');
        $term = $request->input('term');
        $rate = $request->input('interest_rate') / 100;
        $pmt =  ($amount * ($rate / 12)) / (1 - (1 + ($rate / 12)) ** (-12 * $term));
        $balance = $amount;
        do {
            if ($month <= 12) {
                $month = $month;
                $year = $year;
            } else {
                $month = 1;
                $year++;
            }
            $interest = ($rate / 12) * $balance;
            $principal = $pmt - $interest;
            $amount = $balance;
            $balance = $balance - $principal;
            LoanDetail::create([
                'loan_id' => $loan->id,
                'month' => $month,
                'year' => $year,
                'amount' => $pmt,
                'principal' => $principal,
                'interest' => $interest,
                'balance' => $balance
            ]);
            $month++;
        } while ($balance > 0);
        Session::flash('message', 'The loan has been updated successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('/loan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::where('id', $id)->first();
        LoanDetail::where('loan_id', $loan->id)->delete();
        $loan->delete();
        Session::flash('message', 'The loan has been deleted successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('/loan');
    }

    public function search(Request $request)
    {
        $loans = Loan::orderBy('created_at', 'asc');
        if ($request->input('minAmount') || $request->input('maxAmount')) {
            if ($request->input('maxAmount') < $request->input('minAmount')) {
                Session::flash('message', 'Max amount must be more than Min amount.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
            if ($request->input('minAmount') && $request->input('maxAmount')) {
                $minAmount = $request->input('minAmount');
                $maxAmount = $request->input('maxAmount');
                $loans = $loans->whereBetween('amount', [$minAmount, $maxAmount]);
            } else {
                Session::flash('message', 'Min amount or Max amount is empty.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
        }
        if ($request->input('minRate') && $request->input('maxRate')) {
            if ($request->input('maxRate') < $request->input('minRate')) {
                Session::flash('message', 'Max rate must be more than Min rate.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
            if ($request->input('minRate') && $request->input('maxRate')) {
                $minRate = $request->input('minRate');
                $maxRate = $request->input('maxRate');
                $loans = $loans->whereBetween('interest_rate', [$minRate, $maxRate]);
            } else {
                Session::flash('message', 'Min rate or Max rate is empty.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
        }
        if ($request->input('minTerm') && $request->input('maxTerm')) {
            if ($request->input('maxTerm') < $request->input('minTerm')) {
                Session::flash('message', 'Max term must be more than Min term.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
            if ($request->input('minTerm') && $request->input('maxTerm')) {
                $minTerm = $request->input('minTerm');
                $maxTerm = $request->input('maxTerm');
                $loans = $loans->whereBetween('term', [$minTerm, $maxTerm]);
            } else {
                Session::flash('message', 'Min term or Max term is empty.');
                Session::flash('alert-class', 'alert-success');
                return redirect('/loan');
            }
        }
        $loans = $loans->get();
        return view('loan.search', [
            'loans' => $loans,
            'minAmount' => $request->input('minAmount'),
            'maxAmount' => $request->input('maxAmount'),
            'minRate' => $request->input('minRate'),
            'maxRate' => $request->input('maxRate'),
            'minTerm' => $request->input('minTerm'),
            'maxTerm' => $request->input('maxTerm'),
        ]);
    }
}
