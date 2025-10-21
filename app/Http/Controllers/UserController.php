<?php

namespace App\Http\Controllers;

use 
App\Models\User, 
App\Models\Department, 
App\Models\Supply, 
App\Models\IssuedSupply;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function resortStaffs(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('ext_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('stat', 'like', "%{$search}%")
                ->orWhereHas('department', function($d) use ($search) {
                    $d->where('name', 'like', "%{$search}%");
                });
            });
        }

        $users = $query->get();
        return view('Users.resortStaffs', compact('users'));
    }
    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
        }
        $users = User::findOrFail($id);
        $departments = Department::all();
        return view('Users.edit', compact('users', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'ext_name' => 'nullable|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'department_id' => 'nullable|exists:departments,id',
            'stat' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->ext_name = $request->ext_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->department_id = $request->department_id;
        $user->stat = $request->stat;

        $user->save();

        return redirect()->route('users.resortStaffs')->with('success', 'User updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => ['nullable', 'exists:departments,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'ext_name' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = User::create([
            'department_id' => $request->input('department_id'),
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'ext_name' => $request->input('ext_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.resortStaffs')->with('success', 'User created successfully.');
    }
    public function create()
    {
        $departments = Department::all();
        return view('adduser', compact('departments'));
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()
            ->route('users.resortStaffs')
            ->with('success', 'User deleted successfully.');
    }

    public function supplies(Request $request)
    {
        $query = Supply::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $supplies = $query->with(['issuedSupplies.user'])->get();

        return view('Users.supplies', compact('supplies'));
    }

    public function storeSupply(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Supply::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'date_added' => now()->toDateString(),
        ]);

        return redirect()->route('users.supplies')->with('success', 'Supply added.');
    }

    public function resortStaffsTable(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('ext_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('stat', 'like', "%{$search}%")
                ->orWhereHas('department', function($d) use ($search) {
                    $d->where('name', 'like', "%{$search}%");
                });
            });
        }

        $users = $query->get();

        return view('Users.resortStaffsTable', compact('users'));
    }
    public function issuedSupplies(Request $request)
    {
        $query = IssuedSupply::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('quantity', 'like', "%{$search}%")
                ->orWhereHas('supply', function($sq) use ($search) {
                    $sq->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function($uq) use ($search) {
                    $uq->where('full_name', 'like', "%{$search}%");
                })
                ->orWhere('date_issued', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $issuedSupplies = $query->with(['supply', 'user'])->get();

        return view('Users.issuedSupplies', compact('issuedSupplies'));
    }

    public function storeIssuance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'supply_id' => 'required|exists:supplies,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $supply = Supply::findOrFail($request->supply_id);
        $user = User::findOrFail($request->user_id);
        $qty = (int) $request->quantity;

        if ($supply->quantity < $qty) {
            return back()->withErrors(['quantity' => 'Not enough supply in inventory.']);
        }

        // Deduct inventory
        $supply->quantity = $supply->quantity - $qty;
        $supply->save();

        // Create issued supply record, include price and total
        $issued = IssuedSupply::create([
            'supply_id' => $supply->id,
            'user_id' => $user->id,
            'quantity' => $qty,
            'date_issued' => now()->toDateString(),
            'is_returned' => false,
            'price' => $supply->price,
            'total_price' => $supply->price * $qty,
        ]);

        return redirect()->route('users.issuedSupplies')->with('success', 'Supply issued.');
    }

    public function showProfile()
    {
        $user = auth()->user();

        // eager load issued supplies with the related supply model
        $issuedSupplies = IssuedSupply::with('supply')
            ->where('user_id', $user->id)
            ->get();

        return view('profile.profile', compact('user', 'issuedSupplies'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'last_name'     => 'required|string|max:255',
            'ext_name'      => 'nullable|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $photoPath;
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    public function editProfile()
    {
        return view('profile.edit');
    }
    public function issuance()
    {
        return view('Users.issuance');
    }
    public function addSupplies()
    {
        return view('Users.addSupplies');
    }


}
