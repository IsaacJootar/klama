<?php

namespace App\Livewire\General;

use Illuminate\Support\Facades\Auth;
use App\Models\HotelExpense;
use App\Models\GeneralExpItem;
use App\Models\GeneralExpCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('General Manager | General Make Expenses ')]
class GeneralMakeExpense extends Component
{

    public  $expenses; // expense  instance

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
    public $section  = 'General';
    public $category_id;
    public $item_id;
    public $amount;
    public $note;
    public $expense_id; // for edit case (optional)
    public $modal_title = 'Make an Expense';
    public  $modal_flag = false; // event flag for edit


    public function save()
    {
        try {
            $this->validate([
                'expense_title'  => 'required|string|unique:hotel_expenses,expense_title',
                'expense_date'   => 'required|date',
                'category_id' => 'required',
                'item_id' => 'required',
                'amount' => 'required|numeric|min:0',
                'note' => 'nullable|string',
            ]);

            // Check if there's an existing expense record with list_flag = 0 and same section
            $existing = HotelExpense::where('list_flag', 0)
                ->where('section', $this->section)
                ->where('user_id', Auth::user()->id) // Limit this list to user also
                ->first();

            if ($existing) {
                // If a matching record is found, use the existing expense_code and expense_title
                $this->expense_code = $existing->expense_code;
                $this->expense_title = $existing->expense_title; // Use the same expense title also 
            } else {
                // If no record is found, use the form's expense_code and expense_title
                // create a simple code to group expense list 
                $this->expense_code = substr(md5(mt_rand()), 0, 10); // random 10digit


                $this->expense_title = $this->expense_title; // Keep the form value
            }

            // Create a new HotelExpense record
            HotelExpense::create([
                'category_id' => $this->category_id,
                'item_id' => $this->item_id,
                'user_id' => Auth::user()->id, // Auth User ID
                'amount' => $this->amount,
                'note' => $this->note,
                'section' => $this->section,
                'expense_code' => $this->expense_code,
                'expense_title' => $this->expense_title,
                'expense_date' => $this->expense_date,
                'list_flag' => $this->list_flag,  // Default is 0
            ]);

            // Format amount to 2 decimal places
            $decimalAmount = number_format((float) $this->amount, 2, '.', ',');

            // Get the item name from the GeneralExpItem table
            $item = GeneralExpItem::where('id', $this->item_id)->value('item');

            // Display a success message
            toastr()->info("$item for $decimalAmount Has Been added to expense list Successfully.");

            // Reset form fields after successful creation
            $this->reset();
        } catch (ValidationException $e) {
            // Display an error message if validation fails
            toastr()->error('There was an error with your input.');

            // Optionally reset form fields in case of error
            $this->reset();
        }
    }




    public function expenseList($id) // expense ID
    {
        $this->list = HotelExpense::find($id); // Get the main expense id

        // Get all expenses that share the same expense_code
        $this->lists = HotelExpense::where('expense_code', $this->list->expense_code)->get();
        $this->totalAmount = $this->lists->sum('amount');

        $this->modal_title = 'Expense Details';
    }



///close expense- this stops the creating expense to add to list//
public function closeExpense($expenseCode)
{
    HotelExpense::where('expense_code', $expenseCode)
        ->update([
            'list_flag' => 1,
        ]);

    toastr()->info('Expense List is closed successfully.');

    $this->modalOpen = true;
}




   public function destroy($id)
{
    // find the one record to get its code 
    $expense = HotelExpense::findOrFail($id);
    $code = $expense->expense_code;

    HotelExpense::where('expense_code', $code)->delete();

    // 3) notify the user
    toastr()->info('All expenses with code ' . $code . ' have been deleted successfully.');
}


 



public function removeExpense($expenseId)
{
    $expense = HotelExpense::find($expenseId);

    if ($expense) {
        $expense->delete();
       toastr()->info('Expense deleted successfully.');
    
    $this->lists =  HotelExpense::where('section', $this->section)->get(); // Dont load all section expenses for the modal view
    
    
$this->totalAmount = $this->lists->sum('amount');
        // Keep the modal open after deletion
        $this->modalOpen = true;
    }
}




    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()

    {
        $this->expenses = HotelExpense::where('section', $this->section)
            ->orderBy('id', 'desc')
            ->get();
        $items = GeneralExpItem::orderBy("id", "desc")->get();
        $categories = GeneralExpCategory::orderBy("id", "desc")->get();

        return view('livewire.general.general-make-expense', [
            'items' => $items,
            'categories' => $categories,
        ])->layout('layouts.general');
    }
}
