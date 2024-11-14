<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'gender' => 'required|in:male,female,other',
            'skill' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

          Register::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'skill' => $request->skill,
            'address' => $request->address,
        ]);
       
        return redirect()->route('register.form')->with('success', 'User registered successfully!');
    }

    public function get()
    {
        $us = Register::all();  // Fetch all users
        return view('getuser', compact('us'));
    }

    public function edit($id)
  {
    $user = Register::find($id);
    return view('view_edit', compact('user'));
  }

  public function update(Request $request, $id)
  {
   
      // Find the user by ID
      $user = Register::findOrFail($id);
      
      // Validate the incoming request data
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
          'gender' => 'required|in:male,female,other',
          'skill' => 'nullable|string|max:255',
          'address' => 'nullable|string|max:255',
      ]);
      
      // Update user data
      $user->update($request->all());
  
      return response()->json(['message' => 'User updated successfully']);
  }
  
}
