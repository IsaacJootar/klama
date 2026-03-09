<?php

      namespace App\Livewire\Logistics;
        use App\Models\LogisticsExpCategory;
        use Livewire\Component;
        use Livewire\Attributes\Title;
        use Livewire\Attributes\Validate;
        
        
       #[Title('Logistics | Make Expense Category ')]
        class LogisticsExpenseCategory extends Component
        {
        
            public  $categories; // fleet  instance
      
            #[Validate('required|min:3')]
            public $category = '';
        
            public $modal_title = 'Add New Expense Category.';
        
            public  $modal_flag = false; // event flag for edit
            public $category_id; //create | update (modal flag)
        
        
        
        
            public function save()
            {
                
                try {
               $this->validate();// validate and then save
            } catch (ValidationException $e) {
                 $this->reset();
            }
                LogisticsExpCategory::updateOrCreate(
                ['id' =>$this->category_id],
                    [
                        'category'=>$this->category,
                    ]
        
                );
        
                toastr()->info($this->category_id ? 'Expense category  Has Been Updated Successfuly' : 'Expense category  Has Been Added Successfuly' );
                //$this->dispatch('category-saved');
                $this->reset();
            }
            public function edit($id)
            {
                $this->category = LogisticsExpCategory::findOrFail($id);
                $this->category_id = $this->category->id;
                $this->category = $this->category->category;
                $this->modal_flag = true;
                $this->modal_title = 'Update category';
            }
        
            public function exit()
            { //rest modal feilds
                $this->reset();
            }
        
            public function destroy($id)
            {
                $category = LogisticsExpCategory::findOrFail($id);
                $category->delete();
                toastr()->info('Expense Category is deleted successfully');
            }
        
        
        
            public function render()
            {
                $this->categories = LogisticsExpCategory::all();
                return view('livewire.logistics.logistics-expense-category')->layout('layouts.logistics');
            }
        
        
        
        }
        
                
             