<?php

namespace App\Livewire\Fnb;

use Illuminate\Support\Facades\Auth;
use App\Models\HotelExpense;
use App\Models\FnbExpItem;
use App\Models\FnbExpCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Carbon\Carbon;

#[Title('Food & Beverage | Make Expenses ')]
class FnbMakeExpense extends Component
{
    public $expenses; // expense instance

    #[Validate('required|min:3')]
    public $modalOpen = true;  // Controls modal closing
    public $expense = '';
    public $totalAmount = 0;  
    public $list;
    public $lists;
    public $expense_code = '';
    public $expense_title;
    public $expense_date;
    public $list_flag = 0; // default for expense list 
    public $section = 'Kitchen_And_Restaurant'; // I probably shouldnt hard code this
    public $category_id;
    public $item_id;
    public $amount;
    public $note;
    public $expense_id; // for edit case (optional)
    public $modal_title = 'Make an Expense';
    public $modal_flag = false; // event flag for edit

    // Properties for expense record report
    public $expenseData = [];
    public $expenseFromDate = '';
    public $expenseToDate = '';

    public function mount()
    {
        // Existing initialization
        $this->expenses = HotelExpense::where('section', $this->section)
            ->orderBy('id', 'desc')
            ->get();

        // Initialize expense report data
        $this->expenseFromDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->expenseToDate = Carbon::now()->format('Y-m-d');
        $this->refreshExpenseData();
    }

    public function save()
    {
        try {
            $this->validate([
                'expense_title' => 'required|string',
                'expense_date' => 'required|date',
                'category_id' => 'required',
                'item_id' => 'required',
                'amount' => 'required|numeric|min:0',
                'note' => 'nullable|string',
            ]);

            $existing = HotelExpense::where('list_flag', 0)
                ->where('section', $this->section)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($existing) {
                $this->expense_code = $existing->expense_code;
                $this->expense_title = $existing->expense_title;
            } else {
                $this->expense_code = substr(md5(mt_rand()), 0, 10);
                $this->expense_title = $this->expense_title;
            }

            HotelExpense::create([
                'category_id' => $this->category_id,
                'item_id' => $this->item_id,
                'user_id' => Auth::user()->id,
                'amount' => $this->amount,
                'note' => $this->note,
                'section' => $this->section,
                'expense_code' => $this->expense_code,
                'expense_title' => $this->expense_title,
                'expense_date' => $this->expense_date,
                'list_flag' => $this->list_flag,
            ]);

            $decimalAmount = number_format((float) $this->amount, 2, '.', ',');
            $item = FnbExpItem::where('id', $this->item_id)->value('item');
            toastr()->info("$item of $decimalAmount Has Been added to $this->expense_title expense list Successfully.");
            $this->reset(['category_id', 'item_id', 'amount', 'note']);
        } catch (ValidationException $e) {
            toastr()->error('There was an error with your input.');
            $this->reset();
        }
    }

    public function expenseList($id)
    {
        $this->list = HotelExpense::find($id);
        $this->lists = HotelExpense::where('expense_code', $this->list->expense_code)->get();
        $this->totalAmount = $this->lists->sum('amount');
        $this->modal_title = 'Expense Details';
    }

    public function closeExpense($expenseCode)
    {
        HotelExpense::where('expense_code', $expenseCode)
            ->update(['list_flag' => 1]);
        toastr()->info('Expense List is closed successfully.');
        $this->modalOpen = true;
    }

    public function destroy($id)
    {    /*
        $expense = HotelExpense::findOrFail($id);
        $code = $expense->expense_code;
       
        HotelExpense::where('expense_code', $code)->delete();
        toastr()->info('All expenses with code ' . $code . ' have been deleted successfully.');
        */
         toastr()->error('Deleting already made expenses is disabled at the momment');
    }

    public function removeExpense($expenseId)
    {
        $expense = HotelExpense::find($expenseId);
        if ($expense) {
            $expense->delete();
            toastr()->info('Expense item is removed successfully.');
            $this->lists = HotelExpense::where('expense_code', $this->list->expense_code)->get();
            $this->totalAmount = $this->lists->sum('amount');
            $this->modalOpen = true;
        }
    }

    public function exit()
    {
        $this->reset();
    }

    // Expense record report methods
    public function refreshExpenseData()
    {
        $query = HotelExpense::where('user_id', Auth::id())
                            ->where('section', $this->section)
                            ->orderBy('created_at', 'desc');

        if (!empty($this->expenseFromDate)) {
            $query->whereDate('expense_date', '>=', $this->expenseFromDate);
        }

        if (!empty($this->expenseToDate)) {
            $query->whereDate('expense_date', '<=', $this->expenseToDate);
        }

        $this->expenseData = $query->get();
    }

    public function updatedExpenseFromDate()
    {
        $this->refreshExpenseData();
    }

    public function updatedExpenseToDate()
    {
        $this->refreshExpenseData();
    }

    public function render()
    {
        $this->expenses = HotelExpense::where('section', $this->section)
            ->orderBy('id', 'desc')
            ->get();
        $items = FnbExpItem::orderBy("id", "desc")->get();
        $categories = FnbExpCategory::orderBy("id", "desc")->get();

        return view('livewire.fnb.fnb-make-expense', [
            'items' => $items,
            'categories' => $categories,
        ])->layout('layouts.fnb');
    }
}