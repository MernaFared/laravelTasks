<?php

namespace App\Http\Controllers;
 use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Car;
use PhpParser\Node\Expr\Cast\String_;
use App\Traits\Common;
class CarController extends Controller
{
   use Common;
    private $columns = ['carTitle','description','published'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars=Car ::get();
        return view('cars',compact('cars'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages=[
            'carTitle.required'=>'Title is required',
            'description.required'=> 'should be text',
        ];

        $data = $request->validate([
            'carTitle'=>'required|string',
            'description'=>'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], $messages);
        
       
        // $data = $request->only($this->columns);
        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image']= $fileName;
        $data['published'] = isset($data['published'])? true : false;
        Car:: create($data);
        return 'done' ;
   
    }
    public function storeCarData(){
        return view ('add-car-form');
    }
    public function showCarData(Request $request){
        

        $msg = "car title is : ".$request->carTitle ."<br> price is : ".$request->price."<br> description is : ".$request->description ;
        return $msg;
    }

    /**
     * Display the specified resource.
     */
    public function showUpload( )
    {
       return view('uploadCar');
        //
    }


    
    public function upload(Request $request){
        
         $fileName = $this->uploadFile($request->image, 'assets/images');
        return $fileName;
 
    }

    public function show(string $id)
    {
        $car = Car ::findOrFail($id);
        return view('carDetails',compact('car'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $car = Car::findOrFail(  $id);
        return view('updateCar',compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'carTitle' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
             
        ]);
    
        // Upload the new image if provided
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->file('image'), 'assets/images');
            $data['image'] = $fileName;
        }
    
        // Modify other data as needed
    
        Car::where('id', $id)->update($data);
    
        return "Data Updated Successfully";
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {

        Car::where('id',$id)->delete();
        return redirect('showcars');
         
    }

    public function delete(string $id):RedirectResponse
    {
        Car::where('id',$id)->forceDelete();
        Car::where('id',$id)->delete();
        return redirect('showcars');
         
    }

    public function trashed( ){
        $cars = Car::onlyTrashed()->get();
        return view('trashedCar',compact(('cars')));
    }

    public function restore(String $id):RedirectResponse
    {
        Car::where('id',$id)->restore();
        return redirect('showcars');
    }
}

