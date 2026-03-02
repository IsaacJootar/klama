<?php

      namespace App\Livewire\Reservations;
        use App\Models\ReservationsIncCategory;
        use Livewire\Component;
        use Livewire\Attributes\Title;
        use Livewire\Attributes\Validate;
        
        
         #[Title('Reservations | Make Income Category ')]
        class ReservationsIncomeCategory extends Component
        {
        
            public  $categories; // fleet  instance
      
            #[Validate('required|min:3')]
            public $category = '';
        
            public $modal_title = 'Add New income Category.';
        
            public  $modal_flag = false; // event flag for edit
            public $category_id; //create | update (modal flag)
        
        
        
        
            public function save()
            {
                
                try {
               $this->validate();// validate and then save
            } catch (ValidationException $e) {
                 $this->reset();
            }
                ReservationsIncCategory::updateOrCreate(
                ['id' =>$this->category_id],
                    [
                        'category'=>$this->category,
                    ]
        
                );
        
                toastr()->info($this->category_id ? 'income category  Has Been Updated Successfuly' : 'income category  Has Been Added Successfuly' );
                //$this->dispatch('category-saved');
                $this->reset();
            }
            public function edit($id)
            {
                $this->category = ReservationsIncCategory::findOrFail($id);
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
                $category = ReservationsIncCategory::findOrFail($id);
                $category->delete();
                toastr()->info('Income Category is deleted successfully');
            }
        
        
        
            public function render()
            {
                $this->categories = ReservationsIncCategory::all();
                return view('livewire.reservations.reservations-income-category')->layout('layouts.reservations');
            }
        
        
        
        }
        
                
             