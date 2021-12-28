<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function all()
    {
        return response()->json(User::all());
    }
}