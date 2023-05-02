<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    private function diffDateTime($start_date, $end_date) {
        $diff = abs($end_date - $start_date);
        return round($diff / 86400);
    }

    public function list() {
        $items = Item::all();

        $expired = $items->filter(function($item) {
            return ($item->ds ? $item->ds : $item->dmt) < date("Y-m-d");
        });

        $nonExpired = $items->filter(function($item) {
            return ($item->ds ? $item->ds : $item->dmt) >= date("Y-m-d");
        });

        $expired->sortBy('ps');        
        $nonExpired->sortBy(function($item) {
            return $item->ds ?? $item->dmt;
        });

        foreach($items as $item) {
            $time1 = $item->dv ? strtotime($item->dv) : strtotime($item->dn);
            $time2 = $item->ds ? strtotime($item->ds) : strtotime($item->dmt);
            $difference = $this->diffDateTime($time1, $time2);
            $daysToAdd = round($difference / 2);

            $midDate = strtotime("+{$daysToAdd} days", $time1);

            $item->ps = date("Y-m-d", $midDate);
        }

        $items = $expired->merge($nonExpired);

        return view('welcome', ['items' => $items]);
    }

    private function validateData(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'dv' => 'date',
            'dn' => 'required|date',
            'dmt' => 'required|date',
            'ds' => 'date'
        ]);

        return $validateData;
    }

    public function add_item(Request $request) {
        $validateData = $this->validateData($request);

        $formSubmission = new Item();
        $formSubmission->name = $validateData['name'];
        $formSubmission->dv = $validateData['dv'];
        $formSubmission->dn = $validateData['dn'];
        $formSubmission->dmt = $validateData['dmt'];
        $formSubmission->ds = $validateData['ds'];

        $formSubmission->save();

        return redirect('/');
    }

    public function edit_item(Request $request, $id) {
        $validateData = $this->validateData($request);

        $formSubmission = Item::find($id);
        $formSubmission->name = $validateData['name'];
        $formSubmission->dv = $validateData['dv'];
        $formSubmission->dn = $validateData['dn'];
        $formSubmission->dmt = $validateData['dmt'];
        $formSubmission->ds = $validateData['ds'];

        $formSubmission->save();

        return redirect('/');
    }

    public function destroy($id) {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect("/");
    }

    public function index() {
        return view('view_add');
    }

    public function edit($id) {
        $item = Item::findOrFail($id);
        return view('view_edit', ["item" => $item]);
    }
}
