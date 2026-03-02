<?php

namespace App\Livewire\Logistics;

use Illuminate\Support\Facades\Auth;
use App\Models\HotelIncome;
use App\Models\LogisticsIncItem;
use App\Models\LogisticsIncCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Title('Logistics | Record Income ')]
class LogisticsRecordIncome extends Component
{

    public  $incomes; // income  instance

    #[Validate('required|min:3')]
    public $modalOpen = true;  // Controls modal closing
    public $income = '';
    public $totalAmount = 0;  
    public $list;
    public $lists;
    public $income_code = '';
    public $income_title;
    public $income_date;
    public $section  = 'Logistics';
    public $category_id;
    public $item_id;
    public $amount;
    public $note;
    public $income_id; // for edit case (optional)
    public $modal_title = 'Make an income';
    public  $modal_flag = false; // event flag for edit


    public function save()
    {
        try {
            $this->validate([
                'income_title'  => 'required|string|unique:hotel_income,income_title',
                'income_date'   => 'required|date',
                'category_id' => 'required',
                'item_id' => 'required',
                'amount' => 'required|numeric|min:0',
                'note' => 'nullable|string',
            ]);

                $this->income_code = substr(md5(mt_rand()), 0, 10); // random 10digit


              
            // Create a new HotelIncome record
            HotelIncome::create([
                'category_id' => $this->category_id,
                'item_id' => $this->item_id,
                'user_id' => Auth::user()->id, // Auth User ID
                'amount' => $this->amount,
                'note' => $this->note,
                'section' => $this->section,
                'income_code' => $this->income_code,
                'income_title' => $this->income_title,
                'income_date' => $this->income_date,
            ]);

            // Format amount to 2 decimal places
            $decimalAmount = number_format((float) $this->amount, 2, '.', ',');

            // Get the item name from the LogisticsIncItem table
            $item = LogisticsIncItem::where('id', $this->item_id)->value('item');

            // Display a success message
            toastr()->info("$item for $decimalAmount Has Been added to income Successfully.");

            // Reset form fields after successful creation
            $this->reset();
        } catch (ValidationException $e) {
            // Display an error message if validation fails
            toastr()->error('There was an error with your input.');

            // Optionally reset form fields in case of error
            $this->reset();
        }
    }




    public function incomeList($id) // income ID
    {
        $this->list = HotelIncome::find($id); // Get the main income id

        // Get all incomes that share the same income_code
        $this->lists = HotelIncome::where('income_code', $this->list->income_code)->get();
        $this->totalAmount = $this->lists->sum('amount');

        $this->modal_title = 'income Details';
    }



///close income- this stops the creating income to add to list//
public function closeincome($incomeCode)
{
    HotelIncome::where('income_code', $incomeCode)
        ->update([
            'list_flag' => 1,
        ]);

    toastr()->info('income List is closed successfully.');

    $this->modalOpen = true;
}




   public function destroy($id)
{
    // find the one record to get its code 
    $income = HotelIncome::findOrFail($id);
    $income->delete();
       toastr()->info('Income Record is deleted successfully.');
   
}





    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()

    {
        $this->incomes = HotelIncome::where('section', $this->section)
            ->orderBy('id', 'desc')
            ->get();
        $items = LogisticsIncItem::orderBy("id", "desc")->get();
        $categories = LogisticsIncCategory::orderBy("id", "desc")->get();

        return view('livewire.logistics.logistics-record-income', [
            'items' => $items,
            'categories' => $categories,
        ])->layout('layouts.logistics');
    }
}
