<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('branch')->get();
        return view('pages.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = \App\Models\Branch::all();
        return view('pages.users-create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'branch_id' => 'nullable|exists:branch,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'branch_id' => $validatedData['branch_id'] ?? null,
                'role' => $request->input('role', 'employee'),
                'status' => (bool)(int)$request->input('status', 1),
            ];

            // Procesar la foto si se ha subido una
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                try {
                    // Asegurar que la carpeta exista
                    $uploadPath = public_path('uploads/users');
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                    
                    $photo = $request->file('photo');
                    $filename = time() . '.' . $photo->getClientOriginalExtension();
                    $photo->move($uploadPath, $filename);
                    $userData['photo'] = '/uploads/users/' . $filename;
                } catch (\Exception $e) {
                    // Si hay un error al procesar la foto, usar avatar generado
                    \Log::error('Error al procesar la foto: ' . $e->getMessage());
                    $userData['photo'] = 'https://ui-avatars.com/api/?name=' . urlencode($validatedData['name']) . '&background=random&color=fff&size=128';
                    session()->flash('warning', 'No se pudo procesar la imagen. Se usará un avatar generado automáticamente.');
                }
            } else {
                // Usar avatar generado automáticamente si no se sube ninguna foto
                $userData['photo'] = 'https://ui-avatars.com/api/?name=' . urlencode($validatedData['name']) . '&background=random&color=fff&size=128';
            }

            $user = User::create($userData);

            // Usamos flash para asegurarnos que el mensaje se mantenga después de una redirección
            session()->flash('success', 'Usuario creado exitosamente.');
            return redirect()->route('users.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Manejar específicamente el error de email duplicado con un mensaje más amigable
            if (isset($e->validator->failed()['email']['Unique'])) {
                $branches = \App\Models\Branch::all();
                // Evitar almacenar el objeto UploadedFile en la sesión
                $oldInput = $request->except(['password', 'photo']);
                session()->flashInput($oldInput);
                
                return view('pages.users-create', compact('branches'))
                    ->withErrors(['email' => 'Este correo electrónico ya está registrado. Por favor, utilice otro.']);
            }
            
            // Para otros errores de validación, los mostramos en la misma página
            $branches = \App\Models\Branch::all();
            // Evitar almacenar el objeto UploadedFile en la sesión
            $oldInput = $request->except(['password', 'photo']);
            session()->flashInput($oldInput);
            
            return view('pages.users-create', compact('branches'))
                ->withErrors($e->validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('branch')->findOrFail($id);
        return view('pages.users-show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $branches = \App\Models\Branch::all();
        return view('pages.users-edit', compact('user', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $branches = \App\Models\Branch::all();

        try {
            // Verificar si el email ha cambiado
            $emailRule = 'required|string|email|max:255';
            if ($request->email != $user->email) {
                $emailRule .= '|unique:users,email';
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => $emailRule,
                'password' => 'nullable|string|min:8',
                'branch_id' => 'nullable|exists:branch,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Verificar si algún dato ha cambiado
            $hasChanges = false;
            
            $userData = [];
            
            // Verificar nombre
            if ($validatedData['name'] != $user->name) {
                $userData['name'] = $validatedData['name'];
                $hasChanges = true;
            }
            
            // Verificar email
            if ($validatedData['email'] != $user->email) {
                $userData['email'] = $validatedData['email'];
                $hasChanges = true;
            }
            
            // Verificar sucursal
            $branchId = $validatedData['branch_id'] ?? null;
            if ($branchId != $user->branch_id) {
                $userData['branch_id'] = $branchId;
                $hasChanges = true;
            }
            
            // Verificar rol
            $role = $request->input('role', 'employee');
            if ($role != $user->role) {
                $userData['role'] = $role;
                $hasChanges = true;
            }
            
            // Verificar status - comprobamos el valor enviado directamente
            $status = (bool)(int)$request->input('status', 0); // Convertimos a entero y luego a booleano
            if ($status !== $user->status) {
                $userData['status'] = $status;
                $hasChanges = true;
            }

            // Solo actualiza la contraseña si se proporcionó una nueva
            if (!empty($validatedData['password']) && $validatedData['password'] != 'null') {
                $userData['password'] = bcrypt($validatedData['password']);
                $hasChanges = true;
            }

            // Procesar la foto si se ha subido una nueva
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $hasChanges = true;
                
                // Eliminar la foto anterior si existe y no es un avatar generado
                if ($user->photo && !str_contains($user->photo, 'ui-avatars.com')) {
                    $oldPhotoPath = public_path(ltrim($user->photo, '/'));
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                try {
                    // Asegurar que la carpeta exista
                    $uploadPath = public_path('uploads/users');
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    // Guardar la nueva foto
                    $photo = $request->file('photo');
                    $filename = time() . '.' . $photo->getClientOriginalExtension();
                    $photo->move($uploadPath, $filename);
                    $userData['photo'] = '/uploads/users/' . $filename;
                } catch (\Exception $e) {
                    // Si hay un error al procesar la foto, registrarlo pero continuar con otras actualizaciones
                    \Log::error('Error al procesar la foto: ' . $e->getMessage());
                    session()->flash('warning', 'No se pudo procesar la imagen. Los demás datos fueron actualizados.');
                }
            }

            // Solo actualiza si hay cambios
            if ($hasChanges) {
                $user->update($userData);
                // Usamos el flash en lugar de with() para asegurar que el mensaje se mantenga después de una redirección
                session()->flash('success', 'Usuario actualizado exitosamente.');
                return redirect()->route('users.index');
            } else {
                // Usar flash en lugar de with() para asegurar que el mensaje aparezca
                session()->flash('info', 'No se detectaron cambios en el usuario.');
                return view('pages.users-edit', compact('user', 'branches'));
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si hay un error de validación con el email duplicado
            if (isset($e->validator->failed()['email']['Unique'])) {
                // Evitar almacenar el objeto UploadedFile en la sesión
                $oldInput = $request->except(['password', 'photo']);
                session()->flashInput($oldInput);
                
                return view('pages.users-edit', compact('user', 'branches'))
                    ->withErrors(['email' => 'Este correo electrónico ya está registrado. Por favor, utilice otro.']);
            }
            
            // Para otros errores de validación, los mostramos en la misma página
            // Evitar almacenar el objeto UploadedFile en la sesión
            $oldInput = $request->except(['password', 'photo']);
            session()->flashInput($oldInput);
            
            return view('pages.users-edit', compact('user', 'branches'))
                ->withErrors($e->validator);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            session()->flash('error', 'Ha ocurrido un error al actualizar el usuario: ' . $e->getMessage());
            return redirect()->route('users.edit', $id);
        }
    }

    /**
     * Update the user status.
     */
    public function updateStatus(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Verificar si el usuario está intentando cambiar su propio estado
            if (auth()->id() == $id) {
                session()->flash('error', 'No puedes cambiar tu propio estado mientras estás usando el sistema.');
                return redirect()->route('users.index');
            }
            
            $status = (bool)(int)$request->input('status', !$user->status);
            
            $user->update([
                'status' => $status
            ]);
            
            $statusText = $status ? 'activado' : 'desactivado';
            session()->flash('success', "Usuario {$statusText} exitosamente.");
            
            // Si la solicitud es Ajax/fetch, devolver JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Usuario {$statusText} exitosamente.",
                    'status' => $status
                ]);
            }
            
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el estado del usuario: ' . $e->getMessage()
                ], 500);
            }
            
            session()->flash('error', 'Error al actualizar el estado del usuario: ' . $e->getMessage());
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Verificar si el usuario está intentando eliminarse a sí mismo
        if (auth()->id() == $id) {
            session()->flash('error', 'No puedes eliminar tu propio usuario mientras estás usando el sistema.');
            return redirect()->route('users.index');
        }
        
        try {
            $user = User::findOrFail($id);
            
            // Eliminar la foto del usuario si existe y no es un avatar generado
            if ($user->photo && !str_contains($user->photo, 'ui-avatars.com')) {
                $photoPath = public_path(ltrim($user->photo, '/'));
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            
            $user->delete();
            session()->flash('success', 'Usuario eliminado exitosamente.');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Ha ocurrido un error al eliminar el usuario: ' . $e->getMessage());
            return redirect()->route('users.index');
        }
    }
}
