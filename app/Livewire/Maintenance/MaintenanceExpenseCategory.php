<?php

      namespace App\Livewire\Maintenance;
        use App\Models\MaintenanceExpCategory;
        use Livewire\Component;
        use Livewire\Attributes\Title;
        use Livewire\Attributes\Validate;
        
       #[Title('Maintenance | Make Expense Category ')]
        class MaintenanceExpenseCategory extends Component
        {
        
            public  $categories; // cat  instance
      
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
                MaintenanceExpCategory::updateOrCreate(
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
                $this->category = MaintenanceExpCategory::findOrFail($id);
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
                $category = MaintenanceExpCategory::findOrFail($id);
                $category->delete();
                toastr()->info('Expense Category is deleted successfully');
            }
        
        
        
            public function render()
            {
                $this->categories = MaintenanceExpCategory::all();
                return view('livewire.maintenance.maintenance-expense-category')->layout('layouts.maintenance');
            }
        
        
        
        }
        
                
             