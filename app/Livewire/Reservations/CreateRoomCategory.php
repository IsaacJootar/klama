<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\CategoryImage;
use App\Models\Roomcategory;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\LivewireFilepond\WithFilePond;
#[title('Create Room Category')]

class CreateRoomcategory extends Component
{

    use WithFilePond; // FilePond file upload library
    public $room_category;
    public $category = '';
    public $files = []; // images

    public $details = '';
    public $wifi = '';

    public $laundry = '';
    public $lunch = '';
    public $path;
    public $breakfast = '';


    //public $modal_title = 'Create New Room Category.';
    public  $modal_flag = false;


    public function store()
    {


        $validation = $this->validate([
            'category' => ['required', 'min:4', 'unique:resv_room_categories,category'],
            'details' => ['required', 'min:20'],
            'wifi' => [],
            'laundry' => [],
            'lunch' => [],
            'breakfast' => [],

        ]);


        $validation['category']  = str::ucfirst($this->category);


        Roomcategory::create($validation);

        // handle the images

        if ($this->files) { // uploading files for daily reports may not be neccessary every day, but if files exist, inject the dependency

            foreach ($this->files as $file) {
                $this->UploadCategoryImages($file);
            }

        }



        $this->dispatch('refresh-categories');
        toastr()->info('Room  Category is created successfully');
        $this->reset();
    }


    public function UploadCategoryImages($file)
    {

        // Validation rules for the file property
        $validator = Validator::make(
            ['file' => $file], // The input data to validate
            [
                'file' => [
                    'file',
                    'max:6120', // Max 7MB
                    'mimes:jpg,jpeg,png,gif',
                    'mimetypes:image/jpeg,image/png,image/gif'

                ]
            ]
        );

        // Check if validation fails and throw an exception
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // if no errors then upload files and return the fuction to create a record in database
        $this->path = $file->store('category-images', 'public'); // default storage folder for all our room cat. Files
        return $this->createFileRecord($file);
    }


    private function createFileRecord($file) {
        $category = Roomcategory::latest()->value('category');

        return CategoryImage::create([
            'category' => $category,
            'file_name' => $file->getClientOriginalName(), // real file name
            'path' => $this->path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'random_name' => $file->hashName(), //random system generated name
            'date' => Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d'), // create a class later to accomodate other timezones
        ]);
    }


    #[On('modal-flag')] // from modal dispatch
    public function edit($id)
    {
        $this->room_category = Roomcategory::findOrFail($id);
        $this->category = $this->room_category->category;
        $this->details = $this->room_category->details;
        $this->wifi = $this->room_category->wifi;
        $this->laundry = $this->room_category->laundry;
        $this->lunch = $this->room_category->lunch;
        $this->breakfast = $this->room_category->breakfast;
        $this->modal_flag = true; // for triggering modal form status for  Update
        //$this->modal_title = 'Update Room category';
    }

    public function update()
    {
        $validation = $this->validate([
            'category' => ['required', 'min:4'],
            'details' => ['required', 'min:20'],
            'wifi' => [],
            'laundry' => [],
            'lunch' => [],
            'breakfast' => [],

        ]);



        $update = Roomcategory::findOrFail($this->room_category->id);
        $validation['category']  = str::ucfirst($this->category);

        $update->update($validation);
        
        CategoryImage::where('category', $this->category)
                ->update(['category' => $this->category]);


        $this->dispatch('refresh-categories');
        toastr()->info('Room Categories is Updated successfully');
    }

    public function exit()
    { //rest modal feilds
        $this->reset();
    }

    public function render()
    {
        return view('livewire.reservations.create-room-category')
            ->layout('layouts.reservations');
    }
}
